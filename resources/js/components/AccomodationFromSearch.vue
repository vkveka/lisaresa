<template>
    <div>
        <div class="card">
            <div class="card-content">
                <div class="card-header">{{ accomodation.name }}</div>
                <div class="card-body">{{ accomodation.price }}</div>
                <div class="card-footer">{{ accomodation.description }}</div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { defineProps } from 'vue';

defineProps([
    'accomodation',
])

</script>
<style></style>