<template>
    <h1>{{ post.title }}</h1>
    <small>{{ post.created_at }} by <i><strong>{{ post.user.name }}</strong></i></small>
    <Like/>
    <p>{{ post.preview }}</p>
    <div>{{ post.body }}</div>
    <div class="d-flex justify-content-end mt-4">
        <a class="btn btn-dark" @click="$router.go(-1)">Go back</a>
    </div>
</template>

<script>
import Like from "./UI/Like";
export default {
    components: {Like},
    props: {
        post: {
            type: Object,
            required: true
        }
    }
}
</script>
