import Axios from "axios";

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'
import Vuex from 'vuex'
import { routes } from "./routes";

// import component
import MainApp from './components/MainApp.vue'
import StoreData from './store'
Vue.use(VueRouter)
Vue.use(Vuex)

// import function
import {initialize} from './helpers/general.js'

const store = new Vuex.Store(StoreData)

const router = new VueRouter({
    routes,
    mode: 'history'
})

// be like middleware
initialize(store, router)

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        MainApp
    }
});
