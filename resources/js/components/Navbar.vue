<template>
    <div class="sticky-top shadow">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <img :src="`/images/logo/logo_brown.png`" alt="logo blog_api" width="auto" height="30px"
                    class="mx-5 my-3">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse ms-lg-0 ms-3" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0 w-100 justify-content-between ms-0 ms-xl-5">
                        <li class="nav-item pe-5">
                            <router-link class="nav-link active" aria-current="page" to="/">Accueil</router-link>
                        </li>
                        <li class="nav-item pe-5">
                            <router-link class="nav-link " aria-current="page" to="/about">A propos</router-link>
                        </li>
                        <li class="nav-item pe-5">
                            <router-link class="nav-link " aria-current="page"
                                to="/destinations">Destinations</router-link>
                        </li>
                        <li class="nav-item pe-5">
                            <router-link class="nav-link " aria-current="page" to="/contact">Contact</router-link>
                        </li>
                        <li class="nav-item pe-5">
                            <router-link class="nav-link " aria-current="page" to="/avis">Avis</router-link>
                        </li>
                        <li class="nav-item pe-3 my-auto">
                            <div class="dropdown dropstart" style="cursor: pointer; max-width: 100px;">
                                <div v-if="userStore.user">
                                    <img :src="`/images/users/${userStore.user.image}`" data-bs-toggle="dropdown"
                                        aria-expanded="false" class="dropdown-toggle img_user"
                                        alt="image user non connecté" width="40px" height="40px">
                                    <ul class="dropdown-menu">
                                        <li>
                                            <router-link class="dropdown-item" :to="`/user`">Mon
                                                Compte</router-link>
                                        </li>
                                        <li><router-link class="dropdown-item" to="/logout">Deconnexion</router-link>
                                        </li>
                                    </ul>
                                </div>
                                <div v-else>
                                    <i class="fa-solid fa-arrow-right-to-bracket fa-2x my-auto" data-bs-toggle="dropdown"
                                        aria-expanded="false" style="color: #9C7C5E;"></i>
                                    <!-- <img :src="`/images/users/user.png`"alt="image user non connecté"
                                        width="40px"> -->
                                    <ul class="dropdown-menu">
                                        <li><router-link class="dropdown-item" to="/login">Connexion</router-link></li>
                                        <li><router-link class="dropdown-item" to="/register">Inscription</router-link>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>

<script setup>
import { useRouter } from 'vue-router';
import { useUserStore } from '../stores/userStore';
// const router = useRouter();
const userStore = useUserStore();



// const getUserImage = (imageName) => {
//     return imageName ? `/images/${imageName}` : '/images/logo.png';
// };
</script>

<style scoped>
.active {
    color: #5a4736 !important;
    font-weight: bold;
}

.nav-item {
    font-family: "Julius Sans One", sans-serif;
    font-weight: 400;
    font-style: normal;
}

.nav-item a {
    color: #9C7C5E;
}

.img_user {
    border-radius: 10vh;
}

.img_user {
    object-fit: cover;
}
</style>