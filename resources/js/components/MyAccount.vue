<template>
    <div v-if="userStore.user && userStore.user.role_id == 1" class="p-5">
        <div class="row">
            <div class="col-md-6">
                <h1>Ajouter un logement</h1>
                <AddAccomodation></AddAccomodation>
            </div>
            <div class="col-md-6">
                <h1>Modification des informations</h1>
                <EditUser></EditUser>
            </div>
        </div>
    </div>
    <div v-else-if="userStore.user" class="p-5">
        <h1>Modification des informations</h1>
        <div class="row">
            <div class="col-md-6">
                <EditUser></EditUser>
            </div>
        </div>
    </div>
    <div v-else class="p-5">

    </div>
</template>
<script setup>
import { ref } from 'vue';
import { useUserStore } from '../stores/userStore';
import AddAccomodation from './AddAccomodation.vue';
import EditUser from './EditUser.vue';
import { onMounted, computed } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const userStore = useUserStore();
onMounted(() => {
    if (!userStore.user) {
        router.push('/login')
    }
})
</script>
<style scoped></style>