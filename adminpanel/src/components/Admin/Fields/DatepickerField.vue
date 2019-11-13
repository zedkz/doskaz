<template>
    <field :property="property" :label="label" v-slot="{error}" :required="required">
        <date-picker :input-class="{'form-control custom-item': true, ' is-invalid': error}" type="datetime"
                     format="YYYY-MM-DD HH:mm" v-model="value"/>
    </field>
</template>

<script>
    import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';
    import 'vue2-datepicker/locale/ru';
    import Field from "@/components/Admin/Fields/Field";

    export default {
        name: "DatepickerField",
        components: {Field, DatePicker},
        props: [
            'property',
            'label',
            'required'
        ],
        computed: {
            resourceName() {
                return this.$store.getters.resourceName
            },
            value: {
                get() {
                    const val = this.$store.getters[`${this.resourceName}/edit/getItemProperty`](this.property);
                    return val ? new Date(val) : null
                },
                set(val) {
                    let value = val ? val.toISOString() : null;
                    this.$store.commit(`${this.resourceName}/edit/changeField`, {field: this.property, value: value});
                }
            }
        },
    }
</script>

<style>
    .mx-scrollbar-wrap ul .cell {
        display: block;
    }

    .mx-datepicker {
        display: block;
    }

    .custom-item {
        background-image: none !important;
    }

</style>