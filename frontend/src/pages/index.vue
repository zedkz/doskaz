<template>
    <div>
        <sidebar :posts="posts" :events="events"/>
        <post-submit-message/>
        <post-addition-message/>
    </div>
</template>

<script>
    import Sidebar from "~/components/Sidebar.vue";
    import PostSubmitMessage from "~/components/complaint/PostSubmitMessage";
    import PostAdditionMessage from "~/components/object_add/PostAdditionMessage";
    export default {
        layout: 'main',
        components: {
            PostAdditionMessage,
            PostSubmitMessage,
            Sidebar
        },
        async asyncData({$axios}) {
            const [{data: {items: posts}}, {data: events}] = await Promise.all([
                $axios.get('/api/blog/posts'),
                $axios.get('/api/events')
            ])
            return {posts, events}
        },
        async fetch({store}) {
            return store.dispatch('objectCategories/getCategories')
        }
    }
</script>

<style scoped>

</style>