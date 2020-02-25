import {make} from 'vuex-pathify'

export const state = () => ({
    coordinates: [52.2944954, 76.970281],
    zoom: 14,
    selectedCategories: []
})

export const mutations = make.mutations(state)


export const actions = {
    toggleCategory({state, commit}, category) {
        if (!state.selectedCategories.includes(category)) {
            commit('SET_SELECTED_CATEGORIES', [...state.selectedCategories, category])
        } else {
            commit('SET_SELECTED_CATEGORIES', state.selectedCategories.filter(item => item !== category))
        }
    }
}
