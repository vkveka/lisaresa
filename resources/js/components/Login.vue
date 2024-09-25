<template>
    <div class="col-2 mx-auto">
        <h1 class="text-center my-5">Login</h1>
        <form class="row g-3 needs-validation" @submit.prevent="logIn">
            <div class="row mx-auto">
                <label for="email" class="form-label">Pseudo</label>
                <div class="input-group has-validation">
                    <input v-model="email" type="email" class="form-control" id="email" required>
                    <div class="invalid-feedback">
                        Please choose a username.
                    </div>
                </div>
            </div>
            <div class="row mx-auto">
                <label for="password" class="form-label">Mot de passe</label>
                <div class="input-group has-validation">
                    <input v-model="password" type="password" class="form-control" id="password" required>
                    <div class="invalid-feedback">
                        Please choose a username.
                    </div>
                </div>
            </div>

            <div class="row mt-4 text-center mx-auto">
                <button class="btn btn-dark" type="submit">
                    <i v-if="isLoading" class="fa-solid fa-spinner fa-spin me-2"></i>
                    <span v-if="!isLoading">Se connecter</span>
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
import { useUserStore } from '../stores/userStore';
const router = useRouter();
const email = ref('');
const password = ref('');
const isLoading = ref(false);
const userStore = useUserStore();
if (userStore.user) {
    router.push('/');
}

const logIn = () => {
    isLoading.value = true;

    axios.get('/sanctum/csrf-cookie')
        .then(() => {
            axios.post('/api/login', {
                email: email.value,
                password: password.value
            })
                .then((res) => {
                    console.log(res.data.user);
                    userStore.storeUserData(res.data.user)
                    router.push('/')
                })
                .catch((error) => {
                    console.log(error)
                })

        })

        .catch(() => {
            console.log('Problème d\'authentification. Rechargez la page')
            alert('Problème d\'authentification. Rechargez la page')
        })
        .finally(() => {
            isLoading.value = false;
        });
};
</script>

<style lang="scss" scoped></style>