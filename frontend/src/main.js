import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import api from "./api"
import VueMeta from 'vue-meta'
import Vuelidate from 'vuelidate'
import Moment from 'moment'
import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js'

Vue.use(Vuelidate),
Vue.use(Moment),
Vue.use(VueMeta, {
  // optional pluginOptions
  refreshOnceOnNavigation: true
})

Vue.config.productionTip = false;

api.interceptors.response.use(response => response, error => {
  if (error.response.status === 401) {
    store.dispatch('deAuthenticate')
  }
  return Promise.reject(error)
});


new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app');
