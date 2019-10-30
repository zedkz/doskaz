<template>
    <div class="form-group row">
        <label  class="col-sm-2 col-form-label">{{label}} <span class="text-danger" v-if="required">*</span></label>
        <div class="col-sm-10">
            <v-select :options="[]"></v-select>
            <!--<input type="text" class="form-control" :placeholder="placeholder" :disabled="disabled" v-model="value" id="ddd">-->
        </div>
    </div>
</template>

<script>
    import vSelect from 'vue-select'
    import Vue from 'vue'
    Vue.component('v-select', vSelect)
    import 'vue-select/dist/vue-select.css';

    export default {
        name: "SelectionField",
        props: {
            label: String,
            required: {
                type: Boolean,
                default: false
            }
        }
    }
</script>

<style scoped>

</style>