<template>
    <div>
        <StartCategoryForm/>
        <Sidebar :posts="posts"></Sidebar>
    </div>
</template>

<script>
    import Sidebar from "@/components/Sidebar.vue";
    import StartCategoryForm from "@/components/StartCategoryForm.vue";
    export default {
        layout: 'main',
        components: {
            Sidebar,
            StartCategoryForm
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