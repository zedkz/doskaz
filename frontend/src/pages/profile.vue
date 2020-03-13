<template>
    <nuxt-child/>
</template>

<script>
    export default {
        name: "index",
        middleware: ['authenticated'],
        mounted() {
            this.$router.push({name: 'profile-objects'})
        }
    }
</script>

<style scoped>

</style>