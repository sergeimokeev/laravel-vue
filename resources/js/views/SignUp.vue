<template>
    <div v-if="signUpIsOpen" class="modal modal-signup d-block py-5" tabindex="-1" role="dialog" id="modalSignup">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-5 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h2 class="fw-bold mb-0">Sign up</h2>
                    <button @click="$emit('closeSignUp')" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="callout callout-danger mx-5" v-if="errors.length > 0">
                    <p v-for="error in errors" class="text-danger">{{ error }}</p>
                </div>
                <div class="modal-body p-5 pt-0">
                    <form v-on:submit.prevent="register">
                        <div class="form-floating mb-3">
                            <input v-model="first_name" type="text" class="form-control rounded-4" id="first_name" placeholder="Name">
                            <label for="name">Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input v-model="last_name" type="text" class="form-control rounded-4" id="second_name" placeholder="Last name">
                            <label for="second_name">Last name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" v-model="email" class="form-control rounded-4" id="email" placeholder="name@example.com">
                            <label for="email">Email address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" v-model="password" class="form-control rounded-4" id="password" placeholder="Password">
                            <label for="password">Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" v-model="password_confirmation" class="form-control rounded-4" id="password_confirmation" placeholder="Confirm password">
                            <label for="password_confirmation">Confirm password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea v-model="description" class="form-control rounded-4" id="description" placeholder="Description"
                                      style="height:120px">
                            </textarea>
                            <label for="description">Description</label>
                        </div>
                        <button class="mb-2 btn btn-lg rounded-4 btn-primary" type="submit">Sign up</button>
                        <div><small class="text-muted">By clicking Sign up, you agree to the terms of use.</small></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data(){
        return {
            first_name: '',
            last_name: '',
            email: '',
            password: '',
            password_confirmation: '',
            description: '',
            errors: []
        }
    },
    methods: {
        register() {
            axios.post('/api/register',
                {
                    name: this.first_name +' '+ this.last_name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                    description: this.description
                })
                .then(response => {
                    this.$emit('closeSignUp')
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
        },
    },
    props: {
        signUpIsOpen: {
            type: Boolean,
            default: false
        }
    }
}
</script>
