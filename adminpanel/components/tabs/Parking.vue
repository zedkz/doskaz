<template>
   <div>
       <attribute-selection-field path="parking.attributes.attribute1" label="Количество парковочных мест - Не менее одного на 25 мест"/>
       <attribute-selection-field path="parking.attributes.attribute2" label="Размер парковки - Не менее 3,66 х 5,38 м"/>

       <h4>Обозначение автостоянки для инвалидов</h4>
       <hr/>
       <attribute-selection-field path="parking.attributes.attribute3" label="Знак на плоскости стоянки"/>
       <attribute-selection-field path="parking.attributes.attribute4" label="Знак на вертикальной поверхности (стене, столбе, стойке)"/>
       <attribute-selection-field path="parking.attributes.attribute5" label="Знак 5.15 «Место стоянки»"/>
       <attribute-selection-field path="parking.attributes.attribute6" label="Знак 7.15 «Инвалиды»"/>
       <attribute-selection-field path="parking.attributes.attribute7" label="Стрелка и расстояние"/>
       <attribute-selection-field path="parking.attributes.attribute8" label="Разметка на плоскости"/>
       <attribute-selection-field path="parking.attributes.attribute9" label="Съезд с тротуара на парковку - Рекомендуется ширина 1,5 м"/>
       <attribute-selection-field path="parking.attributes.attribute10" label="Расстояние до входа в здание - Для общественных зданий менее 50 м"/>

       <h4>Оценка доступности</h4>
       <hr/>
       <accessibility-score :attributes="item.parking.attributes"/>
   </div>
</template>

<script>
    import AttributeSelectionField from "../crud/fields/AttributeSelectionField";
    import AccessibilityScore from "../AccessibilityScore";
    import {get} from 'vuex-pathify'

    export default {
        name: "Parking",
        components: {AccessibilityScore, AttributeSelectionField},
        props: ['path'],
        computed: {
            item: get('crud/edit/item')
        },
        methods: {}
    }
</script>

<style scoped>

</style>
