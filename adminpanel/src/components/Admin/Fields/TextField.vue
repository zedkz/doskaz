<template>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">{{label}} <span class="text-danger" v-if="required">*</span></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" :class="{'is-invalid': error}" :placeholder="placeholder" :disabled="disabled" v-model="value"
                   id="ddd">
            <div class="invalid-feedback" v-if="error">
                {{error.title}}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "TextField",
        props: {
            label: String,
            property: String,
            readonly: {
                type: Boolean,
                default: false
            },
            disabled: {
                type: Boolean,
                default: false
            },
            placeholder: {
                type: String
            },
            required: {
                type: Boolean,
                default: false
            }
        },
        computed: {
            resourceName() {
                return this.$store.getters.resourceName
            },
            value: {
                get() {
                    return this.$store.state[this.resourceName].edit.item[this.property];
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