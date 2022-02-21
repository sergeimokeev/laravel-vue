<template>
    <form action="" method="POST">
        <div class="card">
            <div class="card-header">
                <h1>Опубликовать пост</h1>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <label for="title" class="col-md-4 col-form-label text-md-end">Заголовок</label>
                    <div class="col-md-6">
                        <input id="title" class="form-control" v-model="form.title"
                               name="title"
                               type="text">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="body" class="col-md-4 col-form-label text-md-end">Содержимое</label>
                    <div class="col-md-6">
                        <textarea id="body" class="form-control" name="body" rows="5" v-model="form.body"
                        ></textarea>
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button class="btn btn-primary" @click.prevent="store">
                            Опубликовать
                        </button>
                    </div>
                </div>
                <div class="row mt-2" v-if="errors">
                    <div class="col-md-6 offset-md-4">
                        <div class="alert alert-danger">
                            <ul>
                                <li v-for="error in errors">{{ error }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
import axios from "axios";

export default {
    data: () => ({
        form: {
            title: "",
            body: ""
        },
        errors: false,
    }),
    methods: {
        store() {
            axios.post('/api/posts', this.form, {
                headers: {
                    "Content-type": "application/json"
                }
            })
                .then(response => {
                    if (response.data.status) {
                        this.$router.push('/post/' + response.data.post.id)
                    }
                })
                .catch(errors => {
                    this.errors = errors.response.data.errors;
                    console.log(errors.response.data.errors)
                })
        }
    }
}
</script>

