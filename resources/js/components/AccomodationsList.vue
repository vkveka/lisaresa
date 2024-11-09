<template>
    <div class="d-flex gap-4 pb-5 flex-column mx-auto" style="max-width: 1500px;">
        <InputSearch class="inputSearchClass" :initial-search-query="$route.query.search_query"
            :initial-dates="{ start: $route.query.date_in, end: $route.query.date_out }"
            :initial-persons="$route.query.persons" :initial-location-id="$route.query.location_id">
        </InputSearch>
        <div class="d-flex gap-3 mt-0 mt-lg-5 pt-0 pt-lg-5 flex-wrap justify-content-center"
            v-if="accomodations.length > 0">
            <AccomodationFromSearch v-for="accomodation in accomodations" :key="accomodation.id"
                :accomodation="accomodation" @click="goToAccomodationDetails(accomodation)">
            </AccomodationFromSearch>
        </div>
        <div class="d-flex gap-3 mt-5 pt-5 flex-wrap justify-content-center text-light" v-else>
            <span style="color: #647357;">Pas de logement disponible</span>
        </div>
    </div>
</template>


<script setup>
import InputSearch from './InputSearch.vue';
import { ref } from 'vue';
import AccomodationFromSearch from './AccomodationFromSearch.vue';
import { useRoute, useRouter } from 'vue-router';
import axios from 'axios';
import { useAccomodationStore } from '../stores/accomodationStore';

const router = useRouter();
const accomodationStore = useAccomodationStore();
const route = useRoute();
const selectedDates = ref({ dateIn: '', dateOut: '' });
// const handleSearchResults = ({ accomodations: results, dateIn, dateOut }) => {
//     accomodations.value = results;
//     selectedDates.value = { dateIn, dateOut };
// };
const goToAccomodationDetails = async (accomodation) => {
    accomodationStore.selectedAccomodation = accomodation;
    await router.push({
        name: 'AccomodationDetails',
        params: { id: accomodation.id },
        query: {
            date_in: selectedDates.value.dateIn.toISOString().split('T')[0],
            date_out: selectedDates.value.dateOut.toISOString().split('T')[0],
            persons: route.query.persons,
        },
    });
};
const accomodations = ref([]);
const minPriceInput = ref(0);
const maxPriceInput = ref(0);
// Récupérer les paramètres de la requête
const fetchAccomodations = async () => {
    const locationId = parseInt(route.query.location_id);
    const dateIn = new Date(route.query.date_in);
    const dateOut = new Date(route.query.date_out);
    const nbPersons = parseInt(route.query.persons);
    const optionIds = route.query.options;
    const typeAccomodation = route.query.type_accomodation;
    const minPrice = route.query.min_price;
    const maxPrice = route.query.max_price;
    const collapseElement = document.querySelector('.collapse.show');

    try {
        const res = await axios.get('/api/accomodations/search', {
            params: {
                location_id: locationId,
                date_in: dateIn,
                date_out: dateOut,
                persons: nbPersons,
                options: optionIds,
                type_accomodation: typeAccomodation,
                min_price: minPrice,
                max_price: maxPrice,
            },
        });

        if (collapseElement) {
            collapseElement.classList.remove('show')
        }
        const accomodationsList = res.data.accomodations;
        accomodations.value = accomodationsList
        selectedDates.value = { dateIn, dateOut };
        if (accomodationsList.value) {
            const prices = res.data.accomodations.map(accomodation => accomodation.price);
            minPriceInput.value = Math.min(...prices);
            maxPriceInput.value = Math.max(...prices);
            value2.value = [minPriceInput.value, maxPriceInput.value];
        }
    } catch (error) {
        console.error(error);
    }
};
fetchAccomodations();



</script>
<style scoped>
.inputSearchClass {
    position: fixed;
    width: 70% !important;
    z-index: 1;
    left: 50%;
    transform: translateX(-50%);
    top: 90px;
}

@media screen and (max-width: 991px) {
    .inputSearchClass {
        position: relative;
        top: 10px
    }
}

@media screen and (max-width: 768px) {
    .inputSearchClass {
        width: 90% !important;
    }
}

.container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

#logo {
    max-width: 50%;
}
</style>