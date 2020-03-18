<template>
    <div>
        <Sidebar :posts="posts" :cities="cities"></Sidebar>
        <post-submit-message/>
    </div>
</template>

<script>
    import Sidebar from "@/components/Sidebar.vue";
    import PostSubmitMessage from "../components/complaint/PostSubmitMessage";
    export default {
        head() {
            return {
                title: 'Главная'
            }
        },
        layout: 'main',
        components: {
            PostSubmitMessage,
            Sidebar
        },
        async asyncData({$axios}) {
            const [{data: {items: posts}}, {data: cities}] = await Promise.all([
                $axios.get('/api/blogPosts/list'),
                $axios.get('/api/cities')
            ])
            return {posts, cities}
        },
        async fetch({store}) {
            return store.dispatch('objectCategories/getCategories')
        }
    }
</script>

<style scoped>

</style>