<template>
    <Navbar class="mb-5"></Navbar>
    <main class="">
        <div v-if="$route.path !== '/'">
            <router-view v-bind:key="$route.fullPath"></router-view>
        </div>
        <div v-else>
            <HomeSearch></HomeSearch>
        </div>
    </main>
</template>

<script setup>
import Navbar from './components/Navbar.vue';
import HomeSearch from './components/HomeSearch.vue';
</script>

<style scoped>
.container {
    display: flex;
    justify-content: center;
    margin-top: 100px;
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
