<template>
    <div>error {{error.statusCode}}</div>
</template>

<script>
    export default {
        name: "error",
        props: [
            'error'
        ]
    }
</script>

<style scoped>

</style>
