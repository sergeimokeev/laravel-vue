<template>
    <div v-if="posts.length > 0">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3">
            <div class="col" v-for="post in posts">
                <div class="card shadow-sm h-100 overflow-hidden">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                         xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                         preserveAspectRatio="xMidYMid slice" focusable="false"><title>Post</title>
                        <rect width="100%" height="100%" fill="#55595c"/>
                    </svg>
                    <div class="d-flex flex-column card-body">
                        <p><strong>{{ post.title }}</strong></p>
                        <p class="card-text">{{ $filters.truncateText(post.preview, 90, '...') }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <router-link :to="{name: 'detailedPost', params: {slug: post.slug}}"
                                         class="btn btn-sm btn-outline-secondary me-3" title="View">View
                            </router-link>
                            <small class="text-muted">{{ post.created_at }} by <i><strong>{{ post.user.name }}</strong></i></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-else>
        <div class="callout">
            No posts found
        </div>
    </div>
</template>

<script>
export default {
    props: {
        posts: {
            type: Array,
            required: true,
        }
    }
}
</script>
