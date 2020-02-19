<template>
    <header class="topbar">
        <b-navbar class="navbar top-navbar navbar-expand-md navbar-dark">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    <span class="hidden-xs"><span class="font-bold">Doskaz</span></span>
                </a>
            </div>
            <b-navbar-nav class="ml-auto">
                <b-nav-item-dropdown right>
                    <template v-slot:button-content>
                        {{ $store.state.authentication.user.name || $store.state.authentication.user.phone ||
                        $store.state.authentication.user.email }}
                    </template>
                    <b-dropdown-item href="#">Выход</b-dropdown-item>
                </b-nav-item-dropdown>
            </b-navbar-nav>
        </b-navbar>
    </header>
</template>

<script>
    export default {
        name: "NavHeader"
    }
</script>

<style scoped>

</style>
