<template>
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-bg">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <h1>oops!</h1>
            <h2>Error 404 : Page Not Found</h2>
            <a @click="$router.go(-1)">go back</a>
        </div>
    </div>
</template>

<script>
export default {}
</script>
