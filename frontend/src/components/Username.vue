<template>
    <component :is="tag">
        {{ valueOrDefault }}
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
            },
            placeholder: {
                type: String
            }
        },
        computed: {
            valueOrDefault() {
                return this.value || this.placeholder || 'Без имени'
            }
        }
    }
</script>

<style scoped>

</style>