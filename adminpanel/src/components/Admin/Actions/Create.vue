<template>
    <div>
        <slot/>
    </div>
</template>

<script>
    export default {
        name: "Create",
        props: [
            'initialData'
        ],
        computed: {
            resourceName() {
                return this.$store.getters.resourceName
            }
        },
        mounted() {
            if (this.initialData) {
                this.$store.commit(`${this.resourceName}/edit/initialize`, this.initialData())
            }
        }
    }
</script>

<style scoped>

</style>