<template>
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 200px;">
        <router-link :to="{name: 'adminUsers'}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-4">Dashboard</span>
        </router-link>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto" v-if="sidebarLinks" >
            <li v-for="link in sidebarLinks">
                <router-link :to="link.uri" class="nav-link text-white" :class="($route.path === link.uri) ? 'active' : ''">
                    {{ link.name }}
                </router-link>
            </li>
        </ul>
        <hr>
        <div>
            <router-link :to="{ name: 'home' }" class="nav-link text-white">Homepage</router-link>
            <button @click="logout" type="button" class="btn nav-link text-white">Logout</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            sidebarLinks: [
                {
                    name: 'Users',
                    uri: '/admin/users'
                },
                {
                    name: 'Posts',
                    uri: '/admin/posts'
                }
            ]
        }
    },
    methods: {
        logout() {
            axios.get('/logout')
        }
    }
}
</script>
