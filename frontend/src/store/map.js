import {make} from 'vuex-pathify'

export const state = () => ({
    coordinates: [52.2944954, 76.970281],
    zoom: 14
})

export const mutations = make.mutations(state)

/*
export const actions = {
    toCoordinates({commit}, {coordinates, zoom}) {
        commit('SET_COORDINATES', coordinates)
    }
}*/
