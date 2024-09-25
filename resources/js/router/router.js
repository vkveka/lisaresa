import { createRouter, createWebHistory } from 'vue-router'
import App from '../App.vue'
import Login from '../components/Login.vue'
import Register from '../components/Register.vue'


const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'home',
            component: App
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
        },
        {
            path: '/logout',
            name: 'logout',
        },
        // {
        //     path: '/user/:id',
        //     name: 'user',
        //     component: EditAccount
        // },
    ]
})

export default router
