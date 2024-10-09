<template>
    <div>
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
                    @click="hideDatePicker()">
                <button type="submit" class="btn btn-success mx-auto">Go</button>
            </div>

            <!-- <i v-if="isLoading" class="fa-solid fa-spinner fa-spin me-2"></i>
            <span v-if="!isLoading">Publier</span> -->
        </form>
    </div>
</template>
<script setup>

import { ref, computed } from 'vue';
import axios from 'axios';
import AccomodationFromSearch from './AccomodationFromSearch.vue';
import { useRouter } from 'vue-router';
import { useAccomodationStore } from '../stores/accomodationStore';

const accomodationStore = useAccomodationStore();
const router = useRouter();
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
const showAccomodations = ref(null);

const goToAccomodationDetails = (accomodation) => {
    accomodationStore.setSelectedAccomodation(accomodation);
    router.push({ name: 'AccomodationDetails', params: { id: accomodation.id } });
};

const logSelectedDate = () => {
    // console.log('range.value.start :>> ', range.value.start);
    const start = new Date(range.value.start)
    const end = new Date(range.value.end)
    const formattedDateStart = start.toLocaleDateString('fr-FR');
    const formattedDateEnd = end.toLocaleDateString('fr-FR');
    selectedDate.value = 'Du ' + formattedDateStart + ' au ' + formattedDateEnd;
};

const searchCities = () => {
    if (searchQuery.value.length >= 3) {
        axios.get('/api/locations', {
            params: { query: searchQuery.value }
        })
            .then(response => {
                cities.value = response.data.locations;
                // console.log(response.data.locations);
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
        showAccomodations.value = res.data.accomodations
        console.log(res.data);

    }).catch((err) => {
        console.log(err);
    })
}
</script>
<style scoped></style>