<template>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">{{label}} <span class="text-danger" v-if="required">*</span></label>
        <div class="col-sm-10">
            <select multiple="multiple" ref="select" style="width: 100%">
                <option v-for="option in options" :key="option.value" :value="option.value">{{option.title}}</option>
            </select>
        </div>
    </div>
</template>

<script>
    import 'select2'

    export default {
        name: "SelectionField",
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
            }
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
                    return this.$store.state[this.resourceName].edit.item[this.property] || [];
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