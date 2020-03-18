<template>
    <UserObjects :pages="pages" :objects="items"/>
</template>

<script>
    import UserObjects from "@/components/user/UserObjects";

    export default {
        name: "objects",
        head: {
            title: 'Мои объекты'
        },
        components: {
            UserObjects
        },
        async asyncData({$axios, query}) {
            const {data} = await $axios.get('/api/profile/objects', {
                params: {
                    page: query.page || 1
                }
            })
            return data
        },
        watchQuery: ['page']
    }
</script>