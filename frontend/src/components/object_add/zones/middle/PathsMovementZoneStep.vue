<template>
    <div class="add-object__content">
        <attributes-list form="middle" zone="movement" :value="value.attributes"/>


     <!--   <div class="add-object__line &#45;&#45;lrg"><h5 class="add-object__title">Территория пути передвижения</h5></div>
        <attribute-field title="Ширина коридора 1,5 м" v-model="value.attributes.attribute1"/>
        <div class="add-object__line &#45;&#45;lrg"><h5 class="add-object__title &#45;&#45;label">Покрытие пола</h5></div>
        <attribute-field sub-title="Твёрдые материалы" v-model="value.attributes.attribute2"/>
        <attribute-field sub-title="Без зазоров" v-model="value.attributes.attribute3"/>
        <attribute-field sub-title="Без вибрации при движении" v-model="value.attributes.attribute4"/>
        <attribute-field sub-title="Предотвращающее скольжение" v-model="value.attributes.attribute5"/>
        <div class="add-object__line &#45;&#45;lrg"><h5 class="add-object__title">Территория пути передвижения</h5></div>
        <attribute-field title="Ширина дверей не менее 90 см" v-model="value.attributes.attribute6"/>
        <attribute-field title="Высота порогов не более 1,4 см" v-model="value.attributes.attribute7"/>
        <div class="add-object__line &#45;&#45;lrg"><h5 class="add-object__title &#45;&#45;label">Стеклянная дверь</h5></div>
        <attribute-field sub-title="Наличие предупреждения для слабовидящих на стеклянной двери" v-model="value.attributes.attribute8"/>
        <attribute-field sub-title="Прямоугольник 10 х 20 см²" v-model="value.attributes.attribute9"/>
        <attribute-field sub-title="Цвет яркий (контрастный)" v-model="value.attributes.attribute10"/>
        <attribute-field sub-title="На высоте не ниже 1,2 м и не выше 1,5 м" v-model="value.attributes.attribute11"/>
        <div class="add-object__line &#45;&#45;lrg"><h5 class="add-object__title">Лестницы внутренние</h5></div>
        <div class="add-object__line"><h5 class="add-object__title &#45;&#45;label">Рифление и контрастные полосы на ступенях лестниц (верхняя и нижняя ступени в каждом марше)</h5></div>
        <attribute-field sub-title="Контрастный цвет" v-model="value.attributes.attribute12"/>
        <attribute-field sub-title="Тактильные указатели" v-model="value.attributes.attribute13"/>
        <attribute-field sub-title="Ширина полосы 30 см" v-model="value.attributes.attribute14"/>
        <attribute-field title="Ширина марша лестниц не менее 1,35 м" v-model="value.attributes.attribute15"/>
        <attribute-field title="Ширина проступей лестниц не менее 30 см" v-model="value.attributes.attribute16"/>
        <attribute-field title="Высота подъема ступеней не более 15 см" v-model="value.attributes.attribute17"/>
        <attribute-field title="Максимальное число ступеней на пролет" sub-title="В одном марше от 3 до 12, одиночные ступени недопустимы" v-model="value.attributes.attribute18"/>
        <div class="add-object__line &#45;&#45;lrg"><h5 class="add-object__title &#45;&#45;label">Поручни перил при перепадах высот более 0,45 м</h5></div>
        <attribute-field sub-title="Вдоль обеих сторон" v-model="value.attributes.attribute19"/>
        <attribute-field sub-title="На высоте 0,9 м для взрослых, 0,5 м для детей" v-model="value.attributes.attribute20"/>
        <attribute-field sub-title="Горизонтальный закругленный вылет после последней опоры 30 см" v-model="value.attributes.attribute21"/>
        <div class="add-object__line &#45;&#45;lrg"><h5 class="add-object__title">Пандусы внутренние</h5></div>
        <div class="add-object__line &#45;&#45;lrg"><h5 class="add-object__title &#45;&#45;label">Покрытие пандуса</h5></div>
        <attribute-field sub-title="Твёрдые материалы" v-model="value.attributes.attribute22"/>
        <attribute-field sub-title="Без зазоров" v-model="value.attributes.attribute23"/>
        <attribute-field sub-title="Без вибрации при движении" v-model="value.attributes.attribute24"/>
        <attribute-field sub-title="Предотвращающее скольжение" v-model="value.attributes.attribute25"/>
        <attribute-field title="Разворотные горизонтальные площадки" sub-title="Размеры 1,2 х 1,5 м" v-model="value.attributes.attribute26"/>
        <div class="add-object__line &#45;&#45;lrg"><h5 class="add-object__title &#45;&#45;label">Поручни перил при перепадах высот более 0,45 м</h5></div>
        <attribute-field sub-title="Вдоль обеих сторон" v-model="value.attributes.attribute27"/>
        <attribute-field sub-title="На высоте 0,7-0,9 м для взрослых, 0,5 м для детей" v-model="value.attributes.attribute28"/>
        <attribute-field sub-title="Горизонтальный закругленный вылет после последней опоры 30 см" v-model="value.attributes.attribute29"/>
        <attribute-field title="Ширина марша не менее 1,2 м" v-model="value.attributes.attribute30"/>
        <attribute-field title="Высота марша 40-45 см" v-model="value.attributes.attribute31"/>
        <attribute-field title="Уклон" sub-title="При высоте подъёма выше 20 см — 1 : 20 (5% или 2,9°)" v-model="value.attributes.attribute32"/>
        <attribute-field title="Бортики не менее 5 см" v-model="value.attributes.attribute33"/>
        <div class="add-object__line &#45;&#45;lrg"><h5 class="add-object__title">Лифты и электрические подъемники внутренние</h5></div>
        <attribute-field title="Габариты кабины лифта" sub-title="Не менее 1,3 х 2,1 м" v-model="value.attributes.attribute34"/>
        <attribute-field title="Ширина двери в кабину не менее 90 см" v-model="value.attributes.attribute35"/>
        <div class="add-object__line &#45;&#45;lrg"><h5 class="add-object__title &#45;&#45;label">Информация для людей, имеющих проблемы со зрением</h5></div>
        <attribute-field sub-title="Надписи, выполненные шрифтом Брайля на кнопках" v-model="value.attributes.attribute36"/>
        <attribute-field sub-title="Не сенсорные кнопки" v-model="value.attributes.attribute37"/>-->
        <accessibility-score :attributes="value.attributes" type="movement_middle"/>

        <div class="add-object__line --lrg">
            <h5 class="add-object__title">Комментарий к зоне путей движения по объекту</h5>
        </div>
        <div class="add-object__line">
                    <textarea class="add-object__textarea"
                              placeholder="Система оценила доступность путей движения по объекту. Если вы не согласны с оценкой, вы можете оставить комментарий с пояснением"></textarea>
        </div>
    </div>
</template>

<script>
    import AccessibilityScore from "@/components/object_add/AccessibilityScore";
    import AttributeField from "@/components/object_add/AttributeField";
    import AttributesList from "../../AttributesList";
    export default {
        name: "PathsMovementZoneStep",
        components: {AttributesList, AttributeField, AccessibilityScore},
        props: [
            'value'
        ]
    }
</script>

<style scoped>

</style>