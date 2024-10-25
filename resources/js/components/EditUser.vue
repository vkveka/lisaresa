<template>
    <div>
        <form @submit.prevent="EditInfoUser">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-2">

                            <img :src="`/images/${imageValue}`" alt="profile picture lisaresa"
                                style="width: 100px; height: auto;">
                        </div>
                        <div class="col-5">
                            <label for="firstname" class="form-label">Prénom</label>
                            <input type="text" id="firstname" class="form-control" placeholder="Prénom..."
                                v-model="lastnameValue">
                        </div>
                        <div class="col-5">
                            <label for="lastname" class="form-label">Nom</label>
                            <input type="text" id="lastname" class="form-control" placeholder="Nom..."
                                v-model="firstnameValue">
                        </div>

                        <div class="col-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" class="form-control" placeholder="Email..."
                                v-model="emailValue">
                        </div>

                        <div class="col-6">
                            <label for="oldPassword" class="form-label">Ancien Mot de passe</label>
                            <input type="password" id="oldPassword" class="form-control" name="oldPassword"
                                placeholder="Nouveau Mot de passe..." v-model="oldPasswordValue">
                        </div>
                        <div class="col-6">
                            <label for="password" class="form-label">Nouveau Mot de passe</label>
                            <input type="password" id="password" class="form-control" name="password"
                                placeholder="Nouveau Mot de passe..." v-model="passwordValue">
                        </div>
                        <div class="col-6">
                            <label for="password_confirmation" class="form-label">Confirmation Mot de passe</label>
                            <input type="password" id="password_confirmation" class="form-control"
                                name="password_confirmation" placeholder="Confirmation Mot de passe..."
                                v-model="confirmPasswordValue">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark mt-3">Ajouter</button>
                </div>
            </div>
        </form>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import { useUserStore } from '../stores/userStore';
import axios from 'axios';
import Swal from 'sweetalert2';

const userStore = useUserStore();
const lastnameValue = ref(userStore.user.lastname)
const firstnameValue = ref(userStore.user.firstname)
const emailValue = ref(userStore.user.email)
const imageValue = ref(userStore.user.image)
const oldPasswordValue = ref(null)
const passwordValue = ref(null)
const confirmPasswordValue = ref(null)
const fileList = ref([])

const EditInfoUser = async () => {
    try {
        const res = await axios.put(`/api/users/${userStore.user.id}`,
            {
                lastname: lastnameValue.value,
                firstname: firstnameValue.value,
                email: emailValue.value,
                oldPassword: oldPasswordValue.value,
                password: passwordValue.value,
                password_confirmation: confirmPasswordValue.value,
            },
            {
                headers: {
                    Authorization: `Bearer ${userStore.user.access_token}`,
                    'Content-Type': 'application/json',  // ou multipart/form-data si vraiment nécessaire
                    'Accept': 'application/json',
                },
            }
        );

        Swal.fire({
            title: 'Succès!',
            text: 'Vos informations ont été mises à jour !',
            icon: 'success',
            confirmButtonText: 'OK'
        });

        console.log('Hello');
    } catch (error) {
        Swal.fire({
            title: 'Erreur!',
            text: 'Une erreur est survenue. Veuillez réessayer.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        console.error('Modification des informations de l\'utilisateur impossible : ', error);

    }

}
</script>
<style scoped></style>