import {make} from 'vuex-pathify'

export const state = function () {
    return {
        categories: [
            {key: 'movement', title: 'Люди, передвигающиеся на кресло-коляске'},
            {key: 'vision', title: 'Люди с инвалидностью по зрению'},
            {key: 'limb', title: 'Люди с нарушением опорно-двигательного аппарата'},
            {key: 'hearing', title: 'Люди с инвалидностью по слуху'},
            {key: 'temporal', title: 'Временно травмированные люди'},
            {key: 'babyCarriage', title: 'Люди с детскими колясками'},
            {key: 'missingLimbs', title: 'Люди с отсутствующими конечностями'},
            {key: 'pregnant', title: 'Беременные женщины'},
            {key: 'intellectual', title: 'Люди с интелектуальной инвалидностью'},
            {key: 'agedPeople', title: 'Пожилые люди'},
            {key: 'justView', title: 'Просто посмотреть'},
        ],
        popupOpen: false,
        category: null
    }
}

export const mutations = make.mutations(state)

export const getters = {
    currentCategory: state => state.categories.find(category => category.key === state.category)
}

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