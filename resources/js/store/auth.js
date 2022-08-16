import axios from "../axios";

export default {
    namespaced: true,
    state: {
        user: window.appUser,
    },
    getters: {},
    mutations: {
        SET_USER(state, user) {
            state.user = user
        }
    },
    actions: {
        async login(_, credentials) {
            return await axios.post('/api/login', credentials)
        }
    }
}
