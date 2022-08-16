<template xmlns="http://www.w3.org/1999/html">
    <h1>Post list</h1>
    <div v-if="!isPostsLoading">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start mb-3">
            <Search v-model="searchQuery" @update:modelValue="loadPosts"/>
            <Sorting v-model="selectedSort" :options="sortOptions" @update:modelValue="loadPosts"/>
        </div>
        <Posts :posts="posts"/>
        <Pagination :page="page" :totalPages="totalPages" @page-changed="changePage($event)" v-if="totalPages > 1"/>
    </div>
    <div v-else>
        <Spinner class="spinner"/>
    </div>
</template>

<script>
import axios from '../axios';
import Posts from '../components/PostList'
import Sorting from "../components/UI/Sorting";
import Search from "../components/UI/Search";
import Pagination from "../components/UI/Pagination";
import Spinner from "../components/UI/Spinner";

export default {
    components: {Spinner, Pagination, Posts, Sorting, Search},
    data() {
        return {
            posts: [],
            isPostsLoading: false,
            perPage: 9,
            page: 1,
            totalPages: 0,
            searchQuery: '',
            selectedSort: '',
            sortOptions: [
                {value: 'created_at', name: 'По дате'},
                {value: 'title', name: 'По названию'},
                {value: 'preview', name: 'По описанию'}
            ]
        }
    },
    created() {
        this.loadPosts()
    },
    methods: {
        async loadPosts() {
            this.isPostsLoading = true
            await axios.get('/api/posts', {
                params: {
                    per_page: this.perPage,
                    page: this.page,
                    query: this.searchQuery.toLowerCase(),
                    sort: this.selectedSort
                }
            })
                .then(response => {
                    this.posts = response.data.data.posts;
                    this.totalPages = response.data.data.total_pages
                })
                .catch(error => {
                    console.debug(error)
                }).finally(() =>
                    this.isPostsLoading = false
                )
        },
        changePage(pageNumber) {
            this.page = pageNumber
            this.loadPosts()
        }
    }
}
</script>
