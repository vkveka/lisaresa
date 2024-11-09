<template>
    <div v-if="accomodation" class="accomodation-details">

        <div class="photo-gallery d-flex align-items-center">
            <img v-if="accomodation.images[0]"
                :src="'/images/accomodations/' + accomodation.id + '/' + accomodation.images[0].name" alt="Main Image"
                class="main-image" />
            <div class="small-images">
                <img v-for="(image, index) in accomodation.images.slice(1, imagesToShow)" :key="index"
                    :src="'/images/accomodations/' + accomodation.id + '/' + image.name" :alt="`Image ${index + 1}`" />
            </div>
        </div>



        <div class="details-container row m-0">
            <div class="col-md-6 col-12 mx-auto">
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
            <div class="col-md-6 pe-0 ps-md-4 ps-0 col-12 mx-auto">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="card p-4 shadow">
                        <h3 class="price mb-4">{{ accomodation.price }} € <span class="small-text">par nuit</span></h3>
                        <form @submit.prevent="proceedReservation(accomodation)">
                            <div class="mb-3">
                                <label for="date_in" class="form-label">Arrivée</label>
                                <input type="date" class="form-control" id="date_in" name="date_in" v-model="dateIn">
                            </div>
                            <div class="mb-3">
                                <label for="date_out" class="form-label">Départ</label>
                                <input type="date" class="form-control" id="date_out" name="date_out" v-model="dateOut">
                            </div>
                            <div class="mb-3">
                                <label for="voyageurs" class="form-label">Voyageurs</label>
                                <select class="form-select" id="persons" name="persons">
                                    <option v-for=" (persons, index) in accomodation.persons" :key="index"
                                        :selected="persons === parseInt(route.query.persons)">
                                        {{ persons }} voyageurs
                                    </option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-green btn-block w-100 mt-3">Réserver</button>

                            <p class="mt-2 text-muted">Aucun montant ne vous sera débité pour le moment</p>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>{{ accomodation.price }} € x
                                        <span v-if="numberOfNights !== null">{{ numberOfNights
                                            }}</span> nuits
                                    </span>
                                    <span>{{ calculateTotalPrice(accomodation.price, numberOfNights) }} €</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Frais de ménage</span><span>20 €</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Frais de service LISARESA</span><span>10 €</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Taxes</span><span>30 €</span>
                                </li>
                            </ul>
                            <div class="total d-flex justify-content-between mt-3">
                                <span>Total</span>
                                <input v-if="totalPrice.value" type="hidden" name="price" v-model="totalPrice.value">
                                <input v-if="numero.value" type="hidden" name="numero" v-model="numero.value">
                                <span class="total-price" id="price">{{ calculateTotalPrice(accomodation.price,
                                    numberOfNights) }}
                                    €</span>
                            </div>
                        </form>
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
import { useRoute, useRouter } from 'vue-router';
import { useUserStore } from '../stores/userStore';
import { ref, onMounted, onBeforeUnmount, computed } from 'vue';
import { useAccomodationStore } from '../stores/accomodationStore';
import { random } from 'lodash';
import Swal from 'sweetalert2';

const userStore = useUserStore();
const route = useRoute();
const router = useRouter();
const accomodationStore = useAccomodationStore();
const accomodation = ref(null);
const totalPrice = ref('');
const numero = ref('');
const imagesToShow = ref(5);
const updateImagesToShow = () => {
    imagesToShow.value = window.innerWidth > 1050 ? 5 : 3;
};
const formatDate = (dateStr) => {
    const date = new Date(dateStr);
    if (!isNaN(date.getTime())) {
        return date.toISOString().split('T')[0];
    }
    return '';
};
const dateIn = ref(new Date());
const dateOut = ref(new Date());
const numberOfNights = computed(() => {
    if (dateIn.value && dateOut.value) {
        const startDate = new Date(dateIn.value);
        const endDate = new Date(dateOut.value);
        const timeDiff = endDate - startDate;
        const dayInMillis = 1000 * 60 * 60 * 24;
        return Math.ceil(timeDiff / dayInMillis);
    }
    return null;
});
const calculateTotalPrice = (price, numberOfNights) => {
    if (numberOfNights !== null) {
        const total = (price * numberOfNights).toFixed(2);
        totalPrice.value = total;
        numero.value = parseInt(Math.floor(Date.now() / 1000));
        return total;
    }
    return "0.00";
};

onMounted(async () => {
    dateIn.value = formatDate(route.query.date_in);
    dateOut.value = formatDate(route.query.date_out);
    const accomodationId = route.params.id;
    if (accomodationStore.selectedAccomodation && accomodationStore.selectedAccomodation.id === parseInt(accomodationId)) {
        accomodation.value = accomodationStore.selectedAccomodation;
    } else {
        const response = await accomodationStore.setSelectedAccomodation(accomodationId);
        accomodation.value = response.accomodations;
        console.log(accomodation.value);
    }

    updateImagesToShow();
    window.addEventListener('resize', updateImagesToShow);
});

onBeforeUnmount(() => {
    window.removeEventListener('resize', updateImagesToShow);
});


const proceedReservation = async (accomodation) => {
    if (!userStore.user) {
        router.push('/login');
        return
    }

    const formatDateForMySQL = (date) => {
        const d = new Date(date);
        const year = d.getFullYear();
        const month = ('0' + (d.getMonth() + 1)).slice(-2); // Mois (ajout de zéro si nécessaire)
        const day = ('0' + d.getDate()).slice(-2); // Jour
        const hours = ('0' + d.getHours()).slice(-2); // Heure
        const minutes = ('0' + d.getMinutes()).slice(-2); // Minutes
        const seconds = ('0' + d.getSeconds()).slice(-2); // Secondes
        return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
    };

    // Utilisation des dates
    const date_In = formatDateForMySQL(dateIn.value);
    const date_Out = formatDateForMySQL(dateOut.value);

    // Vérifier la sortie dans la console
    console.log('date_in :>> ', date_In);  // Exemple de sortie : '2024-11-18 00:00:00'
    console.log('date_out :>> ', date_Out);  // Exemple de sortie : '2024-11-23 00:00:00'

    const numeroAcc = numero.value;
    const priceAcc = parseFloat(calculateTotalPrice(accomodation.price, numberOfNights.value));
    const userId = userStore.user.id;
    const accomodationId = accomodation.id;
    console.log('date_In :>> ', date_In);
    console.log('date_Out :>> ', date_Out);
    console.log('numeroAcc :>> ', numeroAcc);
    console.log('priceAcc :>> ', priceAcc);
    console.log('userId :>> ', userId);
    console.log('accomodationId :>> ', accomodationId);
    try {
        await axios.post(`/api/reservations`, {
            date_in: date_In,
            date_out: date_Out,
            numero: numeroAcc,
            price: priceAcc,
            user_id: userId,
            accomodation_id: accomodationId,
        }, {
            headers: {
                Authorization: `Bearer ${userStore.user.access_token}`
            }
        });
        Swal.fire({
            title: 'Succès!',
            text: 'La réservation a bien été prise en compte !',
            icon: 'success',
            confirmButtonText: 'Redirection...'
        });
        setTimeout(() => {
            Swal.close();
            router.push('/user')
        }, 4000);
    } catch (error) {
        console.log(error.status, error);
        Swal.fire({
            title: 'Erreur!',
            text: 'La réservation a bien échoué. Veuillez réessayez.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }


}
</script>




<style scoped>
.card {
    background-color: #fff;
    border-radius: 8px;
    padding: 2rem;
    width: 100%;
}

.price {
    font-size: 24px;
    font-weight: bold;
}

.small-text {
    font-size: 14px;
    font-weight: normal;
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
    max-width: 1000px;
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
    margin-right: 0.5em;
}

.small-images {
    height: 410px;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    width: 100%;
    gap: 0.5rem;
    /* margin-right: 0.5rem; */
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

@media (max-width: 1050px) {
    .photo-gallery {
        padding: 20px;
        gap: 0.5em;
    }

    .main-image {
        margin: 0;
    }

    .small-images {
        grid-template-columns: repeat(1, 1fr);
        height: 100%
    }
}

@media (max-width: 768px) {
    .photo-gallery {
        flex-direction: column;
    }

    .main-image {
        height: 250px;
    }

    .small-images {
        grid-template-columns: repeat(2, 1fr);
        height: 100%
    }

    .container {
        padding: 10px;
    }

    .details-container h1 {
        font-size: 1.5rem;
    }

    .details-container {
        padding: 15px
    }

    .price span {
        font-size: 1.2rem;
    }

    .description {
        font-size: 0.9rem;
    }
}
</style>