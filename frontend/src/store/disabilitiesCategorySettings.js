import {make} from 'vuex-pathify'

export const state = function () {
    return {
        popupOpen: false,
        category: null
    }
}

export const mutations = make.mutations(state)

export const actions = {
    init({commit}) {
        const category = this.app.$cookies.get('userCategory');
        if (category) {
            commit('SET_CATEGORY', category);
        } else {
            commit('SET_POPUP_OPEN', true)
        }
    },
    selectCategory({commit}, category) {
        commit('SET_CATEGORY', category);
        commit('SET_POPUP_OPEN', false);
        this.app.$cookies.set('userCategory', category)
    }
}