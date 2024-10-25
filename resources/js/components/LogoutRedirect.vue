<template>
    <div>Déconnexion en cours...</div>
</template>

<script setup>
import { onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useUserStore } from '../stores/userStore';

const router = useRouter()
const userStore = useUserStore();
onMounted(async () => {
    try {
        await axios.post("/logout", {
            headers: {
                Authorization: `Bearer ${userStore.user.access_token}`
            },
            withCredentials: true
        }
        );
        document.cookie.split(";").forEach((c) => {
            document.cookie = c
                .replace(/^ +/, "")
                .replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/");
        });


    } catch (error) {
        console.error("Error logging out:", error);
    }
    userStore.$reset();
    router.push("/");
});

</script>
