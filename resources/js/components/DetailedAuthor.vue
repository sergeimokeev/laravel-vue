<template>
    <h1>{{ author.name }}'s author page</h1>
    <ul>
        <li>Posts wrote: {{ author.posts_count }}</li>
        <li>Joined: {{ author.created_at }}</li>
    </ul>
    <div>{{ author.description }}</div>

    <div class="d-flex justify-content-end mt-4">
        <a class="btn btn-dark" @click="$router.go(-1)">Go back</a>
    </div>
    <hr/>
    <PostList :posts="posts">
        <template #title>
            <h2>Author's post list</h2>
        </template>
    </PostList>
</template>

<script>
import PostList from "./PostList";

export default {
    components: {PostList},
    data() {
        return {
            posts: [],
            isPostsLoading: false
        }
    },
    created() {
        this.loadPosts()
    },
    methods: {
        async loadPosts() {
            this.isPostsLoading = true
            await axios.get('/api/posts', {
                params: {
                    user_id: this.$route.params.id,
                    authors: true
                }
            })
                .then(response => {
                    this.posts = response.data.data.posts
                })
                .catch(error => {
                    console.debug(error)
                })
                .finally(() => {
                    this.isPostsLoading = false
                })
        }
    },
    props: {
        author: {
            type: Object,
            required: true
        }
    }
}
</script>
