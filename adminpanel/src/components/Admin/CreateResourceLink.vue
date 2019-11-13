<template>
    <router-link class="btn btn-info btn-sm m-l-15" :to="link">
        <i class="fa fa-plus-circle"></i>
        Добавить
    </router-link>
</template>

<script>
    export default {
        name: "CreateResourceLink",
        props: [
            'resourceName'
        ],
        computed: {
            link() {
                return {
                    name: `resources.${this.resourceName}.create`
                }
            }
        }
    }
</script>

<style scoped>

</style>