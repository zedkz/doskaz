<template>
    <aside class="left-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li v-for="(link, index) in links" :key="index" :class="{active: isActiveRoute(link.route)}">
                    <router-link :to="link.route">
                        <i :class="link.icon"/><span class="hide-menu">{{ link.title }}</span>
                    </router-link>
                </li>
            </ul>
        </nav>
    </aside>
</template>

<script>
    import {} from 'vue-router'

    export default {
        name: "Sidebar",
        computed: {
            links() {
                return [
                    {route: {name: 'admin.users'}, title: 'Пользователи', icon: 'fas fa-user'}
                ]
            }
        },
        methods: {
            isActiveRoute(route) {
                return this.$route.name === route.name
            }
        }
    }
</script>

<style scoped>

</style>