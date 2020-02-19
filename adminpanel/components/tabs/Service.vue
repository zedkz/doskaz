<template>
    <div>
        <h4>Размеры рабочей поверхности стола, стойки</h4>
        <hr/>

        <attribute-selection-field :path="`${path}.attributes.attribute1`" label="Высота не более 80 см от уровня пола"/>
        <attribute-selection-field :path="`${path}.attributes.attribute2`" label="Коленное пространство не менее 70 см"/>
        <attribute-selection-field :path="`${path}.attributes.attribute3`" label="Опознавательные таблички - Высота размещения от 1,4 м до 1,6 м"/>

        <h4>Зона досягаемости для людей на кресло-колясках</h4>
        <hr/>
        <attribute-selection-field :path="`${path}.attributes.attribute4`" label="При расположении сбоку от посетителя — не выше 1,4 м и не ниже 0,3 от уровня пола"/>
        <attribute-selection-field :path="`${path}.attributes.attribute5`" label="При фронтальном подходе — не выше 1,2 м и не ниже 0,4 м от уровня пола"/>

        <h4>Оценка доступности</h4>
        <hr/>
        <accessibility-score :attributes="item[path].attributes"/>
    </div>
</template>

<script>
    import Fields from "../crud/Fields";
    import AttributeSelectionField from "../crud/fields/AttributeSelectionField";
    import AccessibilityScore from "../AccessibilityScore";
    import {get} from "vuex-pathify";
    export default {
        name: "Service",
        components: {AccessibilityScore, AttributeSelectionField, Fields},
        props: ['path'],
        computed: {
            item: get('crud/edit/item')
        },
    }
</script>

<style scoped>

</style>
