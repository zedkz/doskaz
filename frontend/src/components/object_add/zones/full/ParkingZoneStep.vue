<template>
    <div class="add-object__content">
        <attribute-field title="Количество парковочных мест" sub-title="Не менее одного на 25 мест" v-model="value.attributes.attribute1"/>
        <attribute-field title="Размер парковки" sub-title="Не менее 3,66 х 5,38 м" v-model="value.attributes.attribute2"/>
        <div class="add-object__line --lrg"><h5 class="add-object__title --label">Пешеходный проход рядом с машиноместом</h5></div>
        <attribute-field sub-title="1 место — не менее 1,2 м" v-model="value.attributes.attribute11"/>
        <attribute-field sub-title="Если два парковочных места являются смежными — не менее 1,5 м" v-model="value.attributes.attribute12"/>
        <div class="add-object__line"><h5 class="add-object__title --label">Обозначение автостоянки для инвалидов</h5></div>
        <attribute-field sub-title="Знак на плоскости стоянки" v-model="value.attributes.attribute3"/>
        <attribute-field sub-title="Знак на вертикальной поверхности (стене, столбе, стойке)" v-model="value.attributes.attribute4"/>
        <attribute-field sub-title="Знак 5.15 «Место стоянки»" v-model="value.attributes.attribute5"/>
        <attribute-field sub-title="Знак 7.15 «Инвалиды»" v-model="value.attributes.attribute6"/>
        <attribute-field sub-title="Стрелка и расстояние" v-model="value.attributes.attribute7"/>
        <attribute-field sub-title="Разметка на плоскости" v-model="value.attributes.attribute8"/>
        <div class="add-object__line"><h5 class="add-object__title --label">Съезд с тротуара на парковку</h5></div>
        <attribute-field sub-title="Наличие съезда" v-model="value.attributes.attribute13"/>
        <attribute-field sub-title="Ширина 1,5 м рекомендуется (было 0,9 м)" v-model="value.attributes.attribute9"/>
        <attribute-field sub-title="Перепад высот менее 1,5 см" v-model="value.attributes.attribute14"/>
        <attribute-field sub-title="Уклон 5%" v-model="value.attributes.attribute15"/>
        <attribute-field sub-title="Наличие предупреждающих полос" v-model="value.attributes.attribute16"/>
        <div class="add-object__line"><h5 class="add-object__title --label">Расстояние до входа в здание</h5></div>
        <attribute-field sub-title="Для общественных зданий менее 50 м" v-model="value.attributes.attribute10"/>
        <attribute-field sub-title="Для жилых зданий менее 100 м" v-model="value.attributes.attribute17"/>
        <div class="add-object__line"><h5 class="add-object__title --label">Путь движения снаружи здания (дорожки, тротуары, пандусы и пр.)</h5></div>
        <attribute-field sub-title="Ширина в одном направлении не менее 1,5 м" v-model="value.attributes.attribute18"/>
        <attribute-field sub-title="Ширина при встречном направлении более 2 м" v-model="value.attributes.attribute19"/>
        <attribute-field sub-title="Ширина в одном направлении не менее 1,5 м" v-model="value.attributes.attribute20"/>
        <attribute-field sub-title="Если из-за условий застройки ширина пути движения в пределах прямой видимости снижена до 1,2 м, то не более чем через каждые 25 м присутствуют горизонтальные площадки (карманы) размером не менее 2 х 1,8 м для обеспечения возможного разъезда людей на креслах-колясках." v-model="value.attributes.attribute21"/>
        <attribute-field sub-title="Пандусы на тротуарных дорожках в случае перепада уровней поверхностей более 2 см" v-model="value.attributes.attribute22"/>
        <attribute-field sub-title="Все безопасные пешеходные дорожки обозначены окрашиванием линий в желтый цвет либо отличительной текстурой поверхности" v-model="value.attributes.attribute23"/>
        <attribute-field title="Ширина транспортного проезда у входа" sub-title="Не менее 5 м (было 3 м)" v-model="value.attributes.attribute24"/>


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
    import AccessibilityScore from "@/components/object_add/AccessibilityScore";
    import AttributeField from "@/components/object_add/AttributeField";
    export default {
        name: "ParkingZoneStep",
        components: {AccessibilityScore, AttributeField},
        props: ['value']
    }
</script>

<style scoped>

</style>