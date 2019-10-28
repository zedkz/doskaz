import api from "../api";

export default {
    state: {
        user: null
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
            return state;
        }
    },
    actions: {
        async loadUser({commit}) {
            const {data: user} = await api.get('users/me');
            commit('setUser', user);
        },
        async logout({commit}) {
            await api.delete('token');
            commit('setUser', null);
        }
    }
}