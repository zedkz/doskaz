import pathify from 'vuex-pathify'

export const plugins = [pathify.plugin];

export const actions = {
    async nuxtServerInit({dispatch}) {
        const {data} = await this.$axios.get('/api/cities/detect')
        await Promise.all([
            await dispatch('authentication/loadUser'),
            await dispatch('cities/load')
        ])
        await dispatch('settings/init')
        dispatch('disabilitiesCategorySettings/init')
        console.log(data);
    }
}