<template>
    <div class="add-object__content">
        <field :error="(errors || {}).name">
            <div class="col">
                <label class="add-object__label" for="input_name">Наименование</label>
            </div>
            <div class="col --long">
                <div class="input">
                    <input id="input_name" v-model.trim="value.name" type="text" placeholder="Например, суши-бар Saya Sushi">
                </div>
            </div>
        </field>

        <field :error="(errors || {}).address">
            <div class="col">
                <label class="add-object__label">Адрес</label>
            </div>
            <div class="col --long">
                <div class="input">
                    <input type="text" placeholder="Улица и номер дома" v-model.trim="value.address">
                </div>
            </div>
        </field>

        <field :error="(errors || {}).point">
            <div class="col"><label class="add-object__label --title">Точка на карте</label></div>
            <div class="col --long">
                <yandex-map
                        @click="click"
                        :style="{width: '100%', height: '300px'}"
                        :zoom="4"
                        :coords.sync="mapCoords"
                        :controls="[]"
                        :settings="{
                    apiKey: 'c1050142-1c08-440e-b357-f2743155c1ec',
                    lang: 'ru_RU',
                    coordorder: 'latlong',
                    version: '2.1'
                }">
                    <ymap-marker :coords="value.point" v-if="value.point" marker-id="point"></ymap-marker>
                </yandex-map>
            </div>
        </field>
        <div class="add-object__line --lrg">
            <div class="col">
                <label class="add-object__label">Категория</label>
            </div>
            <div class="col --long">
                <div class="select">
                    <select v-model="selectedCategory">
                        <option disabled :value="null">Выберите категорию</option>
                        <option :value="category" v-for="category in categories" :key="category.id">{{ category.title
                            }}
                        </option>
                    </select>
                </div>
            </div>
        </div>
        <field :error="(errors || {}).categoryId">
            <div class="col">
                <label class="add-object__label">Подкатегория</label>
            </div>
            <div class="col --long">
                <div class="select">
                    <select :disabled="!selectedCategory" v-model="value.categoryId">
                        <option disabled :value="null">Выберите подкатегорию</option>
                        <template v-if="selectedCategory">
                            <option :value="category.id" v-for="category in selectedCategory.subCategories"
                                    :key="category.id">{{ category.title }}
                            </option>
                        </template>
                    </select>
                </div>
            </div>
        </field>
        <field>
            <div class="col">
                <label class="add-object__label">Ссылка на видео</label>
            </div>
            <div class="col --long">
                <div class="input">
                    <input type="text" placeholder="http://">
                </div>
                <button type="button" class="add-link">Добавить еще фото</button>
            </div>
        </field>
        <field :error="(errors || {}).photos">
            <div class="col">
                <label class="add-object__label">Загрузить фото</label>
            </div>
            <div class="col --long">
                <div class="photo-input__wrapper">
                    <div class="photo-input required">
                        <input type="file" accept="image/*"/>
                        <span></span>
                    </div>
                    <div class="photo-input required">
                        <input type="file" accept="image/*"/>
                        <span></span>
                    </div>
                    <div class="photo-input required">
                        <input type="file" accept="image/*"/>
                        <span></span>
                    </div>
                    <div class="photo-input required">
                        <input type="file" accept="image/*"/>
                        <span></span>
                    </div>
                    <div class="photo-input required">
                        <input type="file" accept="image/*"/>
                        <span></span>
                    </div>
                </div>
                <button type="button" class="add-link">Добавить еще фото</button>
            </div>
        </field>
    </div>
</template>

<script>
    import Field from "./Field";
    export default {
        name: "FirstStep",
        components: {Field},
        props: [
            'value',
            'categories',
            'errors'
        ],
        data() {
            return {
                coords: null,
                selectedCategory: null,
                mapCoords: [47.74887674893552, 67.04712168264118]
            }
        },
        methods: {
            click(e) {
                this.value.point = e.get('coords');
                this.mapCoords = this.value.point;
                ymaps.geocode(this.value.point).then(res => {
                    const result = res.geoObjects.get(0);
                    if(result.getThoroughfare()) {
                        this.value.address = [result.getThoroughfare(), result.getPremiseNumber()].filter(item => !!item).join(', ')
                    } else {
                        this.value.address = ''
                    }
                });
            }
        },
        watch: {
            selectedCategory() {
                this.value.categoryId = null
            }
        }
    }
</script>

<style scoped>

</style>