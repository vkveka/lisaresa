<template>
    <div>
        <!-- <router-link :to="{ name: 'AccomodationDetails', params: { id: accomodation.id } }" style="text-decoration: none;"> -->
        <div class="card" style="width: 350px;border: none; border-top-left-radius: 5px; border-top-right-radius: 5px;">
            <div class="card-content">
                <div class="card-body d-flex flex-column p-0 m-0" style=" border: 0 solid transparent;">
                    <img :src="'./images/accomodations/' + accomodation.id + '/' + accomodation.images[0].name"
                        alt="image logement lisaresa"
                        style="border-top-left-radius: 5px; border-top-right-radius: 5px;">
                    <span class="fw-bold fs-5 m-3">
                        {{ accomodation.name }}
                    </span>
                    <span class="fw-bold ms-3">
                        {{ accomodation.price }}€ /nuit
                    </span>
                    <span class="m-3 description">
                        {{ accomodation.description }}
                    </span>
                </div>
            </div>
        </div>
        <!-- </router-link> -->
    </div>
</template>
<script setup>
import { defineProps } from 'vue';

defineProps({
    accomodation: {
        type: Object,
        required: true,
    }
});

</script>
<style scoped>
.card-body {
    height: 400px;
}

.card-body img {
    height: 250px;
    object-fit: cover;
}

.description {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    width: 90%;
    display: inline-block;
}
</style>