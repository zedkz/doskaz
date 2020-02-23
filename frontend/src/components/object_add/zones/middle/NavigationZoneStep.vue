<template>
    <div class="add-object__content">

        <attribute-field title="Указатели и информационный материал" sub-title="Контрастные крупные буквы, выделенные жирным шрифтом" v-model="value.attributes.attribute1"/>
        <attribute-field title="Форматы информации" sub-title="Шрифт Брайля, аудио-версия, радиомаяки, радиометки, радиоинформаторы" v-model="value.attributes.attribute2"/>
        <attribute-field title="Знаки и символы" sub-title="Международные знаки и символы на контрастном фоне" v-model="value.attributes.attribute3"/>
        <attribute-field title="Форматы информации" sub-title="Визуальные, тактильные, звуковые, световые указатели, табло и пиктограммы, а также контрастное цветовое решение элементов интерьера, переводчик с жестового языка" v-model="value.attributes.attribute4"/>
        <div class="add-object__line --lrg"><h5 class="add-object__title --label">Тактильная информация</h5></div>
        <attribute-field sub-title="Рельефные тактильные обозначения путей движения" v-model="value.attributes.attribute5"/>
        <attribute-field sub-title="Непрерывные тактильные обозначения путей движения" v-model="value.attributes.attribute6"/>
        <attribute-field title="Мнемосхема" sub-title="Размещение с правой стороны на расстоянии от 3 м до 5 м от входа в объект" v-model="value.attributes.attribute7"/>

        <accessibility-score :attributes="value.attributes" type="navigation_middle"/>

        <div class="add-object__line --lrg">
            <h5 class="add-object__title">Комментарий к навигации</h5>
        </div>
        <div class="add-object__line">
                    <textarea class="add-object__textarea"
                              v-model="value.comment"
                              placeholder="Система оценила доступность навигации. Если вы не согласны с оценкой, вы можете оставить комментарий с пояснением"></textarea>
        </div>
    </div>
</template>

<script>
    import AccessibilityScore from "@/components/object_add/AccessibilityScore";
    import AttributeField from "@/components/object_add/AttributeField";
    export default {
        name: "NavigationZoneStep",
        components: {AttributeField, AccessibilityScore},
        props: [
            'value'
        ],
    }
</script>

<style scoped>

</style>