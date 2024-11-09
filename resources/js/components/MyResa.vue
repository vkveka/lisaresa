<template>
    <div>
        <table class="table-responsive w-100 table-bordered" v-if="reservations">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Numero</th>
                    <th scope="col">Date d'arrivée</th>
                    <th scope="col">Date de départ</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Logement</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="reservation in reservations">
                    <th scope="row">{{ reservation.id }}</th>
                    <td>{{ reservation.numero }}</td>
                    <td>{{ formatDate(reservation.date_in) }}</td>
                    <td>{{ formatDate(reservation.date_out) }}</td>
                    <td>{{ reservation.price }}€</td>
                    <td><router-link :to="`/accomodation/${reservation.accomodation_id}`">Voir</router-link></td>
                </tr>
            </tbody>
        </table>
        <h5 v-else>Vous n'avez pas encore effectué de réservations.</h5>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import { useUserStore } from '../stores/userStore';

const userStore = useUserStore();
const reservations = ref([])
const getResa = async () => {
    try {
        const res = await axios.get(`/api/reservations/getResaForUser`, {
            headers: {
                Authorization: `Bearer ${userStore.user.access_token}`
            }
        })
        reservations.value = res.data.reservations;
        console.log(res.data.reservations);
    } catch (error) {
        console.log(error);
    }
}
getResa();

const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('fr-FR');
}
</script>
<style scoped>
table {
    border-color: rgb(206, 206, 206);
}

td,
th {
    padding: 5px !important;
}

@media screen and (max-width: 540px) {
    thead {
        font-size: 13px
    }

    tbody {
        font-size: 13px
    }
}
@media screen and (max-width: 400px) {
    thead {
        font-size: 10px
    }

    tbody {
        font-size: 10px
    }
}
</style>