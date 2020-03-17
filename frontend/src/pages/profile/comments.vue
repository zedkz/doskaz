<template>
    <UserComments :pages="pages" :items="items"/>
</template>

<script>
    import UserComments from "@/components/user/UserComments";

    export default {
        components: {
            UserComments
        },
        async asyncData({$axios, query}) {
            const {data} = await $axios.get('/api/profile/comments', {
                params: {
                    page: query.page || 1
                }
            })
            return data
        },
        watchQuery: ['page']
    };
</script>