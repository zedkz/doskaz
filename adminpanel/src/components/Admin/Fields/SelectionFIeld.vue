<template>
    <field :label="label" :required="required" :property="property">
        <select :multiple="multiple" ref="select" style="width: 100%">
            <option v-for="option in options" :key="option.value" :value="option.value">{{option.title}}</option>
        </select>
    </field>
</template>

<script>
    import 'select2'
    import Field from "@/components/Admin/Fields/Field";

    export default {
        name: "SelectionField",
        components: {Field},
        props: {
            label: String,
            property: String,
            required: {
                type: Boolean,
                default: false
            },
            options: {
                type: Array,
                default() {
                    return []
                }
            },
            multiple: {
                type: Boolean,
                default: false
            },
        },
        mounted() {
            const vm = this;
            $(this.$refs.select).select2({
                width: 'resolve'
            }).val(this.value)
                .trigger('change')
                .on('change', function () {
                    vm.value = $(this).val()
                })
        },
        watch: {
            value(value, old) {
                if (value.toString() !== old.toString()) {
                    $(this.$refs.select)
                        .val(value)
                        .trigger('change');
                }
            }
        },
        computed: {
            resourceName() {
                return this.$store.getters.resourceName
            },
            value: {
                get() {
                    if (this.multiple) {
                        return this.$store.state[this.resourceName].edit.item[this.property] || [];
                    } else {
                        return this.$store.state[this.resourceName].edit.item[this.property] || null;
                    }
                },
                set(value) {
                    this.$store.commit(`${this.resourceName}/edit/changeField`, {field: this.property, value: value});
                }
            }
        }
    }
</script>

<style scoped>

</style>