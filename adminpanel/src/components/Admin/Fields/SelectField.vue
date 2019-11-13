<template>
    <field :label="label" :property="property" :required="required">
        <select class="form-control" v-model="value" :disabled="disabled">
            <option v-for="option in options" :key="option.value" :value="option.value">
                {{option.title}}
            </option>
        </select>
    </field>
</template>

<script>
    import Field from "@/components/Admin/Fields/Field";
    export default {
        name: "SelectField",
        components: {Field},
        props: [
            'label', 'property', 'required', 'options', 'disabled'
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