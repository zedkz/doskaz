<template>
    <div>
        <Sidebar :posts="posts"></Sidebar>
    </div>
</template>

<script>
    import Sidebar from "@/components/Sidebar.vue";
    export default {
        layout: 'main',
        components: {
            Sidebar
        },
        async asyncData({$axios}) {
            const {data: {items}} = await $axios.get('/api/blogPosts/list')
            return {posts: items}
        },
        async fetch({store}) {
            return store.dispatch('objectCategories/getCategories')
        }
    }
</script>

<style scoped>

</style>