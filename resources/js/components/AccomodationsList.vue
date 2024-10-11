<template>
    <div class="d-flex gap-4 pb-5 flex-column">
        <InputSearch @searchResults="handleSearchResults" class="position-fixed" style="z-index: 1; left:50px"
            :initial-search-query="$route.query.search_query"
            :initial-dates="{ start: $route.query.date_in, end: $route.query.date_out }"
            :initial-persons="$route.query.persons" :initial-location-id="$route.query.location_id">
        </InputSearch>
        <div class="d-flex gap-3 mt-5 pt-5 flex-wrap justify-content-center">
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

const route = useRoute();
const handleSearchResults = (results) => {
    accomodations.value = results
};

const accomodations = ref([]);

// Récupérer les paramètres de la requête
const fetchAccomodations = async () => {
    const locationId = parseInt(route.query.location_id);
    const dateIn = new Date(route.query.date_in);
    const dateOut = new Date(route.query.date_out);
    const nbPersons = parseInt(route.query.persons);

    try {
        const res = await axios.get('/api/accomodations/search', {
            params: {
                location_id: locationId,
                date_in: dateIn,
                date_out: dateOut,
                persons: nbPersons,
            },
        });
        accomodations.value = res.data.accomodations;
        // console.log(res.data);
    } catch (error) {
        console.error(error);
    }
};
fetchAccomodations();

// déclenche au click d'un logement
const goToAccomodationDetails = async (accomodation) => {
    return
    router.push({ name: 'AccomodationDetails', params: { id: accomodation.id } })
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
</style>