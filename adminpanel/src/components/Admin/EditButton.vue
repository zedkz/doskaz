<template>
    <router-link :to="to" class="btn btn-success">Редактировать</router-link>
</template>

<script>
    export default {
        name: "EditButton",
        props: [
            'resourceName', 'resourceId'
        ],
        computed: {
            to() {
                return {
                    name: `resources.${this.resourceName}.edit`,
                    params: {
                        id: this.resourceId
                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>