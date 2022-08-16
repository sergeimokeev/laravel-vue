<template>
    <main class="admin-page">
        <AdminSidebar/>
        <div class="container py-5">
            <router-view/>
        </div>
    </main>
</template>

<script>
import AdminSidebar from "./AdminSidebar";

export default {
    components: {AdminSidebar}
}
</script>
