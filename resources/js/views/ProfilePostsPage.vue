<template>
    <h1>Your post list</h1>
    <div v-if="!isPostsLoading">
        <div class="row">
            <div class="col-sm-12 col-md-3 order-md-2 pb-3">
                <SideMenu :menu="menu"/>
            </div>
            <div class="col-sm-12 col-md-9 order-md-1">
                <PostList :posts="posts"/>
            </div>
        </div>
    </div>
    <div v-else>
        <Spinner class="spinner"/>
    </div>
</template>

<script>
import PostList from "../components/PostList";
import Spinner from "../components/UI/Spinner";
import SideMenu from "../components/UI/SideMenu";

export default {
    components: {SideMenu, PostList, Spinner},
    data() {
        return {
            posts: [],
            isPostsLoading: false,
            menu: [
                {"name": "Profile", "uri" : "/profile"},
                {"name": "Posts", "uri" : "/profile/posts"},
                {"name": "Reset password", "uri": "/profile/reset"},
            ]
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
                    user_id: this.$store.state.auth.user.id
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
    }
}
</script>
