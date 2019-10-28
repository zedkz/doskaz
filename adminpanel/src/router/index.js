import Vue from 'vue'
import VueRouter from 'vue-router'
import Adminpanel from "../components/Adminpanel";

Vue.use(VueRouter);

const routes = [
  {
    path: '/admin',
    name: 'home',
    component: Adminpanel
  }
];

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
});

export default router
