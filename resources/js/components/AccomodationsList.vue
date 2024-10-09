<template>
    <div class="d-flex gap-4 pb-5 flex-column">
        <!-- <InputSearch></InputSearch> -->
        <form @submit.prevent="searchAccomodations" class="d-flex flex-column">
            <div class="parentSearchInput d-flex gap-2" style="width: 1000px;">
                <div class="w-100 position-relative">
                    <input type="text" class="form-control border-0 " placeholder="Lieu..." v-model="searchQuery"
                        @input="searchCities" @click="searchCities(); hideDatePicker()">
                    <ul id="citiesList" class="listStyle" v-if="cities" style="max-height: 300px; overflow-y: auto;">
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
                <input type="number" class="form-control border-0" v-model="persons" placeholder="Voyageurs..."
                    @click="hideDatePicker(), resetList()">
                <button type="submit" class="btn btn-success mx-auto">Go</button>
            </div>
        </form>




        <div class="d-flex gap-3 flex-wrap justify-content-center">
            <AccomodationFromSearch v-for="accomodation in accomodations" :key="accomodation.id"
                :accomodation="accomodation" @click="goToAccomodationDetails(accomodation)">
            </AccomodationFromSearch>
        </div>
    </div>
</template>


<script setup>
import InputSearch from './InputSearch.vue';
import { ref } from 'vue';
import AccomodationFromSearch from './AccomodationFromSearch.vue';
import { useRoute, useRouter } from 'vue-router';
import axios from 'axios';

const searchQuery = ref('');
const cities = ref(null);
const citiesList = ref(null);
const showDatePicker = ref(false);
const villeId = ref(null);
const selectedDate = ref(null);
const persons = ref(null);
const range = ref({
    start: new Date(),
    end: new Date(),
});
const router = useRouter();
const route = useRoute();

const accomodations = ref([]);

// Récupérer les paramètres de la requête
const fetchAccomodations = async () => {
    const locationId = route.query.location_id;
    const dateIn = route.query.date_in;
    const dateOut = route.query.date_out;

    try {
        const res = await axios.get('/api/accomodations/search', {
            params: {
                location_id: locationId,
                date_in: dateIn,
                date_out: dateOut,
            },
        });
        accomodations.value = res.data.accomodations;
    } catch (error) {
        console.error(error);
    }
};

const searchAccomodations = () => {
    hideDatePicker();
    const dateIn = new Date(range.value.start)
    const dateOut = new Date(range.value.end)
    const locationId = villeId.value
    console.log('dateIn :>> ', dateIn);
    console.log('dateOut :>> ', dateOut);
    axios.get('/api/accomodations/search', {
        params: {
            date_in: dateIn,
            date_out: dateOut,
            location_id: locationId
        }
    }).then((res) => {
        accomodations.value = res.data.accomodations
        console.log(res.data);
    }).catch((err) => {
        console.log(err);
    })
}


// Appeler la fonction pour récupérer les logements quand le composant est monté
fetchAccomodations();

// déclenche au click d'un logement
const goToAccomodationDetails = async (accomodation) => {
    return
}

const logSelectedDate = () => {
    // console.log('range.value.start :>> ', range.value.start);
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
</script>
<style scoped>
.container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

#logo {
    max-width: 50%;
}

.parentSearchInput {
    border-radius: 2vh;
    background-color: rgba(255, 255, 255, 0.863);
    border: 1px solid rgba(128, 128, 128, 0.377);
    padding: 10px;
    height: 80px;
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