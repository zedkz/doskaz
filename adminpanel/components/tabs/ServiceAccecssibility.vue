<template>
    <div>
        <attribute-selection-field :path="`${path}.attributes.attribute1`" label="Универсальный проект - Услуга оказывается во всем здании"/>
        <attribute-selection-field :path="`${path}.attributes.attribute2`" label="Разумное приспособление - Услуга оказывается на 1 этаже"/>
        <attribute-selection-field :path="`${path}.attributes.attribute3`" label="Есть доставка товаров или вызов специалиста на дом - Услуга оказывается дистанционно"/>
        <attribute-selection-field :path="`${path}.attributes.attribute4`" label="Кнопка вызова персонала"/>
        <attribute-selection-field :path="`${path}.attributes.attribute5`" label="Оказание ситуационной помощи со стороны персонала"/>
        <attribute-selection-field :path="`${path}.attributes.attribute6`" label="Протоколы/инструкции по коммуникации и оказанию помощи маломобильным гражданам - Был ли обучен персонал"/>
        <attribute-selection-field :path="`${path}.attributes.attribute7`" label="Льготы для людей с инвалидностью 1, 2, 3 групп, пожилых, детей"/>

        <h4>Оценка доступности</h4>
        <hr/>
        <accessibility-score :attributes="item[path].attributes"/>
    </div>
</template>

<script>
    import AttributeSelectionField from "../crud/fields/AttributeSelectionField";
    import {get} from "vuex-pathify";
    import AccessibilityScore from "../AccessibilityScore";
    export default {
        name: "ServiceAccessibility",
        components: {AccessibilityScore, AttributeSelectionField},
        props: ['path'],
        computed: {
            item: get('crud/edit/item')
        },
    }
</script>

<style scoped>

</style>
