<template>
    <h1>Users list</h1>
    <table class="table" v-if="users.length > 0">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Roles</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col" class="d-grid">
                <router-link :to="{ name: 'createUser' }"
                             class="btn btn-sm btn-e btn-outline-secondary">Create
                </router-link>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="user in users">
            <th scope="row">{{ user.id }}</th>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>{{ (user.roles.length > 0) ? user.roles.join(', ') : ''}}</td>
            <td>{{ user.created_at }}</td>
            <td>{{ user.updated_at }}</td>
            <td>
                <div class="d-flex btn-group">
                    <router-link :to="{ name: 'editUser', params: {id: user.id} }"
                                 class="btn btn-sm btn-outline-secondary">Edit
                    </router-link>
                    <button @click="deleteUser(user.id)" class="btn btn-sm btn-outline-secondary">Delete</button>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <div v-else class="callout">Users list is empty</div>
</template>

<script>
import axios from '../../axios';

export default {
    data() {
        return {
            users: []
        }
    },
    created() {
        this.loadUsers()
    },
    methods: {
        async loadUsers() {
            await axios.get('/api/admin/users')
                .then(response => {
                    this.users = response.data.data;
                })
        },
        async deleteUser(id) {
            await axios.delete('/api/admin/users/' + id)
                .then(response => {
                    this.users = this.users.filter(u => u.id !== id);
                })
        }
    }
}
</script>
