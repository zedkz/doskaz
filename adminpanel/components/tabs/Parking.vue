<template>
   <div>

       <attributes-list :form="form" zone="parking" :value="item.form.parking.attributes" @input="update"/>
       <textarea-field label="Комментарий" :path="`${path}.comment`" :disabled="true"/>

       <h4>Оценка доступности</h4>
       <hr/>
       <accessibility-score :value="{attributes: item.form.parking.attributes}" :type="`parking_${form}`"/>

   </div>
</template>

<script>
    import AttributeSelectionField from "../crud/fields/AttributeSelectionField";
    import AccessibilityScore from "../AccessibilityScore";
    import {get} from 'vuex-pathify'
    import TextareaField from "../crud/fields/TextareaField";
    import AttributesList from "../AttributesList";

    export default {
        name: "Parking",
        components: {AttributesList, TextareaField, AccessibilityScore, AttributeSelectionField},
        props: ['path', 'form'],
        computed: {
            item: get('crud/edit/item')
        },
        methods: {
            update(val) {
                this.$store.commit('crud/edit/SET_PROPERTY_BY_PATH', {value: val, path: `${this.path}.attributes`})
            }
        }
    }
</script>

<style scoped>

</style>
