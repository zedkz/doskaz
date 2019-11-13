<template>
    <button type="button" class="btn btn-danger" @click="doDelete">Удалить</button>
</template>

<script>
    export default {
        name: "DeleteButton",
        props: [
            'resourceId'
        ],
        computed: {
            resourceName() {
                return this.$store.getters.resourceName
            }
        },
        methods: {
            doDelete() {
                if (confirm('Вы действительно хотите удалить эту запись?')) {
                    this.$store.dispatch(`${this.resourceName}/list/delete`, this.resourceId)
                }
            }
        }
    }
</script>

<style scoped>

</style>