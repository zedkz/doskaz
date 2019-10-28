import Vue from 'vue'
import Vuex from 'vuex'
import authenticatedUser from "./authenticatedUser";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {},
    mutations: {},
    actions: {},
    modules: {
        authenticatedUser
    }
})
