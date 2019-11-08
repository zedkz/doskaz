<template>
    <div>
        <slot/>
    </div>
</template>

<script>
    export default {
        name: "Create",
        props: [
            'resourceName'
        ],
        mounted() {

        }
    }
</script>

<style scoped>

</style>