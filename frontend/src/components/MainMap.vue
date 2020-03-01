<template>
    <yandex-map
            class="ymap"
            :settings="settings"
            :coords.sync="coordinates"
            :zoom.sync="zoom"
            :controls="controls"
            @map-was-initialized="mapWasInitialized"
    />
</template>

<script>
    import {sync, get} from 'vuex-pathify'
    import queryString from 'query-string'
    import debounce from 'lodash/debounce'

    export default {
        data() {
            return {
                mapInstance: Object,
                settings: {
                    apiKey: "c1050142-1c08-440e-b357-f2743155c1ec",
                    lang: "ru_RU",
                    coordorder: "latlong",
                    version: "2.1"
                },
                controls: []
            };
        },
        methods: {
            mapWasInitialized(map) {
                this.map = map;
                if (!ymaps.layout.storage.get('custom#objectIconLayout')) {
                    const CustomObjectIconLayout = ymaps.templateLayoutFactory.createClass(
                        `<div style="border: none; font-size: 22px; display: flex; width: 50px; height: 60px; padding-bottom: 11px; justify-content: center; align-items: center; top: -60px; left: -25px; position:absolute;">
                        <svg width="50" height="60" viewBox="0 0 50 61" fill="none" xmlns="http://www.w3.org/2000/svg" style="position: absolute; top: 0; left: 0; z-index: 0;">
                            <path d="M50 0H0V50H14.6667L25 60.3333L35.3333 50H50V0Z" fill="$[properties.color]"/>
                        </svg>
                        $[properties.iconContent]
                        <i class='fa $[properties.icon]' style='z-index: 1; color: white'></i>
                    </div>`
                    );
                    ymaps.layout.storage.add('custom#objectIconLayout', CustomObjectIconLayout);
                }
                let yamap = new ymaps.RemoteObjectManager(this.url, {splitRequests: false});
                this.objectManager = yamap
                map.geoObjects.add(yamap);
                yamap.objects.events.add(['click'], e => {
                    this.$router.push({name: 'objects-id', params: {id: e.get('objectId')}})
                });
            },
            applyFilter: debounce(function (val) {
                this.objectManager.setUrlTemplate(val)
                this.objectManager.reloadData()
            }, 800, {leading: true})
        },
        watch: {
            url(val) {
                this.applyFilter(val)

            }
        },
        computed: {
            ...sync('map', [
                'coordinates',
                'zoom',
            ]),
            ...get('map', [
                'selectedCategories',
                'accessibilityLevels',
                'search'
            ]),
            url() {
                const serializedParams = queryString.stringify({
                    categories: this.selectedCategories,
                    accessibilityLevels: this.accessibilityLevels,
                    search: this.search
                }, {arrayFormat: 'index'})

                return '/api/objects/ymaps?bbox=%b&zoom=%z'.concat(serializedParams ? `&${serializedParams}` : '')
            }
        }
    };
</script>

<style lang="scss" scoped>
    .ymap {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
    }
</style>
