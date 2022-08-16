<template>
    <h1>Create user form</h1>
    <div class="callout callout-danger" v-if="errors.length > 0">
        <p v-for="error in errors" class="text-danger">{{ error }}</p>
    </div>
    <form @submit.prevent="create">
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
        <button class="mb-2 btn btn-lg rounded-4 btn-primary" type="submit">Create user</button>
    </form>
</template>

<script>
import axios from "../../axios";

export default {
    data() {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            errors: []
        }
    },
    methods: {
        async create() {
            await axios.post('/api/admin/users/create',
                {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                })
                .then(response => {
                    this.$router.push({name: 'adminUsers'})
                })
                .catch(error => {
                    this.errors = [];
                    let arErrors = error.response.data.errors;
                    for (let err of Object.keys(arErrors)) {
                        if (!this.errors.includes(arErrors[err][0])) {
                            this.errors.push(arErrors[err][0])
                        }
                    }
                })
        },
    },
}
</script>
