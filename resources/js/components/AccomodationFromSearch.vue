<template>
    <div>
        <!-- <router-link :to="{ name: 'AccomodationDetails', params: { id: accomodation.id } }" style="text-decoration: none;"> -->
        <div class="card" style="width: 350px;border: none; border-top-left-radius: 5px; border-top-right-radius: 5px;"
            @click="goToAccomodationDetails(accomodation)">
            <div class="card-content">
                <div class="card-body d-flex flex-column p-0 m-0" style=" border: 0 solid transparent;">
                    <img :src="'./images/accomodations/' + accomodation.id + '/' + accomodation.images[0].name"
                        alt="image logement lisaresa"
                        style="border-top-left-radius: 5px; border-top-right-radius: 5px;">
                    <span class="fw-bold fs-5 m-3">
                        {{ accomodation.name }}
                    </span>
                    <span class="fw-bold ms-3">
                        {{ accomodation.price }}€ /nuit
                    </span>
                    <span class="m-3 description">
                        {{ accomodation.description }}
                    </span>
                </div>
            </div>
        </div>
        <!-- </router-link> -->
    </div>
</template>
<script setup>
import { defineProps } from 'vue';
import { useRouter } from 'vue-router';
import { useAccomodationStore } from '../stores/accomodationStore';

const accomodationStore = useAccomodationStore();

const router = useRouter();

defineProps({
    accomodation: {
        type: Object,
        required: true,
    }
});

// déclenche au click d'un logement
const goToAccomodationDetails = async (accomodation) => {
    accomodationStore.selectedAccomodation = accomodation;
    await router.push({ name: 'AccomodationDetails', params: { id: accomodation.id } });
};

</script>
<style scoped>
.card-body {
    height: 400px;
}

.card-body img {
    height: 250px;
    object-fit: cover;
}

.description {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    width: 90%;
    display: inline-block;
}

.card {
    transition: 0.2s;
    cursor: pointer;
}

.card:hover {
    box-shadow: 0 0 20px white;
}
</style>