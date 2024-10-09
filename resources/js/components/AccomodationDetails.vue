<template>
    <div v-if="accomodation">
        <div class="image-container">
            <img :src="'/images/accomodations/' + accomodation.id + '/' + accomodation.images[0].name"
                alt="Logement Lisaresa" />
        </div>
        <div class="details-container">
            <h1>{{ accomodation.name }}</h1>
            <div class="price">
                <span>{{ accomodation.price }} €/nuit</span>
            </div>
            <p class="description">{{ accomodation.description }}</p>
        </div>
    </div>
</template>

<script setup>
import { useRoute } from 'vue-router';
import { ref, computed } from 'vue';
import { useAccomodationStore } from '../stores/accomodationStore';

const accomodationStore = useAccomodationStore();
const accomodation = computed(() => accomodationStore.selectedAccomodation);

</script>




<style scoped>
/* Global container taking the full screen */
.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: start;
    height: 100vh;
    /* Full height of the viewport */
    width: 100vw;
    /* Full width of the viewport */
    background-color: #f5f5f5;
    /* Light background for a clean design */
    padding: 20px;
    box-sizing: border-box;
}

/* Image container */
.image-container {
    width: 100%;
    max-width: 800px;
    /* Limit the width for large screens */
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 20px;
    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
    /* Soft shadow for the image */
}

.image-container img {
    width: 100%;
    height: auto;
    display: block;
    border-radius: 10px;
    object-fit: cover;
}

/* Details container with all the accomodation info */
.details-container {
    text-align: center;
    max-width: 800px;
    width: 100%;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
    /* Soft shadow for the info box */
}

/* Title of the accomodation */
.details-container h1 {
    font-size: 2rem;
    margin-bottom: 10px;
    color: #333;
    font-weight: 600;
}

/* Price tag */
.price span {
    font-size: 1.5rem;
    color: #28a745;
    font-weight: 500;
}

/* Description of the accomodation */
.description {
    font-size: 1rem;
    color: #666;
    margin-top: 10px;
    line-height: 1.6;
    text-align: justify;
}

/* Responsive design */
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