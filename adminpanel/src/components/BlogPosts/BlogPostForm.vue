<template>
    <form>
        <text-field property="title" required label="Заголовок"/>
        <text-field property="slug" label="ЧПУ"/>
        <textarea-field property="annotation" label="Лид"/>
        <tiny-m-c-e-field property="content" label="Описание"/>
        <datepicker-field property="publishedAt" required label="Дата публикации"/>
        <checkbox-field property="isPublished" label="Отображать на сайте"/>
        <select-field label="Категория" property="categoryId" required :options="categoriesOptions"/>
        <image-field property="image" required label="Главное изображение"/>
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
    import api from '@/api'
    import SelectField from "@/components/Admin/Fields/SelectField";
    import ImageField from "@/components/Admin/Fields/ImageField";

    export default {
        name: "BlogPostForm",
        components: {
            ImageField,
            SelectField, TinyMCEField, TextareaField, DatepickerField, CheckboxField, MetaField, TextField},
        data() {
            return {
                categories: []
            }
        },
        mounted() {
            this.loadCategories()
        },
        computed: {
            categoriesOptions() {
                return this.categories.map(category => ({title: category.title, value: category.id}))
            }
        },
        methods: {
            async loadCategories() {
                const {data: {items}} = await api.get('blogCategories', {
                    params: {limit: 999}
                });
                this.categories = items;
            }
        }
    }
</script>

<style scoped>

</style>

<style>
    .tox-notifications-container {
        display: none !important;
    }
</style>