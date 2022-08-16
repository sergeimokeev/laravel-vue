<template>
    <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 align-items-stretch g-4 py-3" v-if="authorsData.length > 0">
        <div class="col" v-for="author in authorsData" :key="author.id">
            <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg">
                <router-link :to="{name: 'detailedAuthor', params: {id: author.id}}"
                             class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1 text-decoration-none">
                    <h2 class="mb-4 display-6 lh-1 fw-bold">{{ author.name }}</h2>
                    <ul class="d-flex list-unstyled mt-auto">
                        <li class="me-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor"
                                 class="bi bi-person" viewBox="0 0 16 16">
                                <path
                                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                            </svg>
                        </li>
                        <li class="d-flex align-items-center me-3">
                            <small>Joined {{ author.created_at }}</small></li>
                        <li class="d-flex align-items-center">
                            <small>Posts wrote: {{ author.posts_count }}</small></li>
                    </ul>
                </router-link>
            </div>
        </div>
    </div>
    <div v-else>
        <div class="callout">
            No authors found
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            authorsData: this.authors
        }
    },
    props: {
        authors: {
            type: Array,
            require: true
        }
    }
}
</script>
