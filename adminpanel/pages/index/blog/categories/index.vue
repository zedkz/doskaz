<template>
    <crud-list
        title="Категории блога"
        api-path="/api/blogCategories"
        :table-fields="fields"
    />
</template>

<script>
    import CrudList from "@/components/crud/CrudList";
    export default {
        name: "index",
        components: {CrudList},
        middleware: ['authenticated'],
        computed: {
            fields() {
                return [
                    {key: 'title', label: 'Название'}
                ]
            }
        }
    }
</script>

<style scoped>

</style>
