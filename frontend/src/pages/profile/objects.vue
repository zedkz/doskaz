<template>
    <UserObjects />
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
        }
    }
</script>