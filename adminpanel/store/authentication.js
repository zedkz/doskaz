import {make} from 'vuex-pathify'

export const state = () => ({
    user: null
});

export const mutations = make.mutations(state);

export const actions = {
    async loadUser({commit}) {
        const {data: user} = await this.$axios.get('/api/profile');
        commit('SET_USER', user);
    },
};
