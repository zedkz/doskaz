<template>
    <field :label="label" :required="required" :property="property">
        <image-uploader v-model="value"/>
    </field>
</template>

<script>
    import Field from "@/components/Admin/Fields/Field";
    import ImageUploader from "@/components/Admin/ImageUploader";
    export default {
        name: "ImageField",
        components: {ImageUploader, Field},
        props: [
            'property',
            'label',
            'required',
        ],
        computed: {
            resourceName() {
                return this.$store.getters.resourceName
            },
            value: {
                get() {
                    return this.$store.getters[`${this.resourceName}/edit/getItemProperty`](this.property);
                },
                set(val) {
                    this.$store.commit(`${this.resourceName}/edit/changeField`, {field: this.property, value: val});
                }
            },
            error() {
                return this.$store.state[this.resourceName].edit.violations[this.property];
            }
        }
    }
</script>

<style scoped>

</style>