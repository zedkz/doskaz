<template>

</template>

<script>
    export default {
        middleware: ['authenticated'],
        mounted() {
            this.$router.push('/users')
        }
    }
</script>
