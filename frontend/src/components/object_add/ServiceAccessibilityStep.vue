<template>
    <div class="add-object__content">
        <attribute-field title="Универсальный проект" sub-title="Услуга оказывается во всем здании" v-model="value.attributes.attribute1"/>
        <attribute-field title="Разумное приспособление" sub-title="Услуга оказывается на 1 этаже" v-model="value.attributes.attribute2"/>
        <attribute-field title="Есть доставка товаров или вызов специалиста на дом" sub-title="Услуга оказывается дистанционно" v-model="value.attributes.attribute3"/>
        <attribute-field title="Кнопка вызова персонала" v-model="value.attributes.attribute4"/>
        <attribute-field title="Оказание ситуационной помощи со стороны персонала" v-model="value.attributes.attribute5"/>
        <attribute-field title="Протоколы/инструкции по коммуникации и оказанию помощи маломобильным гражданам" sub-title="Был ли обучен персонал" v-model="value.attributes.attribute6"/>
        <attribute-field title="Льготы для людей с инвалидностью 1, 2, 3 групп, пожилых, детей" v-model="value.attributes.attribute7"/>
        <accessibility-score :attributes="value.attributes" type="accessibility_middle"/>

        <div class="add-object__line --lrg">
            <h5 class="add-object__title">Комментарий к доступности услуги</h5>
        </div>
        <div class="add-object__line">
                    <textarea class="add-object__textarea"
                              placeholder="Система оценила доступность услуги. Если вы не согласны с оценкой, вы можете оставить комментарий с пояснением"></textarea>
        </div>
    </div>
</template>

<script>
    import AttributeField from "./AttributeField";
    import AccessibilityScore from "./AccessibilityScore";
    export default {
        name: "ServiceAccessibilityStep",
        components: {AccessibilityScore, AttributeField},
        props: [
            'value'
        ],
    }
</script>

<style scoped>

</style>