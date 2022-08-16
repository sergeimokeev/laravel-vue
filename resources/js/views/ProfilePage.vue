<template>
    <h1>Profile page</h1>
    <div class="row" v-if="Object.keys(getUser).length > 0">
        <div class="col-sm-12 col-md-3 order-md-2 pb-3">
            <SideMenu :menu="menu"/>
        </div>
        <div class="col-sm-12 col-md-9 order-md-1">
            <Profile :user="getUser" :data="data" :errors="errors" @update-user="update($event)"/>
        </div>
    </div>
    <div v-else>
        Please sign in or sign up.
    </div>
</template>

<script>
import axios from "../axios";
import Profile from "../components/Profile";
import SideMenu from "../components/UI/SideMenu";

export default {
    components: {SideMenu, Profile},
    data() {
        return {
            data: {
                name: this.$store.state.auth.user.name,
                email: this.$store.state.auth.user.email,
                description: this.$store.state.auth.user.description
            },
            errors: [],
            menu: [
                {"name": "Profile", "uri" : "/profile"},
                {"name": "Posts", "uri" : "/profile/posts"},
                {"name": "Reset password", "uri" : "/profile/reset"},
            ]
        }
    },
    computed: {
        getUser() {
            return this.$store.state.auth.user;
        }
    },
    methods: {
        async update(id) {
            await axios.put('/api/users/' + id,
                {
                    name: this.data.name,
                    email: this.data.email,
                    description: this.data.description,
                })
                .then(response => {
                    this.errors = []
                    this.$toast.success(response.data.message);
                })
                .catch(error => {
                    this.errors = []
                    let errors = error.response.data.errors
                    for (let err of Object.keys(errors)) {
                        if (!this.errors.includes(errors[err][0])) {
                            this.errors.push(errors[err][0])
                        }
                    }
                })
        },
    }
}
</script>
