require('./bootstrap');
import Main from "./Main";
import * as Vue from "vue";
import * as VueRouter from "vue-router";
import store from "./store";
import filters from "./filters"
import Toaster from "@meforma/vue-toaster";

const routes = [
    {
        path: '/', component: () => import("./layout/Public"), name: 'public', children: [
            {path: '', component: () => import("./views/Index"), name: 'home'},
            {path: '/contacts', component: () => import("./views/ContactsPage"), name: 'contacts'},
            {path: '/about', component: () => import("./views/About"), name: 'about'},
            {path: '/authors', component: () => import("./views/AuthorsPage"), name: 'authors'},
            {path: '/authors/:id', component: () => import("./views/AuthorPage"), props: true, name: 'detailedAuthor'},
            {path: '/profile', component: () => import("./views/ProfilePage"), name: 'profile'},
            {path: '/profile/posts', component: () => import("./views/ProfilePostsPage"), name: 'profilePosts'},
            {path: '/profile/reset', component: () => import("./views/ProfileResetPasswordPage"), name: 'profileReset'},
            {path: '/posts', component: () => import("./views/PostsPage"), name: 'postList'},
            {path: '/posts/:slug', component: () => import("./views/PostPage"), props: true, name: 'detailedPost'},
        ]
    },
    {
        path: '/admin', component: () => import("./layout/Admin"), name: 'admin', children: [
            {path: '', component: () => import("./views/Admin/Index"), redirect: '/admin/users', name: 'adminHome'},
            {path: '/admin/users', component: () => import("./views/Admin/AdminUsers"), name: 'adminUsers'},
            {path: '/admin/users/create', component: () => import("./views/Admin/AdminCreateUser"), name: 'createUser'},
            {
                path: '/admin/users/edit/:id',
                component: () => import("./views/Admin/AdminEditUser"),
                props: true,
                name: 'editUser'
            },
            {path: '/admin/posts', component: () => import("./views/Admin/AdminPosts"), name: 'adminPosts'},
            {path: '/admin/posts/create', component: () => import("./views/Admin/AdminCreatePost"), name: 'createPost'},
            {
                path: '/admin/posts/edit/:id',
                component: () => import("./views/Admin/AdminEditPost"),
                props: true,
                name: 'editPost'
            },
        ]
    },

    {path: "/:catchAll(.*)*", component: () => import("./views/Error404.vue")}
]

const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory(),
    routes,
})

// router.beforeEach()

const app = Vue.createApp(Main)
app.config.globalProperties.$filters = filters
app.use(router).use(store).use(Toaster)
app.mount('#app')

