<template>
    <h1>Posts list</h1>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div class="col" v-for="post in posts">
            <div class="card shadow-sm">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                     xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                     preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#55595c"/>
                    <text x="42%" y="50%" fill="#eceeef" dy=".3em">{{ post.title }}</text>
                </svg>
                <div class="card-body">
                    <p class="card-text">{{ post.body }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a :href="'/post/' + post.id" class="btn btn-sm btn-outline-secondary" title="View">View</a>
                            <a :href="'/post/edit/' + post.id" class="btn btn-sm btn-outline-secondary" title="Edit">Edit</a>
                        </div>
                        <small class="text-muted">{{ post.created_at_formatted }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data: () => ({
       posts: []
    }),
    mounted() {
        this.loadPosts()
    },
    methods: {
        loadPosts() {
            axios.get('/api/posts')
            .then(response => {
                this.posts = response.data;
            })
        }
    }
}
</script>
