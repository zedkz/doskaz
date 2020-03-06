import Vue from 'vue'
import VuejsDatePicker from 'vuejs-datepicker'
import maskedInput from 'vue-masked-input'
import YmapPlugin, { loadYmap } from 'vue-yandex-maps'
import VueGallery from 'vue-gallery'


Vue.use(YmapPlugin)


const plugin = {
    install(Vue) {
        Vue.component('VuejsDatePicker', VuejsDatePicker);
        Vue.component('MaskedInput', maskedInput);
        Vue.component('gallery', VueGallery)
    }
};

Vue.use(plugin);