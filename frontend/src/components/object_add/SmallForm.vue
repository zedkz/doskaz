<template>
    <div>
        <div class="add-object__form">
            <div class="add-object__line --lrg">
                <h5 class="add-object__title">
                    Общая информация
                </h5>
            </div>
            <first-step/>
        </div>

        <div class="add-object__form" style="margin-top: 20px">
            <div v-for="tab in zonesTabsAvailable" :key="tab.key" style="margin-bottom: 36px">
                <div class="add-object__line --lrg">
                    <h5 class="add-object__title">
                        {{tab.title}}
                    </h5>
                </div>
                <div class="add-object__content">
                    <attributes-list
                            :zone="tab.group" form="small" :value="data[tab.key].attributes"
                            @change="updateData({path: `${tab.key}.attributes.${$event.path}`, value: $event.value})"
                    />
                </div>
            </div>

            <div class="add-object__button-b" style="justify-content: right">
                <button type="button" class="add-object__button --submit" @click.prevent="submit">
                    <span>Отправить</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import FirstStep from "./FirstStep";
    import {get, call} from 'vuex-pathify'
    import AttributesList from "./AttributesList";

    export default {
        name: "SmallForm",
        components: {AttributesList, FirstStep},
        computed: {
            ...get('objectAdding', [
                'zonesTabsAvailable',
                'formZones',
                'data'
            ]),
        },
        methods: {
            ...call('objectAdding', [
                'submit',
                'updateData'
            ])
        }
    }
</script>

<style>

</style>