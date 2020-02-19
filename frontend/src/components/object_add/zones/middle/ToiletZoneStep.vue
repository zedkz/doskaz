<template>
    <div class="add-object__content">
        <div class="add-object__line"><h5 class="add-object__title --label">Наличие уборной</h5></div>
        <attribute-field sub-title="Расчётная численность посетителей более 50 человек" v-model="value.attributes.attribute1"/>
        <attribute-field sub-title="Продолжительности нахождения в здании более 60 минут" v-model="value.attributes.attribute2"/>
        <div class="add-object__line --lrg"><h5 class="add-object__title --label">Дверь в уборную</h5></div>
        <attribute-field sub-title="Дверь открывается наружу" v-model="value.attributes.attribute3"/>
        <attribute-field sub-title="Снаружи размещена криптограмма" v-model="value.attributes.attribute4"/>
        <attribute-field sub-title="Ширина двери не менее 1,2 м" v-model="value.attributes.attribute5"/>
        <attribute-field sub-title="Поручни на внутренней стороне двери длиной не менее 60 см" v-model="value.attributes.attribute6"/>
        <attribute-field sub-title="Высота порогов не более 1,4 см" v-model="value.attributes.attribute7"/>
        <attribute-field title="Размеры универсальной кабины не менее 1,65 х 2,0 м" v-model="value.attributes.attribute8"/>
        <div class="add-object__line --lrg"><h5 class="add-object__title --label">Другое оборудование</h5></div>
        <attribute-field sub-title="Крючки для одежды" v-model="value.attributes.attribute9"/>
        <attribute-field sub-title="Крючки для костылей" v-model="value.attributes.attribute10"/>
        <attribute-field sub-title="Крючки для других принадлежностей" v-model="value.attributes.attribute11"/>
        <attribute-field sub-title="Зеркало" v-model="value.attributes.attribute12"/>
        <attribute-field sub-title="Дозатор с мылом" v-model="value.attributes.attribute13"/>
        <attribute-field sub-title="Диспенсер для туалетной бумаги и салфеток" v-model="value.attributes.attribute14"/>
        <attribute-field sub-title="Электрическая сушилка для рук" v-model="value.attributes.attribute15"/>
        <attribute-field sub-title="Урна" v-model="value.attributes.attribute16"/>
        <attribute-field sub-title="Открывающиеся части предметов на высоте от 1,0 до 1,2 м" v-model="value.attributes.attribute17"/>
        <div class="add-object__line --lrg"><h5 class="add-object__title --label">Кнопка вызова SOS</h5></div>
        <attribute-field sub-title="На высоте от 40 см до 60 см над уровнем пола" v-model="value.attributes.attribute18"/>
        <attribute-field sub-title="На расстоянии от края унитаза от 15 см до 30 см" v-model="value.attributes.attribute19"/>
        <attribute-field sub-title="Указатель «Кнопка экстренного вызова»" v-model="value.attributes.attribute20"/>

        <accessibility-score :attributes="value.attributes" type="toilet_middle"/>

        <div class="add-object__line --lrg">
            <h5 class="add-object__title">Комментарий к зоне туалета</h5>
        </div>
        <div class="add-object__line">
                    <textarea class="add-object__textarea"
                              placeholder="Система оценила доступность зоны туалета. Если вы не согласны с оценкой, вы можете оставить комментарий с пояснением"></textarea>
        </div>
    </div>
</template>

<script>
    import AccessibilityScore from "@/components/object_add/AccessibilityScore";
    import AttributeField from "@/components/object_add/AttributeField";
    export default {
        name: "ToiletZoneStep",
        components: {AttributeField, AccessibilityScore},
        props: [
            'value'
        ],
    }
</script>

<style scoped>

</style>