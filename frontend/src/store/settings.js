import {make} from 'vuex-pathify'
import defaults from 'lodash/defaults'

export const state = () => ({
    cityId: null,
    userCategory: null
})

export const mutations = make.mutations(state);

export const actions = {
    async init({state, rootState, commit}) {
        const settings = defaults(this.app.$cookies.get('settings') || {}, {
            cityId: rootState.cities.list[0].id
        })
        commit('SET_CITY_ID', settings.cityId)
        commit('SET_USER_CATEGORY', settings.userCategory)
    },
    select({commit, dispatch}, cityId) {
        commit('SET_CITY_ID', cityId)
        dispatch('saveSettings')
    },
    selectUserCategory({commit, dispatch}, userCategory) {
        commit('SET_USER_CATEGORY', userCategory)
        dispatch('saveSettings')
    },
    saveSettings({state}) {
        this.app.$cookies.set('settings', state, {
            maxAge: 3600 * 24 * 365
        });
    }
}