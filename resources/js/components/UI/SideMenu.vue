<template>
    <nav class="navbar bg-primary rounded-4">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li v-for="item in menu" class="nav-item ps-3">
                    <router-link class="nav-link text-white" :class="($route.path === item.uri) ? 'disabled text-opacity-75' : ''"
                       :to="item.uri">{{ item.name }}</router-link>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
export default {
    props: {
        menu: {
            type: Array,
            required: true
        }
    }
}
</script>
