import {make} from 'vuex-pathify'

export const state = () => ({
    list: []
})

export const mutations = make.mutations(state)

export const actions = {
    async load({commit}) {
        const {data: cities} = await this.$axios.get('/api/cities')
        commit('SET_LIST', cities)
    }
}