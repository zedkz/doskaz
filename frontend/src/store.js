import Vue from 'vue'
import Vuex from 'vuex'
import authentication from "./store/authentication";
import comments from "./store/comments";
import objectCategories from "./store/objectCategories";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {

  },
  mutations: {

  },
  actions: {

  },
  modules: {
    authentication,
    comments,
    objectCategories
  }
})
