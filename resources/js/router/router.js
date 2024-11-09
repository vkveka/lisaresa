import { createRouter, createWebHistory } from 'vue-router'
import App from '../App.vue'
import Login from '../components/Login.vue'
import Register from '../components/Register.vue'
import AccomodationDetails from '../components/AccomodationDetails.vue'
import AccomodationsList from '../components/AccomodationsList.vue'
import MyAccount from '../components/MyAccount.vue'
import LogoutRedirect from '../components/LogoutRedirect.vue'
import About from '../components/About.vue'
import Destinations from '../components/Destinations.vue'
import Avis from '../components/Avis.vue'
import Contact from '../components/Contact.vue'
import Cgu from '../components/Cgu.vue'

const router = createRouter({
    history: createWebHistory('/'),
    routes: [
        {
            path: '/',
            name: 'home',
            component: App
        },
        {
            path: '/about',
            name: 'about',
            component: About
        },
        {
            path: '/destinations',
            name: 'destinations',
            component: Destinations
        },
        {
            path: '/avis',
            name: 'avis',
            component: Avis
        },
        {
            path: '/contact',
            name: 'contact',
            component: Contact
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
            path: '/user',
            name: 'UserProfile',
            component: MyAccount
        },
        {
            path: '/cgu',
            name: 'CGU',
            component: Cgu
        },
    ],
})

export default router
