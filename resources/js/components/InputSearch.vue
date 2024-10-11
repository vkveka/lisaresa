<template>
    <div>
        <form @submit.prevent="searchAccomodations">
            <div class="" style="width: 1000px;">
                <div class="parentSearchInput d-flex gap-2">
                    <div class="w-100 position-relative">
                        <input type="text" class="form-control border-0 " placeholder="Lieu..." v-model="searchQuery"
                            @input="searchCities" @click="searchCities(); hideDatePicker()">
                        <ul id="citiesList" class="listStyle" v-if="cities"
                            style="max-height: 300px; overflow-y: auto;">
                            <li v-for="city in cities" :key="city.ville_id"
                                @click="selectCity(city.ville_nom, city.ville_id)">
                                <span v-if="city.ville_code_postal.length > 5">{{ city.ville_nom }}</span>
                                <span v-else>{{ city.ville_nom }} - {{ city.ville_code_postal.slice(0, 5) }}</span>
                                <input type="hidden" v-model="villeId">
                            </li>
                        </ul>
                    </div>
                    <div class="position-relative w-100" @click.stop>
                        <input type="text" class="form-control border-0" placeholder="Dates..."
                            @focus="showDatePicker = true" v-model="selectedDate" @click="resetList">
                        <div class="position-absolute d-flex gap-3" style="" :style="{
                            display: showDatePicker ? 'block' : 'none',
                            top: '130%',
                            zIndex: 999,
                        }">
                            <VDatePicker v-model.range.number="range" v-if="showDatePicker" @click="logSelectedDate"
                                @focus="showDatePicker = true" />
                        </div>
                    </div>
                    <input type="number" class="form-control border-0" v-model="persons" placeholder="0"
                        @click="hideDatePicker(), resetList()" style="width: 90px;">
                    <div class="flex-column">
                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="collapse"
                            data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            <i class="fa-solid fa-list"></i>
                        </button>
                    </div>
                    <button type="submit" class="btn btn-success mx-auto">Go</button>
                </div>
                <div class="collapse w-100 mt-3" id="collapseExample" style="left:0">
                    <div class="card card-body">
                        <div class="typeAccomodation mb-3">
                            <div class=" d-flex justify-content-between ">
                                <h3>Type d'hébergement</h3>
                                <div class="d-flex align-items-center">
                                    <a href="#" style="color: red;" class="me-5" @click="clearInputs">Effacer</a>
                                    <button type="button" class="btn btn-outline-dark"
                                        @click="searchAccomodations(); showCollapse()">Enregistrer les
                                        modifications</button>
                                </div>
                            </div>
                            <span>
                                <input type="radio" class="btn-check" name="options-outlined" id="spanTypeHouse"
                                    autocomplete="off">
                                <label class="btn btn-outline-secondary me-1" for="spanTypeHouse">Maison</label>
                            </span>
                            <span>
                                <input type="radio" class="btn-check" name="options-outlined" id="spanTypeFlat"
                                    autocomplete="off">
                                <label class="btn btn-outline-secondary me-1" for="spanTypeFlat">Appartement</label>
                            </span>

                        </div>
                        <div>
                            <h3>Plus de filtres</h3>
                            <div class="parentSpan">
                                <span v-for="(option) in options" :key="option.id">
                                    <input type="checkbox" :name="option.name" :id="`optionId_${option.id}`"
                                        @change="handleCheckboxChange(option)"
                                        :checked="checkedInputs.includes(option)">
                                    <label :for="`optionId_${option.id}`">{{ option.name }}</label>
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script setup>
import axios from 'axios';
import { ref, defineEmits } from 'vue';
import { useRoute, useRouter } from 'vue-router';
const props = defineProps({
    initialSearchQuery: String,
    initialDates: Object,
    initialPersons: [Number, String],
    initialLocationId: [Number, String],
});
const range = ref({
    start: new Date(props.initialDates.start),
    end: new Date(props.initialDates.end),
});

const checkedInputs = ref([]);
const cities = ref(null);
const citiesList = ref(null);
const showDatePicker = ref(false);
const accomodations = ref([]);
const options = ref([]);
const router = useRouter();

const formatDate = (dateIn, dateOut) => {
    dateIn = new Date(dateIn)
    dateOut = new Date(dateOut)
    const formattedDateStart = dateIn.toLocaleDateString('fr-FR');
    const formattedDateEnd = dateOut.toLocaleDateString('fr-FR');
    return 'Du ' + formattedDateStart + ' au ' + formattedDateEnd;
}

const handleCheckboxChange = (option) => {
    const index = checkedInputs.value.findIndex(item => item.id === option.id);
    if (index === -1) {
        checkedInputs.value.push(option);
    } else {
        checkedInputs.value.splice(index, 1);
    }

    console.log(checkedInputs.value);
};

const clearInputs = () => {
    checkedInputs.value && (checkedInputs.value = [])
    console.log(checkedInputs.value);
}

const showCollapse = () => {
    const collapseElement = document.querySelector('.collapse.show');
    if (collapseElement) {
        collapseElement.classList.remove('show')
    }
}

const searchQuery = ref(props.initialSearchQuery || '');
const selectedDate = ref(props.initialDates ? `${formatDate(props.initialDates.start, props.initialDates.end)}` : '');
const persons = ref(parseInt(props.initialPersons) || 0);
const villeId = ref(props.initialLocationId || 0);

// Création d'un émetteur pour envoyer les données au parent
const emit = defineEmits(['searchResults']);

const searchAccomodations = () => {
    hideDatePicker();
    const dateIn = new Date(range.value.start)
    const dateOut = new Date(range.value.end)
    const locationId = villeId.value
    const nbPersons = persons.value
    const optionIds = checkedInputs.value.map(option => option.id);

    axios.get('/api/accomodations/search', {
        params: {
            date_in: dateIn.toISOString(),
            date_out: dateOut.toISOString(),
            location_id: locationId,
            persons: nbPersons,
            options: optionIds,
        }
    })
        .then((res) => {
            accomodations.value = res.data.accomodations
            emit('searchResults', res.data.accomodations)
        })
        .catch((err) => {
            console.error('Erreur lors de la recherche des logements :', err);
        });
}

const logSelectedDate = () => {
    const start = new Date(range.value.start)
    const end = new Date(range.value.end)
    const formattedDateStart = start.toLocaleDateString('fr-FR');
    const formattedDateEnd = end.toLocaleDateString('fr-FR');
    selectedDate.value = 'Du ' + formattedDateStart + ' au ' + formattedDateEnd;
};

// liste des villes
const searchCities = () => {
    if (searchQuery.value.length >= 3) {
        axios.get('/api/locations', {
            params: { query: searchQuery.value }
        })
            .then(response => {
                cities.value = response.data.locations;
            })
            .catch(error => {
                console.error(error);
            });
    } else {

        cities.value = [];
    }
};

// Sélection ville
const selectCity = (name, id) => {
    searchQuery.value = name;
    villeId.value = id;
    cities.value = null
}

// VIde la liste
const resetList = () => {
    cities.value && (cities.value = null);
}

// Cache le calendrier
const hideDatePicker = () => {
    showDatePicker.value && (showDatePicker.value = null);
}

const getOptions = async () => {
    try {
        const res = await axios.get('/api/options');
        options.value = res.data.options;
        // console.log(res.data);
    } catch (error) {
        console.error(error);
    }
}

getOptions();
</script>
<style scoped>
.parentSpan {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    max-width: 100%;
    max-height: 70vh;
    overflow-y: scroll;
}

.card label {
    margin-right: 30px
}

.card input[type="checkbox"] {
    margin-right: 5px
}

.card span {
    width: 250px;
}

.parentSearchInput {
    border-radius: 2vh;
    background-color: rgba(255, 255, 255, 0.863);
    border: 1px solid rgba(128, 128, 128, 0.377);
    padding: 10px;
    height: 80px;
    align-items: center;
    height: 100%;
}

.parentSearchInput input {
    font-style: normal;
    height: 100%;
}

.listStyle {
    position: absolute;
    top: 50px;
    border: 1px solid rgb(210, 210, 210);
    padding: 0;
    border-radius: 1vh;
    background-color: white;
    z-index: 1;
}

.listStyle li {
    border-radius: 1vh;
    padding: 5px 10px;
    list-style: none;
    cursor: pointer;
}

.listStyle li:hover {
    background-color: rgb(212, 212, 212);
    color: gray
}
</style>