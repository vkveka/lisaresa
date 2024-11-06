<template>
    <div class="row text-center" id="footer">
        <div class="col-md-3">
            <h3> MENU </h3>
            <ul>
                <li>Accueil</li>
                <li>A propos</li>
                <li>Avis</li>
                <li>Contact</li>
            </ul>
        </div>
        <div class="col-md-3">
            <h3> DESTINATIONS </h3>
            <ul>
                <li>Paris</li>
                <li>Lyon</li>
                <li>Marseille</li>
                <li>Bordeaux</li>
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
</template>
<script setup>
</script>
<style scoped>
#footer {
    color: #9C7C5E;
    padding: 50px 0;
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

p {
    color: #9C7C5E;
}
</style>