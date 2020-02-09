import Vue from "vue";
import Router from "vue-router";
import MainPage from "./views/MainPage.vue";
import UserObjects from "./views/UserObjects.vue";
import UserAchievments from "./views/UserAchievments.vue";
import Blog from "./views/Blog.vue";
import BlogInside from "./views/BlogInside.vue";
import Complaint from "./views/Complaint.vue";
import Oauth from "./components/Oauth";
import Objects from "./views/Objects.vue";
import ObjectAdd from "./views/ObjectAdd.vue";
import UserProfileEdit from "./views/UserProfileEdit.vue";
import UserTickets from "./views/UserTickets.vue";
import UserTasks from "./views/UserTasks.vue";
import UserComments from "./views/UserComments.vue";

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
      path: "/login",
      name: "login",
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
      path: "/user/tickets",
      name: "userTickets",
      component: UserTickets
    },
    {
      path: "/user/tasks",
      name: "userTasks",
      component: UserTasks
    },
    {
      path: "/user/comments",
      name: "userComments",
      component: UserComments
    },
    {
      path: "/user/profile/edit",
      name: "userProfileEdit",
      component: UserProfileEdit
    },
    {
      path: "/blog/:categorySlug?",
      name: "blog",
      component: Blog
    },
    {
      path: "/blog/:categorySlug/:postSlug",
      name: "blogView",
      component: BlogInside
    },
    {
      path: "/complaint",
      name: "complaint",
      component: Complaint
    },
    {
      path: "/startCategory",
      name: "StartCategory",
      component: MainPage
    },
    {
      path: "/objects",
      name: "Objects",
      component: Objects
    },
    {
      path: "/object/add",
      name: "ObjectAdd",
      component: ObjectAdd
    }
  ]
});
