import api from "../api";

export default {
    state: {
        authenticated: false,
        showLoginForm: false,
        user: null
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
            return state;
        },
        showLoginForm(state) {
            state.showLoginForm = true;
            return state
        },
        hideLoginForm(state) {
            state.showLoginForm = false;
            return state
        }
    },
    actions: {
        async loadUser({commit}) {
            const {data: user} = await api.get('users/me');
            commit('setUser', user);
            commit('hideLoginForm')
        },
        async deAuthenticate({commit}) {
            commit('setUser', null)
        },
        async oauthAuthenticate({dispatch}, {code, provider}) {
            await api.post('token/oauth', {provider, code});
            await dispatch('loadUser')
        },
        showLoginForm({commit}) {
            commit('showLoginForm')
        },
        hideLoginForm({commit}) {
            commit('hideLoginForm')
        }
    }
}