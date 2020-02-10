export default {
    state() {
        return {
            authenticated: false,
            user: null
        }
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
            return state;
        }
    },
    actions: {
        async loadUser({commit}) {
            const {data: user} = await this.$axios.get('/api/profile');
            commit('setUser', user);
        },
        async deAuthenticate({commit}) {
            commit('setUser', null)
        },
        async oauthAuthenticate({dispatch}, {code, provider}) {
            await this.$axios.post('/api/token/oauth', {provider, code});
            await dispatch('loadUser');
        },
        async phoneAuthenticate({dispatch}, idToken) {
            await this.$axios.post('/api/token/phone', {idToken});
            await dispatch('loadUser');
            const redirect = this.app.$cookies.get('redirect') || '/';
            this.app.$cookies.remove('redirect');
            await this.$router.push(redirect)
        }
    }
}