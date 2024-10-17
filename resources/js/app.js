import './bootstrap';

import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';

import { createApp } from 'vue';
import App from './App.vue'
import router from './router/router'
import { createPinia } from 'pinia'
import piniaPluginPersistedState from 'pinia-plugin-persistedState';
import axio from 'axios'
import VCalendar from 'v-calendar';
import 'v-calendar/dist/style.css';
import { Slider, Switch, InputNumber, Row, Col } from 'ant-design-vue';
const pinia = createPinia();
pinia.use(piniaPluginPersistedState)

createApp(App)
    .use(router)
    .use(pinia)
    .use(VCalendar, {})
    .use(Slider)
    .use(Switch)
    .use(InputNumber)
    .use(Row)
    .use(Col)
    .mount('#app')