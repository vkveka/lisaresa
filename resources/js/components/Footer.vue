<template>
    <div id="footer">

        <div class="row text-center m-0 p-0">
            <div class="col-md-3 ">
                <h3> MENU </h3>
                <ul>
                    <li><router-link class="nav-link " aria-current="page" to="/">Accueil</router-link></li>
                    <li><router-link class="nav-link " aria-current="page" to="/about">A propos</router-link></li>
                    <li><router-link class="nav-link " aria-current="page" to="/avis">Avis</router-link></li>
                    <li><router-link class="nav-link " aria-current="page" to="/contact">Contact</router-link></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h3> DESTINATIONS </h3>
                <ul>
                    <li @click="searchAccomodationFooter(30438, 'PARIS')">Paris</li>
                    <li @click="searchAccomodationFooter(28153, 'LYON')">Lyon</li>
                    <li @click="searchAccomodationFooter(4440, 'MARSEILLE')">Marseille</li>
                    <li @click="searchAccomodationFooter(12679, 'BORDEAUX')">Bordeaux</li>
                </ul>
            </div>
            <div class="col-md-3">
                <h3> SOCIAL NETWORKS </h3>
                <ul>
                    <li>Instagram</li>
                    <li>Facebook</li>
                    <li>YouTube</li>
                </ul>
            </div>
            <div class="col-md-3">
                <h3> CONTACT </h3>
                <ul>
                    <li>contact@lisaresa.fr</li>
                    <li>01 23 45 67 89</li>
                    <li>06 23 45 67 89</li>
                    <li>France</li>
                </ul>
            </div>
        </div>
        <div class="col-md-4 text-center mx-auto">
            <img src="../../../public/images/logo/logo_brown.png" alt="logo lisaresa" width="auto" height="40px"
                class="mx-5 mt-5">
        </div>
        <div class="col-md-4 text-center mx-auto">
            <p>2024 &#169; lisaresa.fr</p>
        </div>
    </div>

</template>
<script setup>
import { stringType } from 'ant-design-vue/es/_util/type';
import { useRouter } from 'vue-router';
const router = useRouter()
const searchAccomodationFooter = (location_id, city_name) => {
    const dateIn = new Date().toISOString().split('T')[0];
    const dateOut = new Date().toISOString().split('T')[0];
    const search_query = city_name
    router.push({
        name: 'AccomodationsList',
        query: {
            location_id: location_id,
            date_in: dateIn,
            date_out: dateOut,
            persons: 0,
            search_query: search_query
        }
    });
}
</script>
<style scoped>
#footer {
    color: #9C7C5E;
    padding: 50px 0 30px 0;
    background-color: #f1eeeb;
}

#footer h3 {
    padding-bottom: 20px;
    font-weight: bold;
    font-family: "Julius Sans One", sans-serif;
    font-weight: 400;
    font-style: normal;
}

ul {
    padding: 0;
}

li {
    list-style: none;
    font-style: italic;
    font-size: 17px;
}

li:hover {
    color: #5a4836
}

p {
    color: #9C7C5E;
}
</style>