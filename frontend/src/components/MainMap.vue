<template>
  <yandexMap
    class="ymap"
    :settings="settings"
    :coords="coords"
    :zoom="zoom"
    :controls="controls"
    @map-was-initialized="mapWasInitialized"
  >
    <!--<ymap-marker marker-id="123" :coords="markerCoords" :icon="markerIcon" />-->
  </yandexMap>
</template>

<script>
import { yandexMap, ymapMarker } from "vue-yandex-maps";

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
      //coords: [62.2, 31.9],
      zoom: 14,
      controls: [],

      markerCoords: [51.159807, 71.446774],
      markerIcon: {
        layout: "default#imageWithContent",
        imageHref: "",
        imageSize: [50, 61],
        imageOffset: [0, 0],
        content:
          "<img src='" +
          require("@/assets/icons/bar.svg") +
          "' style='max-width: 27px; max-height: 27px; z-index: 1;'/>",
        contentOffset: [0, 0],
        contentLayout:
          '<div style="border: none; position: relative; display: flex; width: 50px; height: 61px; padding-bottom: 11px; justify-content: center; align-items: center;"><svg width="50" height="61" viewBox="0 0 50 61" fill="none" xmlns="http://www.w3.org/2000/svg" style="position: absolute; top: 0; left: 0; z-index: 0;"><path d="M50 0H0V50H14.6667L25 60.3333L35.3333 50H50V0Z" fill="#F8AC1A"/></svg>$[properties.iconContent]</div>'
      }
    };
  },
  components: { yandexMap, ymapMarker },
  // mounted() {
  //   this.$root.$on("setCategoryId", function(id) {
  //     console.log(this.mapInstance);
  //     this.mapInstance.container.fitToViewport();
  //   });
  // },
  methods: {
    mapWasInitialized(map) {
      this.$root.$on("setCategoryId", function(id) {
        let yamap = new ymaps.RemoteObjectManager(
          `/api/objects/ymaps?bbox=%b&zoom=%z&categories[0]=${id}`,
          {
            splitRequests: false
          }
        );
        map.geoObjects.removeAll();
        map.geoObjects.add(yamap);
        map.container.fitToViewport();
      });

      map.container.fitToViewport();
    }
  },
  // computed: {
  //   map() {
  //     return new ymaps.RemoteObjectManager(
  //       `/api/objects/ymaps?bbox=%b&zoom=%z&categories[0]=${this.categoryId}`,
  //       {
  //         splitRequests: false
  //       }
  //     );
  //   },
  //   categoryId() {
  //     return this.$store.getters.retCategoryId;
  //   }
  // }
};
</script>

<style lang="scss">
.ymap {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}
</style>
