<template>
    <div class="sticky-top shadow">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <img src="../../../public/images/logo/logo_offcolor.png" alt="logo blog_api" width="100px"
                    class="mx-5 my-1">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Accueil</a>
                        </li>
                    </ul>
                    <div class="btn-group dropstart ms-5 me-3" style="cursor: pointer;">
                        <div v-if="userStore.user">
                            <img :src="getUserImage(userStore.user.image)" data-bs-toggle="dropdown"
                                aria-expanded="false" class="dropdown-toggle img_user" alt="image user non connecté"
                                width="40px" height="40px">
                            <!-- <img src="../../../public/images/logo.png" data-bs-toggle="dropdown" aria-expanded="false"
                                class="dropdown-toggle" alt="image user non connecté" width="40px"> -->
                            <ul class="dropdown-menu">
                                <li>
                                    <router-link to="/">Mon
                                        Compte</router-link>
                                </li>
                                <li><router-link class="dropdown-item" to="/logout"
                                        @click="logOut">Deconnexion</router-link></li>
                                <!-- <li><router-link class="dropdown-item" to="/login">Connexion</router-link></li> -->

                            </ul>
                        </div>
                        <div v-else>
                            <img src="../../../public/images/user.png" data-bs-toggle="dropdown" aria-expanded="false"
                                class="dropdown-toggle" alt="image user non connecté" width="40px">
                            <ul class="dropdown-menu">
                                <li><router-link class="dropdown-item" to="/login">Connexion</router-link></li>
                                <li><router-link class="dropdown-item" to="/register">Inscription</router-link></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>

<script setup>
import { useRouter } from 'vue-router';
import { useUserStore } from '../stores/userStore';
const router = useRouter();
const userStore = useUserStore();

// const logOut = () => {
//     userStore.removeUser()

//     axios.post('/api/logout')
//         .then(response => {
//             console.log(response)
//             router.push('/')
//         })
//         .catch(error => {
//             console.error('Erreur lors de la déconnexion:', error);
//         });
// };





const logOut = async () => {
    // on réinitialise le store
    userStore.$reset();

    try {
        await axios.post("/logout");

        // supprimer les cookies csrf + de session
        document.cookie.split(";").forEach((c) => {
            document.cookie = c
                .replace(/^ +/, "")
                .replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/");
        });

        // on redirige vers l'accueil
        router.push("/");

    } catch (error) {
        console.error("Error logging out:", error);
    }

}





const getUserImage = (imageName) => {
    return imageName ? `http://[::1]:5173/public/images/${imageName}` : '../../../public/images/logo.png';
};
</script>

<style scoped>
.img_user {
    border-radius: 10vh;
}

.img_user {
    object-fit: cover;
}
</style>