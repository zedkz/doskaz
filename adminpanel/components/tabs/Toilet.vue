<template>
    <div>
        <h4>Наличие уборной</h4>
        <hr/>
        <attribute-selection-field :path="`${path}.attributes.attribute1`" label="Расчётная численность посетителей более 50 человек"/>
        <attribute-selection-field :path="`${path}.attributes.attribute2`" label="Продолжительности нахождения в здании более 60 минут"/>

        <h4>Дверь в уборную</h4>
        <hr/>
        <attribute-selection-field :path="`${path}.attributes.attribute3`" label="Дверь открывается наружу"/>
        <attribute-selection-field :path="`${path}.attributes.attribute4`" label="Снаружи размещена криптограмма"/>
        <attribute-selection-field :path="`${path}.attributes.attribute5`" label="Ширина двери не менее 1,2 м"/>
        <attribute-selection-field :path="`${path}.attributes.attribute6`" label="Поручни на внутренней стороне двери длиной не менее 60 см"/>
        <attribute-selection-field :path="`${path}.attributes.attribute7`" label="Высота порогов не более 1,4 см"/>
        <attribute-selection-field :path="`${path}.attributes.attribute8`" label="Размеры универсальной кабины не менее 1,65 х 2,0 м"/>

        <h4>Другое оборудование</h4>
        <hr/>
        <attribute-selection-field :path="`${path}.attributes.attribute9`" label="Крючки для одежды"/>
        <attribute-selection-field :path="`${path}.attributes.attribute10`" label="Крючки для костылей"/>
        <attribute-selection-field :path="`${path}.attributes.attribute11`" label="Крючки для других принадлежностей"/>
        <attribute-selection-field :path="`${path}.attributes.attribute12`" label="Зеркало"/>
        <attribute-selection-field :path="`${path}.attributes.attribute13`" label="Дозатор с мылом"/>
        <attribute-selection-field :path="`${path}.attributes.attribute14`" label="Диспенсер для туалетной бумаги и салфеток"/>
        <attribute-selection-field :path="`${path}.attributes.attribute15`" label="Электрическая сушилка для рук"/>
        <attribute-selection-field :path="`${path}.attributes.attribute16`" label="Урна"/>
        <attribute-selection-field :path="`${path}.attributes.attribute17`" label="Открывающиеся части предметов на высоте от 1,0 до 1,2 м"/>

        <h4>Кнопка вызова SOS</h4>
        <hr/>
        <attribute-selection-field :path="`${path}.attributes.attribute18`" label="На высоте от 40 см до 60 см над уровнем пола"/>
        <attribute-selection-field :path="`${path}.attributes.attribute19`" label="На расстоянии от края унитаза от 15 см до 30 см"/>
        <attribute-selection-field :path="`${path}.attributes.attribute20`" label="Указатель «Кнопка экстренного вызова»"/>
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
        name: "Toilet",
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
