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
import Header from "./Header";
import Footer from "./Footer";
import Index from "../views/Index";

export default {
    components: {Index, Footer, Header}
}
</script>
