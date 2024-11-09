<template>
    <div v-if="userStore.user" class="p-sm-5 p-3">
        <div class="row">
            <div v-if="userStore.user.role_id == 1" class="col-lg-6">
                <h1>Ajouter un logement</h1>
                <AddAccomodation></AddAccomodation>
            </div>
            <div class="col-lg-6 mx-auto">
                <div class="col-12 mb-5">
                    <h1>Modification des informations</h1>
                    <EditUser></EditUser>
                </div>
                <div class="col-12">
                    <h1>Mes Réservations</h1>
                    <MyResa></MyResa>
                </div>
            </div>
        </div>
    </div>
    <div v-else class="p-sm-5 p-3"></div>
</template>

<script setup>
import { ref } from 'vue';
import { useUserStore } from '../stores/userStore';
import AddAccomodation from './AddAccomodation.vue';
import EditUser from './EditUser.vue';
import { onMounted, computed } from 'vue'
import { useRouter } from 'vue-router'
import MyResa from './MyResa.vue';

const router = useRouter()
const userStore = useUserStore();
onMounted(() => {
    if (!userStore.user) {
        router.push('/login')
    }
})
</script>
<style scoped></style>