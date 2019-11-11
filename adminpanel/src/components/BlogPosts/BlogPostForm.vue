<template>
    <form>
        <text-field property="title" required label="Заголовок"/>
        <text-field property="slug" label="ЧПУ"/>
        <datepicker-field property="publishedAt" required label="Дата публикации"/>
        <checkbox-field property="isPublished" label="Отображать на сайте"/>

        <meta-field property="meta"/>
    </form>
</template>

<script>
    import TextField from "@/components/Admin/Fields/TextField";
    import MetaField from "@/components/MetaField";
    import CheckboxField from "@/components/Admin/Fields/CheckboxField";
    import DatepickerField from "@/components/Admin/Fields/DatepickerField";

    export default {
        name: "BlogPostForm",
        components: {DatepickerField, CheckboxField, MetaField, TextField}
    }
</script>

<style scoped>

</style>