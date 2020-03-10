<template>
    <div class="add-object__content">
        <attributes-list
                :form="form"
                :zone="zone"
                :value="attributes"
                @change="updateData({path: `${zoneKey}.attributes.${$event.path}`, value: $event.value})"
        />
        <accessibility-score :attributes="attributes" :type="zoneType" :key="zoneType"/>
        <div class="add-object__line --lrg">
            <h5 class="add-object__title">Комментарий к оценке зоны</h5>
        </div>
        <div class="add-object__line">
                    <textarea class="add-object__textarea"
                              v-model="comment"
                              placeholder="Система самостоятельно оценила доступность зоны на основании ваших ответов. Если вы не согласны с оценкой, пожалуйста, оставьте в этом поле ваш комментарий с пояснениями. Модератор сайта сможет исправить оценку сайта."></textarea>
        </div>
    </div>
</template>

<script>
    import AttributesList from "./AttributesList";
    import AccessibilityScore from "./AccessibilityScore";
    import {sync, get, call} from 'vuex-pathify'

    export default {
        name: "ZoneStep",
        components: {AccessibilityScore, AttributesList},
        props: [
            'form',
            'zone',
            'zoneKey'
        ],
        methods: {
            updateData: call('objectAdding/updateData')
        },
        computed: {
            comment: sync('objectAdding/data@[:zoneKey].comment'),
            attributes: get('objectAdding/data[:zoneKey].attributes'),
            zoneType() {
                return `${this.zone}_${this.form}`
            }
        }
    }
</script>

<style scoped>

</style>