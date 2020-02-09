<template>
    <div class="add-object__content">
        <div class="add-object__line --lrg"><h5 class="add-object__title --label">Размеры рабочей поверхности стола, стойки</h5></div>
        <attribute-field sub-title="Высота не более 80 см от уровня пола" v-model="value.attributes.attribute1"/>
        <attribute-field sub-title="Коленное пространство не менее 70 см" v-model="value.attributes.attribute2"/>
        <attribute-field title="Опознавательные таблички" sub-title="Высота размещения от 1,4 м до 1,6 м" v-model="value.attributes.attribute3"/>
        <div class="add-object__line --lrg"><h5 class="add-object__title --label">Зона досягаемости для людей на кресло-колясках</h5></div>
        <attribute-field sub-title="При расположении сбоку от посетителя — не выше 1,4 м и не ниже 0,3 от уровня пола" v-model="value.attributes.attribute4"/>
        <attribute-field sub-title="При фронтальном подходе — не выше 1,2 м и не ниже 0,4 м от уровня пола" v-model="value.attributes.attribute5"/>

        <accessibility-score :attributes="value.attributes" type="service_middle"/>

        <div class="add-object__line --lrg">
            <h5 class="add-object__title">Комментарий к зоне оказания услуги</h5>
        </div>
        <div class="add-object__line">
                    <textarea class="add-object__textarea"
                              placeholder="Система оценила доступность зоны оказания услуги. Если вы не согласны с оценкой, вы можете оставить комментарий с пояснением"></textarea>
        </div>
    </div>
</template>

<script>
    import AccessibilityScore from "./AccessibilityScore";
    import AttributeField from "./AttributeField";
    export default {
        name: "ServiceAreaZoneStep",
        components: {AttributeField, AccessibilityScore},
        props: [
            'value',
            'definition'
        ],
    }
</script>

<style scoped>

</style>