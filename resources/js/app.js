import './bootstrap';

import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';

import { createApp } from 'vue';
import App from './App.vue'
import router from './router/router'
import { createPinia } from 'pinia'
import piniaPluginPersistedState from 'pinia-plugin-persistedState'
import axio from 'axios'
import VCalendar from 'v-calendar';
import 'v-calendar/style.css';

const pinia = createPinia();
pinia.use(piniaPluginPersistedState)

createApp(App).use(router).use(pinia).use(VCalendar, {}).mount('#app')