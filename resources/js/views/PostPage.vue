<template>
    <DetailedPost :post="post"/>
</template>

<script>
import axios from "../axios";
import DetailedPost from "../components/DetailedPost";

export default {
    components: {DetailedPost},
    data() {
        return {
            post: {
                user: {}
            }
        }
    },
    created() {
        this.loadPost(this.$route.params.slug)
    },
    methods: {
        async loadPost(slug) {
            await axios.get('/api/posts/' + slug)
                .then(response => {
                    this.post = response.data.data
                })
        }
    },
    props: {
        slug: {
            type: String
        }
    }
}
</script>
