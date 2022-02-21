require('./bootstrap');
import Main from "./Main";
import * as Vue from 'vue';
import * as VueRouter from 'vue-router';

const routes = [
    {path: '/', component: () => import("./views/Index")},
    {path: '/post/:id', component: () => import("./views/Post")},
    {path: '/post/create', component: () => import("./views/CreatePost")},
    {path: "/:catchAll(.*)*", component: () => import("./views/Error404.vue")}
]

const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory(),
    routes,
})

const app = Vue.createApp(Main)
app.use(router)
app.mount('#app')
