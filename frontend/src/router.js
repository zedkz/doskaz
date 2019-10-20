import Vue from "vue";
import Router from "vue-router";
import MainPage from "./views/MainPage.vue";
import Oauth from "./components/Oauth";

Vue.use(Router);

export default new Router({
  mode: "history",
  base: process.env.BASE_URL,
  routes: [
    {
      path: "/",
      name: "main",
      component: MainPage
    },
    {
      path: "/oauth/:provider",
      name: "oauth",
      component: Oauth
    }
  ]
});
