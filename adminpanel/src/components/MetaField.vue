<template>
    <div>
        <h4>Мета данные</h4>
        <hr/>
        <text-field :property="`${property}.title`" label="Meta-заголовок"/>
        <text-field :property="`${property}.description`" label="Meta-описание"/>
        <text-field :property="`${property}.keywords`" label="Meta-ключевые слова"/>
        <text-field :property="`${property}.ogTitle`" label="OG-заголовок"/>
        <text-field :property="`${property}.ogDescription`" label="OG-описание"/>
        <image-field :property="`${property}.ogImage`" label="OG-изображение"/>
    </div>
</template>

<script>
    import TextField from "@/components/Admin/Fields/TextField";
    import ImageField from "@/components/Admin/Fields/ImageField";

    export default {
        name: "MetaField",
        props: [
            'property'
        ],
        components: {ImageField, TextField},
    }
</script>

<style scoped>

</style>