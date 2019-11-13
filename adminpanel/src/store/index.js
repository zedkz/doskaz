import Vue from 'vue'
import Vuex from 'vuex'
import authenticatedUser from "./authenticatedUser";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        resourceName: null
    },
    mutations: {
        changeResourceName(state, payload) {
            state.resourceName = payload
        }
    },
    actions: {
        changeResourceName({commit}, payload) {
            commit('changeResourceName', payload)
        }
    },
    getters: {
        resourceName: state => state.resourceName
    },
    modules: {
        authenticatedUser
    }
})
