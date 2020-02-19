<template>
    <div>
        <h4>Территория пути передвижения</h4>
        <hr/>
        <attribute-selection-field :path="`${path}.attributes.attribute1`" label="Ширина коридора 1,5 м"/>

        <h5>Покрытие пола</h5>
        <hr/>
        <attribute-selection-field :path="`${path}.attributes.attribute2`" label="Твёрдые материалы"/>
        <attribute-selection-field :path="`${path}.attributes.attribute3`" label="Без зазоров"/>
        <attribute-selection-field :path="`${path}.attributes.attribute4`" label="Без вибрации при движении"/>
        <attribute-selection-field :path="`${path}.attributes.attribute5`" label="Предотвращающее скольжение"/>

        <h4>Территория пути передвижения</h4>
        <hr/>
        <attribute-selection-field :path="`${path}.attributes.attribute6`" label="Ширина дверей не менее 90 см"/>
        <attribute-selection-field :path="`${path}.attributes.attribute7`" label="Высота порогов не более 1,4 см"/>

        <h5>Стеклянная дверь</h5>
        <hr/>
        <attribute-selection-field :path="`${path}.attributes.attribute8`" label="Наличие предупреждения для слабовидящих на стеклянной двери"/>
        <attribute-selection-field :path="`${path}.attributes.attribute9`" label="Прямоугольник 10 х 20 см²"/>
        <attribute-selection-field :path="`${path}.attributes.attribute10`" label="Цвет яркий (контрастный)"/>
        <attribute-selection-field :path="`${path}.attributes.attribute11`" label="На высоте не ниже 1,2 м и не выше 1,5 м"/>

        <h4>Лестницы внутренние</h4>
        <hr/>
        <h5>Рифление и контрастные полосы на ступенях лестниц (верхняя и нижняя ступени в каждом марше)</h5>
        <hr/>
        <attribute-selection-field :path="`${path}.attributes.attribute12`" label="Контрастный цвет"/>
        <attribute-selection-field :path="`${path}.attributes.attribute13`" label="Тактильные указатели"/>
        <attribute-selection-field :path="`${path}.attributes.attribute14`" label="Ширина полосы 30 см"/>
        <attribute-selection-field :path="`${path}.attributes.attribute15`" label="Ширина марша лестниц не менее 1,35 м"/>
        <attribute-selection-field :path="`${path}.attributes.attribute16`" label="Ширина проступей лестниц не менее 30 см"/>
        <attribute-selection-field :path="`${path}.attributes.attribute17`" label="Высота подъема ступеней не более 15 см"/>
        <attribute-selection-field :path="`${path}.attributes.attribute18`" label="Максимальное число ступеней на пролет - В одном марше от 3 до 12, одиночные ступени недопустимы"/>

        <h5>Поручни перил при перепадах высот более 0,45 м</h5>
        <hr/>
        <attribute-selection-field :path="`${path}.attributes.attribute19`" label="Вдоль обеих сторон"/>
        <attribute-selection-field :path="`${path}.attributes.attribute20`" label="На высоте 0,9 м для взрослых, 0,5 м для детей"/>
        <attribute-selection-field :path="`${path}.attributes.attribute21`" label="Горизонтальный закругленный вылет после последней опоры 30 см"/>

        <h4>Пандусы внутренние</h4>
        <hr/>
        <h5>Покрытие пандуса</h5>
        <hr/>
        <attribute-selection-field :path="`${path}.attributes.attribute22`" label="Твёрдые материалы"/>
        <attribute-selection-field :path="`${path}.attributes.attribute23`" label="Без зазоров"/>
        <attribute-selection-field :path="`${path}.attributes.attribute24`" label="Без вибрации при движении"/>
        <attribute-selection-field :path="`${path}.attributes.attribute25`" label="Предотвращающее скольжение"/>
        <attribute-selection-field :path="`${path}.attributes.attribute26`" label="Разворотные горизонтальные площадки - Размеры 1,2 х 1,5 м"/>

        <h5>Поручни перил при перепадах высот более 0,45 м</h5>
        <hr/>
        <attribute-selection-field :path="`${path}.attributes.attribute27`" label="Поручни перил при перепадах высот более 0,45 м - Вдоль обеих сторон"/>
        <attribute-selection-field :path="`${path}.attributes.attribute28`" label="На высоте 0,7-0,9 м для взрослых, 0,5 м для детей"/>
        <attribute-selection-field :path="`${path}.attributes.attribute29`" label="Горизонтальный закругленный вылет после последней опоры 30 см"/>
        <attribute-selection-field :path="`${path}.attributes.attribute30`" label="Ширина марша не менее 1,2 м"/>
        <attribute-selection-field :path="`${path}.attributes.attribute31`" label="Высота марша 40-45 см"/>
        <attribute-selection-field :path="`${path}.attributes.attribute32`" label="Уклон - При высоте подъёма выше 20 см — 1 : 20 (5% или 2,9°)"/>
        <attribute-selection-field :path="`${path}.attributes.attribute33`" label="Бортики не менее 5 см"/>

        <h4>Лифты и электрические подъемники внутренние</h4>
        <hr/>
        <attribute-selection-field :path="`${path}.attributes.attribute34`" label="Габариты кабины лифта - Не менее 1,3 х 2,1 м"/>
        <attribute-selection-field :path="`${path}.attributes.attribute35`" label="Ширина двери в кабину не менее 90 см"/>

        <h5>Информация для людей, имеющих проблемы со зрением</h5>
        <hr/>
        <attribute-selection-field :path="`${path}.attributes.attribute36`" label="Надписи, выполненные шрифтом Брайля на кнопках"/>
        <attribute-selection-field :path="`${path}.attributes.attribute37`" label="Не сенсорные кнопки"/>

        <h4>Оценка доступности</h4>
        <hr/>
        <accessibility-score :attributes="item[path].attributes"/>
    </div>
</template>

<script>
    import Fields from "../crud/Fields";
    import AttributeSelectionField from "../crud/fields/AttributeSelectionField";
    import AccessibilityScore from "../AccessibilityScore";
    import {get} from "vuex-pathify";
    export default {
        name: "Movement",
        components: {AccessibilityScore, AttributeSelectionField, Fields},
        props: [
            'path'
        ],
        computed: {
            item: get('crud/edit/item')
        },
    }
</script>

<style scoped>

</style>
