export default {
    state() {
        return {
            authenticated: false,
            showLoginForm: false,
            user: null
        }
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
            const {data: user} = await this.$axios.get('/api/profile');
            commit('setUser', user);
            commit('hideLoginForm')
        },
        async deAuthenticate({commit}) {
            commit('setUser', null)
        },
        async oauthAuthenticate({dispatch}, {code, provider}) {
            await this.$axios.post('/api/token/oauth', {provider, code});
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