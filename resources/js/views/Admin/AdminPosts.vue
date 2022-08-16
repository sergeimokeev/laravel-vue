<template>
    <h1>Posts list</h1>
    <table class="table" v-if="posts.length > 0">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Slug</th>
            <th scope="col">Is published</th>
            <th scope="col">Author</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col" class="d-grid">
                <router-link :to="{ name: 'createPost' }"
                             class="btn btn-sm btn-outline-secondary">Create
                </router-link>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="post in posts">
            <th scope="row">{{ post.id }}</th>
            <td>{{ post.title }}</td>
            <td>{{ post.slug }}</td>
            <td>{{ (post.is_published) ? 'Yes' : 'No' }}</td>
            <td>{{ post.user.name }}</td>
            <td>{{ post.created_at }}</td>
            <td>{{ post.updated_at }}</td>
            <td>
                <div class="d-flex btn-group">
                    <router-link :to="{ name: 'editPost', params: {id: post.id} }"
                                 class="btn btn-sm btn-outline-secondary">Edit
                    </router-link>
                    <button @click="deletePost(post.id)" class="btn btn-sm btn-outline-secondary">Delete</button>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <div v-else class="callout">Posts list is empty</div>
</template>

<script>
import axios from '../../axios';

export default {
    data() {
        return {
            posts: []
        }
    },
    created() {
        this.loadPosts()
    },
    methods: {
        async loadPosts() {
            await axios.get('/api/admin/posts')
                .then(response => {
                    this.posts = response.data.data;
                })
        },
        async deletePost(id) {
            await axios.delete('/api/admin/posts/' + id)
                .then(response => {
                    this.posts = this.posts.filter(p => p.id !== id);
                })
        }
    }
}
</script>
