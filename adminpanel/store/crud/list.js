import {dispatch, make} from 'vuex-pathify'

const ITEMS_PER_PAGE = 20;

export const state = () => ({
    items: [],
    pagesCount: 1,
    currentPage: 1,
    isLoading: false,
    apiPath: null
});

export const actions = {
    reset({commit}) {
        commit('SET_ITEMS', []);
        commit('SET_PAGES_COUNT', 1);
        commit('SET_CURRENT_PAGE', 1);
        commit('SET_API_PATH', null);
    },
    async load({commit, state}) {
        commit('SET_IS_LOADING', true);
        const {data: {items, count}} = await this.$axios.get(state.apiPath, {
            params: {
                limit: ITEMS_PER_PAGE,
                offset: ITEMS_PER_PAGE * (state.currentPage - 1)
            }
        });
        commit('SET_ITEMS', items);
        commit('SET_PAGES_COUNT', count);
        commit('SET_IS_LOADING', false);
    },
    async changePage({commit, dispatch}, page) {
        commit('SET_CURRENT_PAGE', page);
        await dispatch('load')
    },
    async delete({commit, dispatch, state}, item) {
        commit('SET_IS_LOADING', true)
        await this.$axios.delete(`${state.apiPath}/${item.id}`);
        //commit('SET_CURRENT_PAGE', 1);
        dispatch('load')
    }
};

export const mutations = make.mutations(state);
