<template>
    <yandex-map
            class="ymap"
            :settings="settings"
            :coords="coords"
            :zoom="zoom"
            :controls="controls"
            @map-was-initialized="mapWasInitialized"
    />
</template>

<script>
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
                coords: [52.2944954, 76.970281],
                zoom: 14,
                controls: [],
                markerCoords: [51.159807, 71.446774]
            };
        },
        methods: {
            mapWasInitialized(map) {
                if(!ymaps.layout.storage.get('custom#objectIconLayout')) {
                    const CustomObjectIconLayout = ymaps.templateLayoutFactory.createClass(
                        `<div style="border: none;  display: flex; width: 50px; height: 61px; padding-bottom: 11px; justify-content: center; align-items: center; top: -60px; left: -25px; position:absolute;">
                        <svg width="50" height="61" viewBox="0 0 50 61" fill="none" xmlns="http://www.w3.org/2000/svg" style="position: absolute; top: 0; left: 0; z-index: 0;">
                            <path d="M50 0H0V50H14.6667L25 60.3333L35.3333 50H50V0Z" fill="$[properties.color]"/>
                        </svg>
                        $[properties.iconContent]
                        <i class='fa fa-2x $[properties.icon]' style='z-index: 1; color: white'></i>
                    </div>`
                    );
                    ymaps.layout.storage.add('custom#objectIconLayout', CustomObjectIconLayout);
                }

                let url = '/api/objects/ymaps?bbox=%b&zoom=%z';
                let yamap = new ymaps.RemoteObjectManager(url, {splitRequests: false});

                map.geoObjects.add(yamap);
                yamap.objects.events.add(['click'], e => {
                    this.$router.push({name: 'index-objects-id', params: {id: e.get('objectId')}})
                });

                this.$root.$on("setCategoryId", function (id) {
                    let url = '/api/objects/ymaps?bbox=%b&zoom=%z';
                    let count = 0;
                    id.forEach(e => {
                        url = url + `&categories[${count}]=${e}`;
                        count++
                    });
                    yamap.setUrlTemplate(url);
                    yamap.reloadData()
                });
            }
        },
        beforeDestroy() {
            this.$root.$off('setCategoryId')
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
