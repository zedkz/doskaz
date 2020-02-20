<template>
    <div>
        <attribute-selection-field :path="`${path}.attributes.attribute1`" label="Вход на уровне земли"/>

        <h4>Лестница наружная</h4>
        <hr/>
        <attribute-selection-field :path="`${path}.attributes.attribute2`" label="Предупреждающая полоса - Тактильная за 30-40 см до первой и последней ступени марша шириной не менее 56 см, контрастная шириной 30 см"/>
        <attribute-selection-field :path="`${path}.attributes.attribute3`" label="Ширина проступей лестниц не менее 40 см"/>
        <attribute-selection-field :path="`${path}.attributes.attribute4`" label="Высота подъема ступеней не более 12 см"/>
        <attribute-selection-field :path="`${path}.attributes.attribute5`" label="Количество ступеней - В одном марше от 3 до 12, одиночные ступени недопустимы"/>
        <attribute-selection-field :path="`${path}.attributes.attribute6`" label="Ширина марша лестниц не менее 1,35 м"/>

        <h4>Поручни перил при перепадах высот более 0,45 м</h4>
        <hr/>
        <attribute-selection-field :path="`${path}.attributes.attribute7`" label="Вдоль обеих сторон"/>
        <attribute-selection-field :path="`${path}.attributes.attribute8`" label="На высоте 0,9 м для взрослых, 0,5 м для детей"/>
        <attribute-selection-field :path="`${path}.attributes.attribute9`" label="Горизонтальный закругленный вылет после последней опоры 30 см"/>
        <attribute-selection-field :path="`${path}.attributes.attribute10`" label="При ширине лестничного марша более 2,5 м — разделительные поручни"/>

        <h4>Пандус наружный</h4>
        <hr/>
        <attribute-selection-field :path="`${path}.attributes.attribute11`" label="Покрытие пандуса - Твёрдые материалы"/>
        <attribute-selection-field :path="`${path}.attributes.attribute12`" label="Без зазоров"/>
        <attribute-selection-field :path="`${path}.attributes.attribute13`" label="Без вибрации при движении"/>
        <attribute-selection-field :path="`${path}.attributes.attribute14`" label="Предотвращающее скольжение"/>
        <attribute-selection-field :path="`${path}.attributes.attribute15`" label="Ширина марша не менее 1,2 м"/>
        <attribute-selection-field :path="`${path}.attributes.attribute16`" label="Разворотные горизонтальные площадки - Размеры 1,2 х 1,5 м"/>
        <attribute-selection-field :path="`${path}.attributes.attribute17`" label="Высота марша 40-45 см"/>
        <attribute-selection-field :path="`${path}.attributes.attribute18`" label="Уклон - При высоте подъёма выше 20 см — 1 : 20 (5% или 2,9°) \n При высоте подъёма до 20 см — 1 : 10 (10% или 5,7°)"/>
        <attribute-selection-field :path="`${path}.attributes.attribute19`" label="Бортики не менее 5 см"/>

        <h4>Поручни перил при перепадах высот более 0,45 м</h4>
        <hr/>
        <attribute-selection-field :path="`${path}.attributes.attribute20`" label="Вдоль обеих сторон"/>
        <attribute-selection-field :path="`${path}.attributes.attribute21`" label="На высоте 0,7-0,9 м для взрослых, 0,5 м для детей"/>
        <attribute-selection-field :path="`${path}.attributes.attribute22`" label="Горизонтальный закругленный вылет после последней опоры 30 см"/>

        <h4>Подъёмник наружный электрический</h4>
        <hr/>
        <attribute-selection-field :path="`${path}.attributes.attribute23`" label="Стационарные подъёмники - Параметры не менее 0,9 х 1,2 м"/>
        <attribute-selection-field :path="`${path}.attributes.attribute24`" label="Жёсткое ограждение со всех сторон"/>
        <attribute-selection-field :path="`${path}.attributes.attribute25`" label="Бортики"/>

        <h4>Входная площадка, входная дверь, тамбур</h4>
        <hr/>
        <attribute-selection-field :path="`${path}.attributes.attribute26`" label="Входная площадка с пандусом - Размеры не менее 2,2 х 2,2 м"/>

        <h5>Глубина пространства перед дверью</h5>
        <hr/>
        <attribute-selection-field :path="`${path}.attributes.attribute27`" label="Глубина пространства перед дверью - При открывании «от себя» — не менее 1,2 м"/>
        <attribute-selection-field :path="`${path}.attributes.attribute28`" label="При открывании «к себе» — не менее 1,5 м"/>

        <h5>Входная дверь</h5>
        <hr/>
        <attribute-selection-field :path="`${path}.attributes.attribute29`" label="Открытие в противоположную сторону от пандуса"/>
        <attribute-selection-field :path="`${path}.attributes.attribute30`" label="Ширина в свету не менее 90 см"/>
        <attribute-selection-field :path="`${path}.attributes.attribute31`" label="Пороги не выше 1,4 см"/>

        <h5>Стеклянная дверь</h5>
        <hr/>
        <attribute-selection-field :path="`${path}.attributes.attribute32`" label="Наличие предупреждения для слабовидящих на стеклянной двери"/>
        <attribute-selection-field :path="`${path}.attributes.attribute33`" label="Прямоугольник 10 х 20 см²"/>
        <attribute-selection-field :path="`${path}.attributes.attribute34`" label="Цвет яркий (контрастный)"/>
        <attribute-selection-field :path="`${path}.attributes.attribute35`" label="На высоте не ниже 1,2 м и не выше 1,5 м"/>

        <h5>Тамбуры</h5>
        <hr/>
        <attribute-selection-field :path="`${path}.attributes.attribute36`" label="Тамбуры - 1,5-1,8 м (глубина) х 2 м (ширина)"/>
        <attribute-selection-field :path="`${path}.attributes.attribute37`" label="2,3 м (глубина) х  1,5 м (ширина)"/>

        <h4>Ситуационная помощь на входе</h4>
        <hr/>
        <h5>Кнопка вызова персонала</h5>
        <hr/>
        <attribute-selection-field :path="`${path}.attributes.attribute38`" label="Кнопка вызова персонала - Доступность, высота 85 см  – 1 м"/>
        <attribute-selection-field :path="`${path}.attributes.attribute39`" label="Навес от осадков"/>
        <attribute-selection-field :path="`${path}.attributes.attribute40`" label="Шрифт Брайля"/>

        <textarea-field label="Комментарий" :path="`${path}.comment`" :disabled="true"/>

        <h4>Оценка доступности</h4>
        <hr/>
        <accessibility-score :attributes="attributes"/>
    </div>
</template>

<script>
    import Fields from "../crud/Fields";
    import AttributeSelectionField from "../crud/fields/AttributeSelectionField";
    import AccessibilityScore from "../AccessibilityScore";
    import {get} from "vuex-pathify";
    import _ from 'lodash'
    import TextareaField from "../crud/fields/TextareaField";

    export default {
        name: "Entrance",
        components: {TextareaField, AccessibilityScore, AttributeSelectionField, Fields},
        props: [
            'path'
        ],
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
