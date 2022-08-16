<template>
    <h1>Edit post form</h1>
    <div class="callout callout-danger" v-if="errors.length > 0">
        <p v-for="error in errors" class="text-danger">{{ error }}</p>
    </div>
    <form @submit.prevent="update($route.params.id)">
        <div class="form-floating mb-3">
            <input v-model="title" type="text" class="form-control rounded-4" id="title" placeholder="Title">
            <label for="title">Title</label>
        </div>
        <div class="form-floating mb-3">
            <input v-model="slug" type="text" class="form-control rounded-4" id="slug" placeholder="Slug">
            <label for="slug">Slug</label>
        </div>
        <div class="form-floating mb-3">
            <input v-model="preview" type="text" class="form-control rounded-4" id="preview" placeholder="Slug">
            <label for="preview">Preview</label>
        </div>
        <div class="form-floating mb-3">
            <textarea v-model="body" class="form-control rounded-4" id="body" placeholder="Description"
                      style="height:120px">
            </textarea>
            <label for="body">Description</label>
        </div>
        <div class="mb-3">
            <input class="form-check-input me-1" v-model="is_published" type="checkbox" id="is_published">
            <label for="is_published">Опубликовать?</label>
        </div>
        <button class="mb-2 btn btn-lg rounded-4 btn-primary" type="submit">Update post</button>
    </form>
</template>

<script>
import axios from "../../axios";

export default {
    data() {
        return {
            post: {},
            title: '',
            slug: '',
            preview: '',
            body: '',
            is_published: false,
            user_id: 1,
            errors: []
        }
    },
    created() {
        this.show(this.$route.params.id)
    },
    methods: {
        async show(id) {
            await axios.get('/api/admin/posts/' + id)
                .then(response => {
                    this.post = response.data.data;
                    this.title = this.post.title;
                    this.slug = this.post.slug;
                    this.preview = this.post.preview;
                    this.body = this.post.body;
                    this.is_published = this.post.is_published;
                })
        },
        async update(id) {
            await axios.put('/api/admin/posts/' + id,
                {
                    title: this.title,
                    slug: this.slug,
                    preview: this.slug,
                    body: this.body,
                    is_published: this.is_published,
                    user_id: this.user_id,
                })
                .then(response => {
                    this.$router.push({name: 'adminPosts'})
                })
                .catch(error => {
                    this.errors = [];
                    let errors = error.response.data.errors;
                    for (let err of Object.keys(errors)) {
                        if (!this.errors.includes(errors[err][0])) {
                            this.errors.push(errors[err][0])
                        }
                    }
                })
        },
    },
}
</script>
