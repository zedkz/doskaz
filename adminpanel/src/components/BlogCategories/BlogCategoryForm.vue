<template>
    <form>
        <text-field property="title" required label="Наименование"/>
        <text-field property="slug" label="ЧПУ"/>
    </form>
</template>

<script>
    import TextField from "@/components/Admin/Fields/TextField";

    export default {
        name: "BlogCategoryForm",
        components: {TextField}
    }
</script>

<style scoped>

</style>