<template>
    <div>
        <Sidebar :posts="posts"></Sidebar>
        <post-submit-message/>
    </div>
</template>

<script>
    import Sidebar from "@/components/Sidebar.vue";
    import PostSubmitMessage from "../components/complaint/PostSubmitMessage";
    export default {
        layout: 'main',
        components: {
            PostSubmitMessage,
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