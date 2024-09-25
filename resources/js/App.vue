<template>
    <main>
        <div v-if="$route.path !== '/'">
            <router-view v-bind:key="$route.fullPath"></router-view>
        </div>
        <div v-else>
            <Navbar></Navbar>
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
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

#logo {
    max-width: 50%;
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
