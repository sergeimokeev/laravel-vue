<template>
    <nav aria-label="Page navigation" class="pt-4">
        <ul class="pagination">
            <li class="page-item" :class="{ 'disabled' : page === 1}">
                <span @click="pageChanged(this.page - 1)" class="page-link">Previous</span>
            </li>
            <li class="page-item" v-for="pageNumber in totalPages" :key="pageNumber">
                    <span class="page-link" @click="pageChanged(pageNumber)"
                          :class="{ 'active' : page === pageNumber }">{{ pageNumber }}
                    </span>
            </li>
            <li class="page-item" :class="{ 'disabled' : page === totalPages}">
                <span class="page-link" @click="pageChanged(this.page + 1)">Next</span>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props: {
        page: {
            type: Number
        },
        totalPages: {
            type: Number
        }
    },
    methods: {
        pageChanged(pageNumber) {
            this.$emit('pageChanged', pageNumber)
        }
    },
}
</script>
