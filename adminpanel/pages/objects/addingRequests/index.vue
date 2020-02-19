<template>
    <crud-list
        title="Заявки на добавление объектов"
        api-path="/api/admin/addingRequests"
        :create="false"
        :table-fields="fields"
    />
</template>

<script>
    import CrudList from "../../../components/crud/CrudList";
    import FormattedDate from "../../../components/crud/list-fields/FormattedDate";

    export default {
        components: {CrudList},
        middleware: ['authenticated'],
        computed: {
            fields() {
                return [
                    {key: 'name', label: 'Наименование'},
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
