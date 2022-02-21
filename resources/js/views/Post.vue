<template>
    <h1>{{ post.title }}</h1>
    <small>{{ post.created_at_formatted }}</small>
    <p>{{ post.body }}</p>
</template>

<script>
import axios from "axios";

export default {
    data: () => ({
        post: []
    }),
    mounted() {
        this.loadPost(this.$route.params.id)
    },
    methods: {
        loadPost(id) {
            axios.get('/api/posts/' + id)
            .then(response => {
                this.post = response.data
            })
        }
    }
}
</script>
