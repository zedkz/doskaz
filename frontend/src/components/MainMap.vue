<template>
  <yandexMap class="ymap" :settings="settings" :coords="coords" :zoom="zoom" :controls="controls" />
</template>

<script>
import { yandexMap } from "vue-yandex-maps";

export default {
  data() {
    return {
      settings: {
        apiKey: "c1050142-1c08-440e-b357-f2743155c1ec",
        lang: "ru_RU",
        coordorder: "latlong",
        version: "2.1"
      },
      coords: [51.159807, 71.438674],
      zoom: 15,
      controls: ["zoomControl"]
    };
  },
  components: { yandexMap }
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