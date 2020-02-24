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
                <client-only>
                    <yandex-map
                            @map-was-initialized="mapInitialized"
                            @click="click"
                            :style="{width: '100%', height: '300px'}"
                            :zoom="4"
                            :coords.sync="mapCoords"
                            :controls="['zoomControl']"
                            :settings="{
                    apiKey: 'c1050142-1c08-440e-b357-f2743155c1ec',
                    lang: 'ru_RU',
                    coordorder: 'latlong',
                    version: '2.1'
                }">
                        <ymap-marker :coords="value.point" v-if="value.point" marker-id="point"></ymap-marker>
                    </yandex-map>
                </client-only>
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
                <div class="input" v-for="(photo, index) in value.videos" :key="index">
                    <input type="text" placeholder="http://" v-model="value.videos[index]"/>
                </div>
                <button type="button" class="add-link" @click="value.videos.push('')">Добавить еще видео</button>
            </div>
        </field>

        <field :error="(errors || {}).photos">
            <div class="col">
                <label class="add-object__label">Загрузить фото</label>
            </div>
            <div class="col --long">
                <photo-uploader v-model="value.photos" @is-uploading="$emit('is-photos-uploading', $event)"/>
            </div>
        </field>
    </div>
</template>

<script>
    import Field from "./Field";
    import PhotoUploader from "./PhotoUploader";
    export default {
        name: "FirstStep",
        components: {PhotoUploader, Field},
        props: [
            'value',
            'categories',
            'errors'
        ],
        data() {
            return {
                coords: null,
                selectedCategory: null,
                mapCoords: [47.74887674893552, 67.04712168264118],
                zoom: null
            }
        },
        methods: {
            mapInitialized(map) {
                this.map = map;
            },

            click(e) {
                this.value.point = e.get('coords');
                this.mapCoords = this.value.point;
                if(this.map && !this.zoom) {
                    this.zoom = 12
                    this.map.setCenter(this.value.point, 12)
                }
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

<style>
    .input:not(:first-of-type) {
        margin-top: 20px;
    }
</style>