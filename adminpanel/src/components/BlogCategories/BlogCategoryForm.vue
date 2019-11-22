<template>
    <form>
        <text-field property="title" required label="Наименование"/>
        <text-field property="slug" label="ЧПУ"/>
        <meta-field property="meta"/>
    </form>
</template>

<script>
    import TextField from "@/components/Admin/Fields/TextField";
    import MetaField from "@/components/MetaField";

    export default {
        name: "BlogCategoryForm",
        components: {MetaField, TextField}
    }
</script>

<style scoped>

</style>