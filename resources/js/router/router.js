import { createRouter, createWebHistory } from 'vue-router'
import App from '../App.vue'
import Login from '../components/Login.vue'
import Register from '../components/Register.vue'
import AccomodationDetails from '../components/AccomodationDetails.vue'
import AccomodationsList from '../components/AccomodationsList.vue'
import MyAccount from '../components/MyAccount.vue'
import LogoutRedirect from '../components/LogoutRedirect.vue'

const router = createRouter({
    history: createWebHistory('/'),
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
            path: '/accomodation/:id',
            name: 'AccomodationDetails',
            component: AccomodationDetails,
            props: true
        },
        {
            path: '/accomodations',
            name: 'AccomodationsList',
            component: AccomodationsList,
        },
        {
            path: '/logout',
            name: 'logout',
            component: LogoutRedirect,
        },
        {
            path: '/user/:id',
            name: 'UserProfile',
            component: MyAccount
        },
    ]
})

export default router
