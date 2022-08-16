<template>
    <div v-if="signInIsOpen" class="modal modal-signin d-block py-5" tabindex="-1" role="dialog" id="modalSignin">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-5 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h2 class="fw-bold mb-0">Sign In</h2>
                    <button @click="$emit('closeSignIn')" type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="callout callout-danger mx-5" v-if="errors.length > 0">
                    <p v-for="error in errors" class="text-danger">{{ error }}</p>
                </div>
                <div class="modal-body p-5 pt-0">
                    <form @submit.prevent="submit">
                        <div class="form-floating mb-3">
                            <input v-model="email" type="email" class="form-control rounded-4" id="email"
                                   placeholder="name@example.com">
                            <label for="email">Email address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input v-model="password" type="password" class="form-control rounded-4" id="password"
                                   placeholder="Password">
                            <label for="password">Password</label>
                        </div>
                        <button class="mb-2 btn btn-lg rounded-4 btn-primary" type="submit">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
    data() {
        return {
            email: '',
            password: '',
            errors: []
        }
    },
    methods: {
        ...mapActions({
            login: 'auth/login'
        }),
        submit() {
            const result = this.login({
                email: this.email,
                password: this.password
            })
            result.then(response => {
                this.$store.commit('auth/SET_USER', response.data.user)
                this.$emit('closeSignIn')
                this.errors = []
                this.$router.push({name: 'profile'})
            })
            .catch(error => {
                let errors = error.response.data.errors;
                for (let err of Object.keys(errors)) {
                    if (!this.errors.includes(errors[err][0])) {
                        this.errors.push(errors[err][0])
                    }
                }
            })
        }
    },
    props: {
        signInIsOpen: {
            type: Boolean,
            default: false
        }
    }
}
</script>
