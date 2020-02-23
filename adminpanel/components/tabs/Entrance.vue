<template>
    <div>
        <attributes-list :form="form" zone="entrance" :value="attributes" @input="update"/>
        <textarea-field label="Комментарий" :path="`${path}.comment`" :disabled="true"/>
        <h4>Оценка доступности</h4>
        <hr/>
        <accessibility-score :attributes="attributes"/>
    </div>
</template>

<script>
    import Fields from "../crud/Fields";
    import AttributeSelectionField from "../crud/fields/AttributeSelectionField";
    import AccessibilityScore from "../AccessibilityScore";
    import {get} from "vuex-pathify";
    import _ from 'lodash'
    import TextareaField from "../crud/fields/TextareaField";
    import AttributesList from "../AttributesList";

    export default {
        name: "Entrance",
        components: {AttributesList, TextareaField, AccessibilityScore, AttributeSelectionField, Fields},
        props: [
            'path',
            'form'
        ],
        computed: {
            item: get('crud/edit/item'),
            attributes() {
                return _.get(this.item, `${this.path}.attributes`)
            }
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
