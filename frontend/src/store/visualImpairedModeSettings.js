import {make} from 'vuex-pathify'
import defaults from 'lodash/defaults'

export const state = () => ({
    enabled: false
})

export const mutations = make.mutations(state);

export const actions = {
    async init({commit, dispatch}) {
        const settings = defaults(this.app.$cookies.get('vi.settings') || {}, {
            enabled: false
        })
        commit('SET_ENABLED', settings.enabled)
    },

    enable({commit, dispatch}) {
        commit('SET_ENABLED', true)
        dispatch('updateSettings')
        this.$router.go()
    },
    disable({commit, dispatch}) {
        commit('SET_ENABLED', false)
        dispatch('updateSettings')
        this.$router.go()
    },
    updateSettings({state}) {
        this.app.$cookies.set('vi.settings', state, {
            maxAge: 3600 * 24 * 365,
            path: '/'
        });
    }
}