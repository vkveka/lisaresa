<template>
    <div v-if="accomodation" class="accomodation-details">

        <div class="photo-gallery d-flex align-items-center">
            <img :src="'/images/accomodations/' + accomodation.id + '/' + accomodation.images[0].name" alt="Main Image"
                class="main-image" />
            <div class="small-images">
                <img v-for="(image, index) in accomodation.images.slice(1, 5)" :key="index"
                    :src="'/images/accomodations/' + accomodation.id + '/' + image.name" :alt="`Image ${index + 1}`" />
            </div>
        </div>



        <div class="details-container ">
            <div class="w-50">
                <h1>{{ accomodation.name }}</h1>
                <ul style="display: flex;" class="list-options">
                    <li class="options">{{ accomodation.persons }} voyageurs</li>
                    <li class="options">{{ accomodation.beds }} lits</li>
                    <li class="options" v-for="(option, index) in accomodation.options.slice(0, 2)" :key="index">{{
                        option.name }}
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="auto" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 me-1" width="17px">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                    </svg>
                    <span>{{ accomodation.note }}</span>
                    <a href="" class="ms-3" style="color: black;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6" width="17px">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                        </svg>
                        {{ accomodation.comments.length }} commentaires</a>
                </div>
                <hr class="my-5">
                <p class="fw-bold">Hôte : LISARESA</p>
                <hr class="my-5">
                <p class="description">{{ accomodation.description }}</p>
                <hr class="my-5">
            </div>
            <div class="w-50">
                <div class="container d-flex justify-content-center align-items-center">
                    <div class="card p-4 shadow" style="max-width: 400px;">
                        <h3 class="price mb-4">{{ accomodation.price }} € <span class="small-text">par nuit</span></h3>
                        <form>
                            <div class="mb-3">
                                <label for="arrivee" class="form-label">Arrivée</label>
                                <input type="date" class="form-control" id="arrivee" value="2025-03-05">
                            </div>
                            <div class="mb-3">
                                <label for="depart" class="form-label">Départ</label>
                                <input type="date" class="form-control" id="depart" value="2025-03-10">
                            </div>
                            <div class="mb-3">
                                <label for="voyageurs" class="form-label">Voyageurs</label>
                                <select class="form-select" id="persons">
                                    <option v-for=" (persons, index) in accomodation.persons" :key="index">
                                        {{ persons }} voyageurs
                                    </option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-green btn-block w-100 mt-3">Réserver</button>
                        </form>
                        <p class="mt-2 text-muted">Aucun montant ne vous sera débité pour le moment</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{ accomodation.price }} € x XXX nuits</span><span>XXX €</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Frais de ménage</span><span>20 €</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Frais de service LISARESA</span><span>46 €</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Taxes</span><span>41 €</span>
                            </li>
                        </ul>
                        <div class="total d-flex justify-content-between mt-3">
                            <span>Total</span>
                            <span class="total-price">XXX €</span>
                        </div>
                    </div>
                </div>
            </div>
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
        console.log(accomodation.value);
    }
});
</script>




<style scoped>
.card {
    background-color: #fff;
    border-radius: 8px;
    padding: 2rem;
    width: 100%;
    max-width: 400px;
}

.price {
    font-size: 24px;
    font-weight: bold;
}

.small-text {
    font-size: 14px;
    font-weight: normal;
}

.btn-green {
    background-color: #647357;
    color: #fff;
    border: none;
}

.btn-green:hover {
    background-color: #4c5742;
}

.total {
    font-size: 18px;
    font-weight: bold;
}

.total-price {
    font-size: 18px;
    color: #000;
}

.list-group-item {
    border: none;
    padding-left: 0;
    padding-right: 0;
}

.text-muted {
    font-size: 12px;
}

.datepicker-input {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 100px;
    text-align: center;
}

.details-container {
    display: flex;
    width: 100%;
    background-color: #fff;
    padding: 40px;
    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
}

.details-container h1 {
    font-size: 2rem; 
    color: #333;
    font-weight: 600;
}

.price span {
    font-size: 1.5rem;
    color: #647357;
    font-weight: 500;
}

.description {
    font-size: 1rem;
    color: #666;
    margin-top: 10px;
    line-height: 1.6;
    text-align: justify;
}

.accomodation-details {
    margin-left: auto;
    margin-right: auto;
    width: 1000px;
    font-family: Arial, sans-serif;
}


h1 {
    font-size: 2rem;
    font-weight: bold;
    color: #333;
    margin-bottom: 1rem;
}

.photo-gallery {
    margin-bottom: 2rem;
    padding-top: 1rem;
}

.photo-gallery img {
    cursor: pointer;
}

.main-image {
    width: 100%;
    height: 410px;
    object-fit: cover;
    border-radius: 8px;
    margin-right: 0.5rem;
    margin-left: 0.5rem;
}

.small-images {
    height: 410px;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    width: 100%;
    gap: 0.5rem;
    margin-right: 0.5rem;
}

.small-images img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 8px;
}

.list-options {
    list-style: none;
    padding: 0;
}

.list-options li {
    position: relative;
    padding: 0 5px;
    /* Espacement entre les éléments */
}

.list-options li:not(:first-child)::before {
    content: "•";
    padding-right: 10px;
    /* Espace après le tiret */
}

.options {
    color: #666;
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