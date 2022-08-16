<template>
    <h1>Edit user form</h1>
    <div class="callout callout-danger" v-if="errors.length > 0">
        <p v-for="error in errors" class="text-danger">{{ error }}</p>
    </div>
    <form @submit.prevent="update($route.params.id)">
        <div class="form-floating mb-3">
            <input v-model="name" type="text" class="form-control rounded-4" id="name" placeholder="Title">
            <label for="title">Name</label>
        </div>
        <div class="form-floating mb-3">
            <input v-model="email" type="email" class="form-control rounded-4" id="email" placeholder="Email">
            <label for="email">Email address</label>
        </div>
        <div class="form-floating mb-3">
            <input v-model="password" type="password" class="form-control rounded-4" id="password" placeholder="Password">
            <label for="password">Password</label>
        </div>
        <div class="form-floating mb-3">
            <input v-model="password_confirmation" type="password" class="form-control rounded-4" id="password_confirmation" placeholder="Password confirmation">
            <label for="password_confirmation">Password confirmation</label>
        </div>
        <button class="mb-2 btn btn-lg rounded-4 btn-primary" type="submit">Update user</button>
    </form>
</template>

<script>
import axios from "../../axios";

export default {
    data() {
        return {
            user: {},
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            errors: []
        }
    },
    created() {
        this.show(this.$route.params.id)
    },
    methods: {
        async show(id) {
            await axios.get('/api/admin/users/' + id)
                .then(response => {
                    this.user = response.data.data;
                    this.name = this.user.name;
                    this.email = this.user.email;
                    this.password = this.user.password;
                    this.password_confiramtion = this.user.password_confiramtion;
                })
        },
        async update(id) {
            await axios.put('/api/admin/users/' + id,
                {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confiramtion: this.password_confiramtion,
                })
                .then(response => {
                    this.$router.push({name: 'adminUsers'})
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
