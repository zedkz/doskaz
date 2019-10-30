<template>
    <div>
        <div class="d-flex justify-content-center align-items-center" style="height: 100vh" v-if="!user">
            <div class="spinner-border text-info" role="status" style="width: 3rem; height: 3rem">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <h3 v-else-if="user && !isAdmin">403 доступ запрещен</h3>

        <div v-else id="main-wrapper">
            <nav-header/>
            <sidebar/>
            <div class="page-wrapper">
                <slot/>
            </div>
        </div>
    </div>
</template>

<script>
    import NavHeader from "./NavHeader";
    import Sidebar from "./Sidebar";

    export default {
        name: "Adminpanel2",
        components: {Sidebar, NavHeader},
        data() {
            return {}
        },
        mounted() {
            if (!this.user) {
                this.loadUser()
            }
        },
        methods: {
            async loadUser() {
                await this.$store.dispatch('loadUser');
            }
        },
        computed: {
            user() {
                return this.$store.state.authenticatedUser.user
            },
            isAdmin() {
                return this.user && this.user.roles.includes('ROLE_ADMIN')
            }
        }
    }
</script>

<style scoped>

</style>