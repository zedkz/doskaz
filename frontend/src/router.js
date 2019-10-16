import Vue from "vue";
import Router from "vue-router";
import MainPage from "./views/MainPage.vue";

Vue.use(Router);

export default new Router({
  mode: "history",
  base: process.env.BASE_URL,
  routes: [
    {
      path: "/",
      name: "Main page",
      component: MainPage
    }
  ]
});
