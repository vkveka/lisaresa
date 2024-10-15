<template>
    <div v-if="accomodation" class="bg-secondary">
        <div class="image-container d-flex" flex-wrap v-if="accomodation.images && accomodation.images.length > 0">
            <img :src="'/images/accomodations/' + accomodation.id + '/' + accomodation.images[0].name"
                alt="Logement Lisaresa" />
            <div v-for="(image, index) in accomodation.images.slice(1, 7)" :key="image.id">
                <img class="col-4" :src="'/images/accomodations/' + accomodation.id + '/' + image.name"
                    alt="Logement Lisaresa" />
            </div>
        </div>
        <div v-else>
            <img src="../../../public/images/user.png" alt="No image available" />
        </div>
        <div class="details-container">
            <h1>{{ accomodation.name }}</h1>
            <div class="price">
                <span>{{ accomodation.price }} €/nuit</span>
            </div>
            <p class="description">{{ accomodation.description }}</p>
        </div>
    </div>
    <div v-else>
        <p>Loading...</p>
    </div>
</template>

<script setup>
import { useRoute } from 'vue-router';
import { ref, onMounted } from 'vue';
import { useAccomodationStore } from '../stores/accomodationStore';
const route = useRoute();
const accomodationStore = useAccomodationStore();
const accomodation = ref(null);

onMounted(async () => {
    const accomodationId = route.params.id;
    if (accomodationStore.selectedAccomodation && accomodationStore.selectedAccomodation.id === parseInt(accomodationId)) {
        accomodation.value = accomodationStore.selectedAccomodation;
    } else {
        const response = await accomodationStore.setSelectedAccomodation(accomodationId);
        accomodation.value = response.accomodations;
    }
});
</script>




<style scoped>
.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: start;
    height: 100vh;
    width: 100vw;
    background-color: #f5f5f5;
    padding: 20px;
    box-sizing: border-box;
}

.image-container {
    max-width: 100vw;
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 20px;
    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
}

.othersImages img {
    max-width: 300px;
}

.image-container img {
    width: 100%;
    height: auto;
    display: block;
    border-radius: 10px;
    object-fit: cover;
}

.details-container {
    text-align: center;
    max-width: 800px;
    width: 100%;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
}

.details-container h1 {
    font-size: 2rem;
    margin-bottom: 10px;
    color: #333;
    font-weight: 600;
}

.price span {
    font-size: 1.5rem;
    color: #28a745;
    font-weight: 500;
}

.description {
    font-size: 1rem;
    color: #666;
    margin-top: 10px;
    line-height: 1.6;
    text-align: justify;
}

@media (max-width: 768px) {
    .container {
        padding: 10px;
    }

    .details-container h1 {
        font-size: 1.5rem;
    }

    .price span {
        font-size: 1.2rem;
    }

    .description {
        font-size: 0.9rem;
    }
}
</style>