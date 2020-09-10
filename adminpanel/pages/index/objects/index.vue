<template>
    <crud-list
        title="Объекты"
        api-path="/api/admin/objects"
        :table-fields="fields"
    >
        <objects-filter slot="filter"/>
    </crud-list>
</template>

<script>
    import CrudList from "~/components/crud/CrudList";
    import FormattedDate from "~/components/crud/list-fields/FormattedDate";
    import EditLink from "~/components/crud/list-fields/EditLink";
    import ObjectsFilter from "../../../components/objects/ObjectsFilter";
    export default {
        components: {ObjectsFilter, CrudList},
        computed: {
            fields() {
                return [
                    {key: 'title', label: 'Наименование', type: EditLink},
                    {key: 'address', label: 'Адрес'},
                    {key: 'city', label: 'Город'},
                    {key: 'category', label: 'Категория'},
                    {key: 'createdAt', label: 'Дата создания', type: FormattedDate},
                ]
            }
        }
    }
</script>

<style scoped>

</style>
