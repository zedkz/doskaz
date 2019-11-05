<template>
    <aside class="left-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li v-for="(link, index) in links" :key="index" :class="{active: isActiveRoute(link)}">
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
                    {route: {name: 'resources.users.list'}, isActive: 'resources.users', title: 'Пользователи', icon: 'fas fa-user'},
                    {route: {name: 'resources.blogCategories.list'}, isActive: 'resources.blogCategories', title: 'Категории блога', icon: ''},
                ]
            }
        },
        methods: {
            isActiveRoute(route) {
                return this.$route.name.startsWith(route.isActive)
            }
        }
    }
</script>

<style scoped>

</style>