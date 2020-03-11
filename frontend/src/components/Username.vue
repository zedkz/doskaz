<template>
    <component :is="tag">
        {{ value }}
    </component>
</template>

<script>
    export default {
        name: "Username",
        props: {
            tag: {
                type: String,
                default: 'span'
            },
            value: {
                type: String,
                default: 'Без имени'
            }
        }
    }
</script>

<style scoped>

</style>