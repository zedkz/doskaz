import Vue from "vue";
import Router from "vue-router";
import MainPage from "./views/MainPage.vue";
import UserObjects from "./views/UserObjects.vue";
import UserAchievments from "./views/UserAchievments.vue";
import Blog from "./views/Blog.vue";
import BlogInside from "./views/BlogInside.vue";
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
    },
    {
      path: "/user/objects",
      name: "userObjects",
      component: UserObjects
    },
    {
      path: "/user/achievments",
      name: "userAchievments",
      component: UserAchievments
    },
    {
      path: "/blog/:categorySlug?",
      name: "blog",
      component: Blog
    },
    {
      path: "/blog/inside",
      name: "blogInside",
      component: BlogInside
    }
  ]
});
