import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import api from "./api";

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
