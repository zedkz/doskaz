<template>
    <field :label="label" :property="property">
        <textarea class="form-control" rows="5" v-model="value"></textarea>
    </field>
</template>

<script>
    import Field from "@/components/Admin/Fields/Field";
    export default {
        name: "TextareaField",
        components: {Field},
        props: [
            'property',
            'label'
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
        }
    }
</script>

<style scoped>

</style>