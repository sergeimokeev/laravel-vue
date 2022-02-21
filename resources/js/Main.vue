<template>
    <Header/>
    <main>
        <div class="py-5 bg-light">
            <div class="container">
                <router-view/>
            </div>
        </div>
    </main>
    <Footer/>
</template>

<script>
import Header from "./layout/Header";
import Footer from "./layout/Footer";

export default {
    components: {Footer, Header}
}
</script>
