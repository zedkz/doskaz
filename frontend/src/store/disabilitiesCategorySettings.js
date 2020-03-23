import {make} from 'vuex-pathify'

export const state = function () {
    return {
        popupOpen: false,
        category: null
    }
}

export const mutations = make.mutations(state)

export const actions = {
    init({commit, rootState}) {
        const category = rootState.settings.userCategory;
        if (category) {
            commit('SET_CATEGORY', category);
        } else {
            commit('SET_POPUP_OPEN', true)
        }
    },
    selectCategory({dispatch, commit}, category) {
        commit('SET_CATEGORY', category);
        commit('SET_POPUP_OPEN', false);
        dispatch('settings/selectUserCategory', category, {root: true})
    },
    closePopup({commit}) {
        commit('SET_POPUP_OPEN', false)
    }
}