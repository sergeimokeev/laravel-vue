<template>
    <DetailedAuthor :author="author"/>
</template>

<script>
import axios from "../axios";
import DetailedPost from "../components/DetailedPost";
import DetailedAuthor from "../components/DetailedAuthor";

export default {
    components: {DetailedAuthor},
    data() {
        return {
            author: {}
        }
    },
    created() {
        this.loadAuthor(this.$route.params.id)
    },
    methods: {
        async loadAuthor(id) {
            await axios.get('/api/users/' + id)
                .then(response => {
                    this.author = response.data.data
                })
        }
    },
    props: {
        id: {
            type: Number
        }
    }
}
</script>
