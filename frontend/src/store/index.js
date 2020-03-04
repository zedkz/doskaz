import pathify from 'vuex-pathify'

export const plugins = [pathify.plugin];

export const actions = {
    async nuxtServerInit({dispatch}) {
        dispatch('disabilitiesCategorySettings/init')
    }
}