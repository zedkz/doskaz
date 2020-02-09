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
