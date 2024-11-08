<template>
    <div class="gap-5 parentHeader" @click="hideDatePicker(); resetList();">
        <div class="">
            <h2>VOS REVES</h2>
            <h3>COMMENCENT ICI</h3>
            <h2>EN TOUTE SIMPLICITE</h2>
            <form @submit.prevent="searchAccomodations" class="d-flex flex-column">
                <div class="parentSearchInput d-flex " style="width: 100%;">
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
                        <input type="text" class="form-control border-0 input-date" placeholder="Dates..."
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
                        @click="hideDatePicker()" style="width: 50%;">
                    <button type="submit" class="btn btn-green mx-auto ">Rechercher</button>
                </div>

                <!-- <i v-if="isLoading" class="fa-solid fa-spinner fa-spin me-2"></i>
            <span v-if="!isLoading">Publier</span> -->
            </form>
        </div>
    </div>
</template>


<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const router = useRouter();
const searchQuery = ref('');
const cities = ref(null);
const showDatePicker = ref(false);
const villeId = ref(null);
const selectedDate = ref(null);
const persons = ref(0);
const range = ref({
    start: new Date(),
    end: new Date(),
});

const logSelectedDate = () => {
    // console.log('range.value.start :>> ', range.value.start);
    const start = new Date(range.value.start)
    const end = new Date(range.value.end)
    // console.log(start);
    // console.log(end);
    const formattedDateStart = start.toLocaleDateString('fr-FR');
    const formattedDateEnd = end.toLocaleDateString('fr-FR');
    selectedDate.value = 'Du ' + formattedDateStart + ' au ' + formattedDateEnd;
    // console.log(selectedDate.value);
};

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

const selectCity = (name, id) => {
    searchQuery.value = name;
    villeId.value = id;
    cities.value = null
}

const resetList = () => {
    cities.value && (cities.value = null);
}

const hideDatePicker = () => {
    showDatePicker.value && (showDatePicker.value = null);
}

const searchAccomodations = () => {
    const dateIn = new Date(range.value.start).toISOString().split('T')[0];
    const dateOut = new Date(range.value.end).toISOString().split('T')[0];

    const locationId = villeId.value;
    const nbPersons = persons.value;
    const search_query = searchQuery.value
    console.log({
        location_id: locationId,
        date_in: dateIn,
        date_out: dateOut,
        persons: nbPersons,
        search_query: search_query,
    });
    // Redirection vers la page des logements
    router.push({
        name: 'AccomodationsList',
        query: {
            location_id: locationId,
            date_in: dateIn,
            date_out: dateOut,
            persons: nbPersons,
            search_query: search_query,
        }
    });
};
</script>
<style scoped>
input {
    font-family: "Julius Sans One", sans-serif;
    font-weight: 400;
    font-style: normal;
}

#citiesList {
    font-family: "Julius Sans One", sans-serif;
    font-weight: 400;
    font-style: normal;
}

input::placeholder {
    font-family: "Julius Sans One", sans-serif;
    font-weight: 400;
    font-style: normal;
}

button[type="submit"] {
    font-family: "Julius Sans One", sans-serif;
    font-weight: 400;
    font-style: normal;
}

h2,
h3 {
    margin: 0;
    color: white;
    text-shadow: 0 0 5px black;
    font-family: "Julius Sans One", sans-serif;
    font-weight: 400;
    font-style: normal;
}

@media screen and (max-width: 992px) {
    h2 {
        font-size: 60px !important;
    }

    h3 {
        font-size: 30px !important;
    }

    .parentHeader {
        margin-top: -100px;
        padding: 0 100px !important;
    }
}

@media screen and (max-width: 768px) {
    h2 {
        font-size: 50px !important;
    }

    h3 {
        font-size: 30px !important;
    }

    .parentHeader {
        padding: 0 30px !important;
    }
}

@media screen and (max-width: 540px) {
    form {
        margin-top: 50px;
    }

    .parentSearchInput {
        display: flex;
        flex-direction: column;
    }

    input[type="number"] {
        height: auto !important;
        margin-bottom: 10px;
    }

    h2,
    h3 {
        text-align: center !important;
    }
}

@media screen and (min-width: 541px) {

    .input-date {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    input[type="text"] {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    input[type="number"] {
        border-radius: 0;
    }

    button[type="submit"] {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }
}

h2 {
    font-size: 80px;
}

h3 {
    font-size: 40px;
}


#logo {
    max-width: 50%;
}

.parentSearchInput {
    border-radius: 2vh;
    padding: 10px;
    height: 80px;
}

.parentSearchInput input {
    background-color: rgba(255, 255, 255, 0.932);
    border: 1px solid rgba(0, 0, 0, 0.068) !important;
    font-style: normal;
    height: 100%;
}

.listStyle {
    z-index: 998;
    position: absolute;
    top: 50px;
    border: 1px solid rgb(210, 210, 210);
    padding: 0;
    border-radius: 1vh;
    background-color: white;
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