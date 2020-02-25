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
        components: {
            Sidebar,
            StartCategoryForm
        },
        async asyncData({$axios}) {
            const {data: {items}} = await $axios.get('/api/blogPosts/list')
            return {posts: items}
        }
    }
</script>

<style scoped>

</style>