<template>
        <div class="callout callout-danger" v-if="errors.length > 0">
            <p v-for="error in errors" class="text-danger">{{ error }}</p>
        </div>
        <form @submit.prevent="updateUser(user.id)">
            <div class="form-floating mb-3">
                <input v-model="data.name" type="text" class="form-control rounded-4" id="name" placeholder="Title">
                <label for="title">Name</label>
            </div>
            <div class="form-floating mb-3">
                <input v-model="data.email" type="email" class="form-control rounded-4" id="email" placeholder="Email">
                <label for="email">Email address</label>
            </div>
            <div class="form-floating mb-3">
                <textarea v-model="data.description" class="form-control rounded-4" id="description" placeholder="Description"
                          style="height:120px">
                </textarea>
                <label for="description">Description</label>
            </div>
            <button class="mb-2 btn btn-lg rounded-4 btn-primary" type="submit">Update user</button>
        </form>
</template>

<script>
export default {
    props: {
        user: {
            type: Object
        },
        data: {
            type: Object
        },
        errors: {
            type: Array
        }
    },
    methods: {
        updateUser(id) {
            this.$emit('updateUser', id)
        }
    },
    emits: ['updateUser']
}
</script>
