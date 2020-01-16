import Vue from 'vue'
import Vuex from 'vuex'
import authentication from "./store/authentication";
import comments from "./store/comments";

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
    comments
  }
})
