<template>
    <form>
        <text-field property="title" required label="Заголовок"/>
        <text-field property="slug" label="ЧПУ"/>
        <textarea-field property="annotation" label="Лид"/>
        <tiny-m-c-e-field property="content" label="Описание"/>
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
    import TextareaField from "@/components/Admin/Fields/TextareaField";
    import TinyMCEField from "@/components/Admin/Fields/TinyMCEField";

    export default {
        name: "BlogPostForm",
        components: {TinyMCEField, TextareaField, DatepickerField, CheckboxField, MetaField, TextField}
    }
</script>

<style scoped>

</style>

<style>
    .tox-notifications-container {
        display: none !important;
    }
</style>