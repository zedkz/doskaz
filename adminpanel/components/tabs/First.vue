<template>
    <div>
        <input-field path="first.name" label="Наименование" :required="true"/>
        <input-field path="first.address" label="Адрес" :required="true"/>
        <map-point-field path="first.point" label="Точка на карте" :required="true" @address="updateAddress"/>
        <select2-field label="Категория" v-model="categoryId" :options="categoryOptions"/>
        <select2-field label="Подкатегория" path="first.categoryId" :required="true" :options="subCategoryOptions"/>
        <field-wrapper label="Ссылки на видео">
            <a v-for="(video, index) in videos" :key="index">{{video}}</a>
        </field-wrapper>

        <field-wrapper label="Фото">
            <div class="row justify-content-start">
                <div v-for="(photo, index) in photos" :key="index" class="col-sm-2 mb-4">
                    <a :href="photo" target="_blank"><img :src="photo" style="max-width: 100%"/></a>
                </div>
            </div>
        </field-wrapper>
    </div>
</template>

<script>
    import MapPointField from "../crud/fields/MapPoint";
    import InputField from "../crud/fields/InputField";
    import Select2Field from "../crud/fields/Select2Field";
    import {get} from 'vuex-pathify'
    import flatMap from 'lodash/flatMap'
    import FieldWrapper from "../crud/FieldWrapper";

    export default {
        name: "First",
        components: {FieldWrapper, Select2Field, InputField, MapPointField},
        methods: {
            updateAddress(newAddress) {
                this.$store.commit('crud/edit/SET_PROPERTY_BY_PATH', {value: newAddress, path: 'first.address'})
            },
            async loadCategories() {
                const {data} = await this.$axios.get('/api/objectCategories')
                this.categories = data;
                const subCategory = flatMap(data, category => category.subCategories.map(subCategory => ({
                    ...subCategory,
                    parentCategoryId: category.id
                })))
                    .find(category => category.id === this.subCategoryId)

                this.categoryId = subCategory.parentCategoryId;
            }
        },
        computed: {
            categoryOptions() {
                return [{value: null, title: 'Не выбрано'}].concat(this.categories.map(category => ({
                    value: category.id,
                    title: category.title
                })))
            },
            subCategoryOptions() {
                if (this.category) {
                    return [{value: null, title: 'Не выбрано'}].concat(this.category.subCategories.map(category => ({
                        value: category.id,
                        title: category.title
                    })));
                }
                return [{value: null, title: 'Не выбрано'}];
            },
            categoryId: {
                get() {
                    return this.category ? this.category.id : null
                },
                set(categoryId) {
                    this.category = this.categories.find(category => category.id === categoryId)
                }
            },
            subCategoryId: get('crud/edit/item.first.categoryId'),
            videos: get('crud/edit/item.first.videos'),
            photos: get('crud/edit/item.first.photos')
        },
        data() {
            return {
                category: null,
                categories: []
            }
        },
        mounted() {
            this.loadCategories()
        },
        watch: {
            categoryId: {
                handler(newVal, prevVal) {
                    if(prevVal !== null) {
                        this.$store.commit('crud/edit/SET_PROPERTY_BY_PATH', {value: null, path: 'first.categoryId'})
                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>
