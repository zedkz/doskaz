<template>
    <div class="add-object__content">
        <attribute-field title="Количество парковочных мест" sub-title="Не менее одного на 25 мест" v-model="value.attributes.attribute1"/>
        <attribute-field title="Размер парковки" sub-title="Не менее 3,66 х 5,38 м" v-model="value.attributes.attribute2"/>
        <div class="add-object__line"><h5 class="add-object__title">Обозначение автостоянки для инвалидов</h5></div>
        <attribute-field title="Знак на плоскости стоянки" v-model="value.attributes.attribute3"/>
        <attribute-field title="Знак на вертикальной поверхности (стене, столбе, стойке)" v-model="value.attributes.attribute4"/>
        <attribute-field title="Знак 5.15 «Место стоянки»" v-model="value.attributes.attribute5"/>
        <attribute-field title="Знак 7.15 «Инвалиды»" v-model="value.attributes.attribute6"/>
        <attribute-field title="Стрелка и расстояние" v-model="value.attributes.attribute7"/>
        <attribute-field title="Разметка на плоскости" v-model="value.attributes.attribute8"/>
        <attribute-field title="Съезд с тротуара на парковку" sub-title="Рекомендуется ширина 1,5 м" v-model="value.attributes.attribute9"/>
        <attribute-field title="Расстояние до входа в здание" sub-title="Для общественных зданий менее 50 м" v-model="value.attributes.attribute10"/>

        <accessibility-score :attributes="value.attributes" :type="'parking_middle'"/>
        <div class="add-object__line --lrg">
            <h5 class="add-object__title">Комментарий к зоне парковки</h5>
        </div>
        <div class="add-object__line">
            <textarea
                    class="add-object__textarea"
                    v-model="value.comment"
                    placeholder="Система оценила доступность парковки. Если вы не согласны с оценкой, вы можете оставить комментарий с пояснением"
            />
        </div>
    </div>
</template>

<script>
    import AttributeField from "./AttributeField";
    import AccessibilityScore from "./AccessibilityScore";
    export default {
        name: "ParkingZoneStep",
        components: {AccessibilityScore, AttributeField},
        props: ['value']
    }
</script>

<style scoped>

</style>