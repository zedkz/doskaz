<template>
    <div>
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Редактирование объекта</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center"></div>
            </div>
        </div>
        <b-card>
            <loading :active="isLoading" :is-full-page="false"/>
            <form>
                <select2-field label="Форма" path="zones.type" :options="formOptions"/>
                <b-tabs content-class="mt-3" v-model="tab">
                    <b-tab title="Общая информация" active>
                        <input-field path="title" label="Наименование" :required="true"/>
                        <textarea-field label="Описание" path="description"/>
                        <select2-field label="Категория" v-model="categoryId" :options="categoryOptions"/>
                        <select2-field label="Подкатегория" path="categoryId" :required="true"
                                       :options="subCategoryOptions"/>
                        <input-field path="address" label="Адрес" :required="true"/>
                        <map-point-field path="point" label="Точка на карте" :required="true"
                                         @address="address = $event"/>
                        <text-input-collection path="videos" label="Видео"/>
                        <images-collection path="photos" label="Фото"/>
                    </b-tab>

                    <b-tab v-for="tab in tabs" :key="tab.key" :title="tab.title">
                        <zone :form="form" :zone="tab.group" :zone-property="tab.key"/>
                    </b-tab>
                </b-tabs>

                <button type="button" class="btn btn-primary" @click.prevent="submit">Сохранить</button>
                <a :href="`/objects/${$route.params.id}`" target="_blank" class="btn btn-link">Просмотр на сайте</a>
            </form>
        </b-card>
    </div>
</template>

<script>
    import {get, sync, call} from 'vuex-pathify'
    import Loading from "vue-loading-overlay";
    import 'vue-loading-overlay/dist/vue-loading.css';
    import InputField from "../../../components/crud/fields/InputField";
    import TextareaField from "../../../components/crud/fields/TextareaField";
    import Select2Field from "../../../components/crud/fields/Select2Field";
    import flatMap from "lodash/flatMap";
    import MapPointField from "../../../components/crud/fields/MapPoint";
    import TextInputCollection from "../../../components/crud/fields/TextInputCollection";
    import FormSelector from "../../../components/crud/fields/FormSelector";
    import Zone from "../../../components/objects/Zone";
    import ImagesCollection from "../../../components/crud/fields/ImagesCollection";

    export default {
        components: {
            ImagesCollection,
            Zone,
            FormSelector,
            TextInputCollection,
            MapPointField,
            Select2Field,
            TextareaField,
            InputField,
            Loading
        },
        data() {
            return {
                category: null,
                tab: 0
            }
        },
        async asyncData({$axios}) {
            const [{data: categories}, {data: attributes}] = await Promise.all([
                $axios.get('/api/objectCategories'),
                $axios.get('/api/objects/attributes'),
            ]);
            return {categories, attributes}
        },
        mounted() {
            const subCategory = flatMap(this.categories, category => category.subCategories.map(subCategory => ({
                ...subCategory,
                parentCategoryId: category.id
            })))
                .find(category => category.id === this.subCategoryId)

            this.categoryId = subCategory.parentCategoryId;
        },
        computed: {
            ...get('crud/edit', [
                'isLoading',
            ]),
            categoryId: {
                get() {
                    return this.category ? this.category.id : null
                },
                set(categoryId) {
                    this.category = this.categories.find(category => category.id === categoryId)
                }
            },
            categoryOptions() {
                return this.categories.map(category => ({
                    value: category.id,
                    title: category.title
                }))
            },
            ...sync('crud/edit/item@', {
                subCategoryId: 'categoryId',
                address: 'address'
            }),
            zones: get('crud/edit/item@zones'),
            ...get('crud/edit/item@zones', {
                form: 'type'
            }),
            subCategoryOptions() {
                if (this.category) {
                    return [{value: null, title: 'Не выбрано'}].concat(this.category.subCategories.map(category => ({
                        value: category.id,
                        title: category.title
                    })));
                }
                return [{value: null, title: 'Не выбрано'}];
            },
            formOptions() {
                return [
                   /* {value: 'small', title: 'Простая'},*/
                    {value: 'middle', title: 'Средняя'},
                    {value: 'full', title: 'Сложная'}
                ]
            },
            tabs() {
                return [
                    {title: 'Парковка', key: 'parking', group: 'parking'},
                    {title: 'Входная группа #1', key: 'entrance1', group: 'parking'},
                    {title: 'Входная группа #2', key: 'entrance2', group: 'parking'},
                    {title: 'Входная группа #3', key: 'entrance3', group: 'parking'},
                    {title: 'Пути движения по объекту', key: 'movement', group: 'movement'},
                    {title: 'Зона оказания услуги', key: 'service', group: 'service'},
                    {title: 'Туалет', key: 'toilet', group: 'toilet'},
                    {title: 'Навигация', key: 'navigation', group: 'navigation'},
                    {title: 'Доступность услуги', key: 'serviceAccessibility', group: 'serviceAccessibility'},
                ].filter(tab => this.zones[tab.key])
            }
        },
        async fetch({store, params: {id}}) {
            store.dispatch('crud/edit/reset');
            store.set('crud/edit/apiPath', '/api/admin/objects')
            await Promise.all([
                store.dispatch('crud/edit/loadItem', id),
                store.dispatch('objectAdding/init')
            ])
        },
        watch: {
            categoryId: {
                handler(newVal, prevVal) {
                    if (prevVal !== null) {
                        this.subCategoryId = null
                    }
                }
            }
        },
        methods: {
            submitForm: call('crud/edit/submit'),
            async submit() {
                try {
                    await this.submitForm();
                } catch (e) {
                      //if (this.validationErrors['first']) {
                          this.tab = 0
                     // }
                }
            },
        }
    }
</script>

<style scoped>

</style>
