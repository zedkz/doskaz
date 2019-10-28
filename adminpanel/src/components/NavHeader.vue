<template>
    <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">Doskaz</a>
            </div>

            <b-navbar-nav class="ml-auto">
                <b-nav-item>{{ username }}</b-nav-item>
                <b-nav-item @click="logout">
                    <i class="fas fa-sign-out-alt"/>
                </b-nav-item>
            </b-navbar-nav>
        </nav>
    </header>
</template>

<script>
    export default {
        name: "NavHeader",
        computed: {
            username() {
                const user = this.$store.state.authenticatedUser.user;
                return user.name || user.email || user.phone
            }
        },
        methods: {
            async logout() {
                await this.$store.dispatch('logout');
                window.location.href = '/login'
            }
        }
    }
</script>

<style scoped>

</style>