import {make} from 'vuex-pathify'

export const state = function () {
    return {
        categories: [
            {key: 'movement', title: 'Люди, передвигающиеся на кресло-коляске', category: 'movement'},
            {key: 'vision', title: 'Люди с инвалидностью по зрению', category: 'vision'},
            {key: 'limb', title: 'Люди с нарушением опорно-двигательного аппарата', category: 'limb'},
            {key: 'hearing', title: 'Люди с инвалидностью по слуху', category: 'hearing'},
            {key: 'temporal', title: 'Временно травмированные люди', category: 'limb'},
            {key: 'babyCarriage', title: 'Люди с детскими колясками', category: 'movement'},
            {key: 'missingLimbs', title: 'Люди с отсутствующими конечностями', category: 'limb'},
            {key: 'pregnant', title: 'Беременные женщины', category: 'limb'},
            {key: 'intellectual', title: 'Люди с интелектуальной инвалидностью', category: 'intellectual'},
            {key: 'agedPeople', title: 'Пожилые люди', category: 'limb'},
            {key: 'justView', title: 'Просто посмотреть', category: 'movement'},
        ],
        popupOpen: false,
        category: null
    }
}

export const mutations = make.mutations(state)

export const getters = {
    currentCategory: state => state.categories.find(category => category.key === state.category),
    currentCategoryValue: (state, getters) => getters.currentCategory ? getters.currentCategory.category : undefined
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