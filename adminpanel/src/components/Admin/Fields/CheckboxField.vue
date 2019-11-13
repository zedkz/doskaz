<template>
    <field :property="property">
        <b-form-checkbox v-model="value">{{ label }}</b-form-checkbox>
    </field>
</template>

<script>
    import Field from "@/components/Admin/Fields/Field";

    export default {
        name: "CheckboxField",
        components: {Field},
        props: [
            'label',
            'property'
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
            }
        },
    }
</script>

<style scoped>

</style>