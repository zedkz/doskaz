<template>
    <crud-list
        title="Объекты"
        api-path="/api/admin/objects"
        :table-fields="fields"
    />
</template>

<script>
    import CrudList from "@/components/crud/CrudList";
    import FormattedDate from "@/components/crud/list-fields/FormattedDate";
    export default {
        components: {CrudList},
        computed: {
            fields() {
                return [
                    {key: 'title', label: 'Наименование'},
                    {key: 'address', label: 'Адрес'},
                    {key: 'category', label: 'Категория'},
                    {key: 'createdAt', label: 'Дата создания', type: FormattedDate},
                ]
            }
        }
    }
</script>

<style scoped>

</style>
