<template>
    <div class="form-group row" :class="{error: error}">
        <label class="col-sm-2 col-form-label">{{label}} <span class="text-danger" v-if="required">*</span></label>
        <div class="col-sm-10">
            <slot v-bind:error="error"/>
            <div class="invalid-feedback" v-if="error" style="display: block">
                {{error.title}}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Field",
        props: {
            label: String,
            property: String,
            readonly: {
                type: Boolean,
                default: false
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
            error() {
                return this.$store.state[this.resourceName].edit.violations[this.property];
            }
        }
    }
</script>

<style scoped>

</style>