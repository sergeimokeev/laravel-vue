<template>
    <header class="p-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <span class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                         stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2"
                         viewBox="0 0 24 24">
                        <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                        <circle cx="12" cy="13" r="4"/>
                    </svg>
                </span>
                <ul v-if="headerMenu.length > 0"
                    class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <router-link v-for="headerLink in headerMenu" :to="{ path: headerLink.uri }" class="nav-link px-2" :class="($route.path === headerLink.uri) ? 'text-secondary' : 'text-white'">
                        {{ headerLink.name }}
                    </router-link>
                </ul>

                <div class="text-end" v-if="Object.keys(getUser).length > 0">
                    <a href="/admin" class="btn btn-dark me-2">Admin</a>
<!--                    <router-link :to="{ name: 'adminHome'}" class="btn btn-dark me-2">Admin</router-link>-->
                    <router-link :to="{ name: 'profile'}" class="btn btn-dark me-2">Profile</router-link>
                    <button @click="logout" type="button" class="btn btn-outline-light">Logout</button>
                </div>
                <div v-else class="text-end" >
                    <button type="button" @click="signInIsOpen = !signInIsOpen" class="btn btn-dark me-2">SignIn</button>
                    <button type="button" @click="signUpIsOpen = !signInIsOpen" class="btn btn-outline-light">SignUp
                    </button>
                </div>
            </div>
        </div>
    </header>
    <Teleport to="#app">
        <sign-in :signInIsOpen="signInIsOpen" @closeSignIn="signInIsOpen = !signInIsOpen"/>
    </Teleport>
    <Teleport to="#app">
        <sign-up :signUpIsOpen="signUpIsOpen" @closeSignUp="signUpIsOpen = !signUpIsOpen"/>
    </Teleport>
</template>

<script>
import SignUp from "../views/SignUp";
import SignIn from "../views/SignIn";

export default {
    components: {SignIn, SignUp},
    data() {
        return {
            signInIsOpen: false,
            signUpIsOpen: false,
            headerMenu: [
                {name: 'Home', uri: '/'},
                {name: 'Posts', uri: '/posts'},
                {name: 'Authors', uri: '/authors'},
                {name: 'About', uri: '/about'},
                {name: 'Contacts', uri: '/contacts'}
            ]
        }
    },
    computed: {
        getUser() {
            return this.$store.state.auth.user;
        }
    },
    methods: {
        logout() {
            axios.post('/api/logout')
                .then(response => {
                    this.$store.commit('auth/SET_USER', {})
                })
        }
    }
}
</script>
