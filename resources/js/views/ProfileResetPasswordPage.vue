<template>
    <div class="row">
        <div class="col-sm-12 col-md-3 order-md-2 pb-3">
            <SideMenu :menu="menu"/>
        </div>
        <div class="col-sm-12 col-md-9 order-md-1">
            <ResetPassword/>
        </div>
    </div>
</template>

<script>
import ResetPassword from "../components/ResetPassword";
import SideMenu from "../components/UI/SideMenu";

export default {
    components: {SideMenu, ResetPassword},
    data() {
        return {
            menu: [
                {"name": "Profile", "uri": "/profile"},
                {"name": "Posts", "uri": "/profile/posts"},
                {"name": "Reset password", "uri": "/profile/reset"},
            ]
        }
    }
}
</script>
