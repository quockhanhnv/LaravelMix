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

const store = new Vuex.Store(StoreData)

const router = new VueRouter({
    routes,
    mode: 'history'
})

router.beforeEach((to, from, next) => {
    const requiresAuth = to.matched.some(record => record.meta.requiresAuth)
    const currentUser = store.state.currentUser
    if(requiresAuth && !currentUser) {
        next('/login')
    } else if(to.path == '/login' && currentUser) { // if authen and go to login we will redirect to home
        next('/')
    } else {
        next()
    }
})

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        MainApp
    }
});
