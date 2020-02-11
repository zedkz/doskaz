<template>
    <div class="add-object__content">
        <attribute-field title="Вход на уровне земли" v-model="value.attributes.attribute1"/>
        <div class="add-object__line"><h5 class="add-object__title">Лестница наружная</h5></div>
        <attribute-field title="Предупреждающая полоса" sub-title="Тактильная за 30-40 см до первой и последней ступени марша шириной не менее 56 см, контрастная шириной 30 см" v-model="value.attributes.attribute2"/>
        <attribute-field title="Ширина проступей лестниц не менее 40 см" v-model="value.attributes.attribute3"/>
        <attribute-field title="Высота подъема ступеней не более 12 см" v-model="value.attributes.attribute4"/>
        <attribute-field title="Количество ступеней" sub-title="В одном марше от 3 до 12, одиночные ступени недопустимы " v-model="value.attributes.attribute5"/>
        <attribute-field title="Ширина марша лестниц не менее 1,35 м" v-model="value.attributes.attribute6"/>
        <div class="add-object__line --lrg"><h5 class="add-object__title --label">Поручни перил при перепадах высот более 0,45 м</h5></div>
        <attribute-field sub-title="Вдоль обеих сторон" v-model="value.attributes.attribute7"/>
        <attribute-field sub-title="На высоте 0,9 м для взрослых, 0,5 м для детей" v-model="value.attributes.attribute8"/>
        <attribute-field sub-title="Горизонтальный закругленный вылет после последней опоры 30 см" v-model="value.attributes.attribute9"/>
        <attribute-field sub-title="При ширине лестничного марша более 2,5 м — разделительные поручни" v-model="value.attributes.attribute10"/>
        <div class="add-object__line --lrg"><h5 class="add-object__title">Пандус наружный</h5></div>
        <div class="add-object__line"><h5 class="add-object__title --label">Покрытие пандуса</h5></div>
        <attribute-field sub-title="Твёрдые материалы" v-model="value.attributes.attribute11"/>
        <attribute-field sub-title="Без зазоров" v-model="value.attributes.attribute12"/>
        <attribute-field sub-title="Без вибрации при движении" v-model="value.attributes.attribute13"/>
        <attribute-field sub-title="Предотвращающее скольжение" v-model="value.attributes.attribute14"/>
        <attribute-field title="Ширина марша не менее 1,2 м" v-model="value.attributes.attribute15"/>
        <attribute-field title="Разворотные горизонтальные площадки" sub-title="Размеры 1,2 х 1,5 м" v-model="value.attributes.attribute16"/>
        <attribute-field title="Высота марша 40-45 см" v-model="value.attributes.attribute17"/>
        <attribute-field title="Уклон" sub-title="При высоте подъёма выше 20 см — 1 : 20 (5% или 2,9°) \n При высоте подъёма до 20 см — 1 : 10 (10% или 5,7°)" v-model="value.attributes.attribute18"/>
        <attribute-field title="Бортики не менее 5 см" v-model="value.attributes.attribute19"/>
        <div class="add-object__line --lrg"><h5 class="add-object__title">Поручни перил при перепадах высот более 0,45 м</h5></div>
        <attribute-field sub-title="Вдоль обеих сторон" v-model="value.attributes.attribute20"/>
        <attribute-field sub-title="На высоте 0,7-0,9 м для взрослых, 0,5 м для детей" v-model="value.attributes.attribute21"/>
        <attribute-field sub-title="Горизонтальный закругленный вылет после последней опоры 30 см" v-model="value.attributes.attribute22"/>
        <div class="add-object__line --lrg"><h5 class="add-object__title">Подъёмник наружный электрический</h5></div>
        <div class="add-object__line"><h5 class="add-object__title --label">Стационарные подъёмники</h5></div>
        <attribute-field sub-title="Параметры не менее 0,9 х 1,2 м" v-model="value.attributes.attribute23"/>
        <attribute-field sub-title="Жёсткое ограждение со всех сторон" v-model="value.attributes.attribute24"/>
        <attribute-field sub-title="Бортики" v-model="value.attributes.attribute25"/>
        <div class="add-object__line --lrg"><h5 class="add-object__title">Подъёмник наружный электрический</h5></div>
        <attribute-field title="Входная площадка с пандусом" sub-title="Размеры не менее 2,2 х 2,2 м" v-model="value.attributes.attribute26"/>
        <div class="add-object__line"><h5 class="add-object__title --label">Глубина пространства перед дверью</h5></div>
        <attribute-field sub-title="При открывании «от себя» — не менее 1,2 м" v-model="value.attributes.attribute27"/>
        <attribute-field sub-title="При открывании «к себе» — не менее 1,5 м" v-model="value.attributes.attribute28"/>
        <div class="add-object__line --lrg"><h5 class="add-object__title --label">Входная дверь</h5></div>
        <attribute-field sub-title="Открытие в противоположную сторону от пандуса" v-model="value.attributes.attribute29"/>
        <attribute-field sub-title="Ширина в свету не менее 90 см" v-model="value.attributes.attribute30"/>
        <attribute-field sub-title="Пороги не выше 1,4 см" v-model="value.attributes.attribute31"/>
        <div class="add-object__line --lrg"><h5 class="add-object__title --label">Стеклянная дверь</h5></div>
        <attribute-field sub-title="Наличие предупреждения для слабовидящих на стеклянной двери" v-model="value.attributes.attribute32"/>
        <attribute-field sub-title="Прямоугольник 10 х 20 см²" v-model="value.attributes.attribute33"/>
        <attribute-field sub-title="Цвет яркий (контрастный)" v-model="value.attributes.attribute34"/>
        <attribute-field sub-title="На высоте не ниже 1,2 м и не выше 1,5 м" v-model="value.attributes.attribute35"/>
        <div class="add-object__line --lrg"><h5 class="add-object__title --label">Тамбуры</h5></div>
        <attribute-field sub-title="1,5-1,8 м (глубина) х 2 м (ширина)" v-model="value.attributes.attribute36"/>
        <attribute-field sub-title="2,3 м (глубина) х  1,5 м (ширина)" v-model="value.attributes.attribute37"/>
        <div class="add-object__line --lrg"><h5 class="add-object__title">Ситуационная помощь на входе</h5></div>
        <div class="add-object__line"><h5 class="add-object__title --label">Кнопка вызова персонала</h5></div>
        <attribute-field sub-title="Доступность, высота 85 см  – 1 м" v-model="value.attributes.attribute38"/>
        <attribute-field sub-title="Навес от осадков" v-model="value.attributes.attribute39"/>
        <attribute-field sub-title="Шрифт Брайля" v-model="value.attributes.attribute40"/>

        <accessibility-score :attributes="value.attributes" type="entrance_middle"/>
        <div class="add-object__line --lrg">
            <h5 class="add-object__title">Комментарий к зоне входной группы</h5>
        </div>
        <div class="add-object__line">
                    <textarea class="add-object__textarea"
                              placeholder="Система оценила доступность входной группы. Если вы не согласны с оценкой, вы можете оставить комментарий с пояснением"></textarea>
        </div>
    </div>
</template>

<script>
    import AccessibilityScore from "@/components/object_add/AccessibilityScore";
    import AttributeField from "@/components/object_add/AttributeField";
    export default {
        name: "EntranceZoneStep",
        components: {AttributeField, AccessibilityScore},
        props: [
            'value'
        ]
    }
</script>

<style scoped>

</style>