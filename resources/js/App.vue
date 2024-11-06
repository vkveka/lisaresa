<template>
    <Navbar></Navbar>
    <main class="">
        <div v-if="$route.path !== '/'">
            <router-view v-bind:key="$route.fullPath"></router-view>
        </div>
        <div v-else class=" w-100 m-0">
            <HomeSearch class="homeSearchComponent w-100 container"></HomeSearch>

            <section class="p-5 section_1">
                <h3>Notre plateforme conviviale <br>
                    simplifiée vous ouvre les portes de logements uniques.</h3>
                <h3 class="text-end">Explorez, réservez et vivez une expérience inoubliable. </h3>
                <div class="d-flex justify-content-between align-items-center">
                    <h3>Réservez en toute simplicité et vivez <br> des expériences uniques.</h3>
                    <button type="button" class="btn btn-green">Réserver</button>
                </div>
            </section>
            <section class="section_2 p-5">
                <h2 class="mb-5">POINTS FORTS</h2>
                <div class="row col-md-10 mx-auto">
                    <div class="col-md-4 text-center">
                        <i class="fa fa-star fa-3x mb-4"></i>
                        <h3>EVASION LUXUEUSE</h3>
                        <p class="mx-auto">
                            Confort, hospitalité chaleureuse, expériences uniques, offertes par notre charmante maison
                            d'hôte
                        </p>
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="fa fa-heart fa-3x mb-4"></i>
                        <h3>REFUGE INTIME</h3>
                        <p class="mx-auto">
                            Elégance, tranquillité, attentions personnalisées, dans notre accueillante maison d'hôte de
                            charme
                        </p>
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="fa fa-user fa-3x mb-4"></i>
                        <h3>OUVERT A TOUS</h3>
                        <p class="mx-auto">
                            Aménagements pensés, accueil inclusif, pour une expérience sans barrières
                        </p>
                    </div>
                </div>
            </section>
            <section class="testimonials p-5">
                <h2>TEMOIGNAGES</h2>
            </section>
        </div>
    </main>
    <Footer></Footer>
</template>

<script setup>
import Navbar from './components/Navbar.vue';
import HomeSearch from './components/HomeSearch.vue';
import Footer from './components/Footer.vue';
</script>

<style scoped>
.testimonials {
    height: auto;
    background: url(/images/testimonials.jpeg);
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.testimonials h2 {
    color: white;
    text-align: center;
}

.btn-green {
    background-color: #647357;
    color: #fff;
    border: none;

}

.section_1 button {
    padding: 6px 25px;
    font-size: x-large;
    margin-right: 100px
}

.btn-green:hover {
    background-color: #4c5742;
}

.section_1 h3 {
    color: #9C7C5E;
    font-family: "Julius Sans One", sans-serif;
    font-weight: 400;
    font-style: normal;
    padding: 15px;
}

.section_1 {
    height: auto;
    background: url(/images/Rectangle_176.png);
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.section_2 {
    background-color: #f1eeeb;
}

.section_2 p {
    font-size: 17px;
    max-width: 80%;
}

.section_2 p,
.section_2 i {
    color: #9C7C5E;
}

.section_2 h3,
.section_2 h2 {
    font-family: "Julius Sans One", sans-serif;
    font-weight: 400;
    font-style: normal;
    color: #9C7C5E;
    font-weight: bold;
    text-align: center;
}

.homeSearchComponent {
    /* margin: 0 !important; */
    max-height: 100vh;
    /* width: 100vw !important; */
    background: url('/images/header.jpeg');
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
}

.container {
    padding: 100px 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 100vw;
    max-width: 3000px !important;
}

.parentSearchInput {
    border-radius: 2vh;
    border: 1px solid rgba(128, 128, 128, 0.377);
    padding: 10px;
}

.parentSearchInput input[placeholder] {
    font-style: italic;
}
</style>
