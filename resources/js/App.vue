<template>
    <Navbar></Navbar>
    <main class="">
        <div v-if="$route.path !== '/'">
            <router-view v-bind:key="$route.fullPath"></router-view>
        </div>
        <div v-else class="homeSearchComponent">
            <HomeSearch></HomeSearch>
        </div>
    </main>
</template>

<script setup>
import Navbar from './components/Navbar.vue';
import HomeSearch from './components/HomeSearch.vue';
</script>

<style scoped>
.homeSearchComponent {
    margin: 0 !important;
    height: 100vh;
    width: 100vw;
    background: url('./images/default_picture_4_dark.jpg');
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
}

.container {
    display: flex;
    justify-content: center;
    padding-top: 100px;
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
