<template>
    <h1>Author list</h1>
    <div v-if="!isAuthorsLoading">
        <AuthorList :authors="authors"/>
        <Pagination :page="page" :totalPages="totalPages" @page-changed="changePage($event)" v-if="totalPages > 1"/>
    </div>
    <Spinner v-else class="spinner"/>
</template>

<script>
import AuthorList from "../components/AuthorList";
import Pagination from "../components/UI/Pagination";
import Spinner from "../components/UI/Spinner";

export default {
    components: {Spinner, Pagination, AuthorList},
    data() {
        return {
            authors: [],
            isAuthorsLoading: false,
            perPage: 9,
            page: 1,
            totalPages: 0,
        }
    },
    created() {
        this.loadAuthors()
    },
    methods: {
        async loadAuthors() {
            this.isAuthorsLoading = true;
            await axios.get('/api/users', {
                params: {
                    authors: true,
                    per_page: this.perPage,
                    page: this.page
                }
            })
                .then(response => {
                    this.authors = response.data.data.users
                    this.totalPages = response.data.data.total_pages
                })
                .catch(error => {
                    console.debug(error)
                })
                .finally(() =>
                    this.isAuthorsLoading = false
                );
        },
        changePage(pageNumber) {
            this.page = pageNumber
            this.loadAuthors()
        }
    }
}
</script>
