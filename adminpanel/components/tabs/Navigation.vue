<template>
    <div>
        <attribute-selection-field :path="`${path}.attributes.attribute1`" label="Указатели и информационный материал - Контрастные крупные буквы, выделенные жирным шрифтом"/>
        <attribute-selection-field :path="`${path}.attributes.attribute2`" label="Форматы информации - Шрифт Брайля, аудио-версия, радиомаяки, радиометки, радиоинформаторы"/>
        <attribute-selection-field :path="`${path}.attributes.attribute3`" label="Знаки и символы - Международные знаки и символы на контрастном фоне"/>
        <attribute-selection-field :path="`${path}.attributes.attribute4`" label="Форматы информации - Визуальные, тактильные, звуковые, световые указатели, табло и пиктограммы, а также контрастное цветовое решение элементов интерьера, переводчик с жестового языка"/>

        <h4>Тактильная информация</h4>
        <hr/>
        <attribute-selection-field :path="`${path}.attributes.attribute5`" label="Рельефные тактильные обозначения путей движения"/>
        <attribute-selection-field :path="`${path}.attributes.attribute6`" label="Непрерывные тактильные обозначения путей движения"/>
        <attribute-selection-field :path="`${path}.attributes.attribute7`" label="Мнемосхема - Размещение с правой стороны на расстоянии от 3 м до 5 м от входа в объект"/>

        <textarea-field label="Комментарий" :path="`${path}.comment`" :disabled="true"/>

        <h4>Оценка доступности</h4>
        <hr/>
        <accessibility-score :attributes="attributes"/>
    </div>
</template>

<script>
    import AttributeSelectionField from "../crud/fields/AttributeSelectionField";
    import {get} from "vuex-pathify";
    import AccessibilityScore from "../AccessibilityScore";
    import _ from "lodash";
    import TextareaField from "../crud/fields/TextareaField";
    export default {
        name: "Navigation",
        components: {TextareaField, AccessibilityScore, AttributeSelectionField},
        props: ['path'],
        computed: {
            item: get('crud/edit/item'),
            attributes() {
                return _.get(this.item, `${this.path}.attributes`)
            }
        },
    }
</script>

<style scoped>

</style>
