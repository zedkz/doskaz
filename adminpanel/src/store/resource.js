import api from '@/api'

export default (resourceName, title) => ({
    namespaced: true,
    state: {
        title
    },
    modules: {
        list: {
            namespaced: true,
            state: {
                items: [],
                count: 0,
                isLoading: false,
                page: 1
            },
            mutations: {
                startLoading(state) {
                    state.items = [];
                    state.count = 0;
                    state.isLoading = true;
                    state.page = 1
                },
                loadItems(state, items, count) {
                    state.items = items;
                    state.count = count;
                    state.isLoading = false
                },
                changePage(state, page) {
                    state.page = page;
                }
            },
            actions: {
                async load({commit}) {
                    commit('startLoading');
                    const {data: {items, count}} = await api.get(resourceName);
                    commit('loadItems', items, count)
                },
                async reload({commit, state: {page}}) {
                    const {data: {items, count}} = await api.get(resourceName, {
                        params: {
                            offset: (page - 1) * 20
                        }
                    });
                    commit('loadItems', items, count)
                },
                async changePage({dispatch, commit}, page) {
                    commit('startLoading');
                    commit('changePage', page);
                    await dispatch('reload')
                }
            }
        },
        edit: {
            namespaced: true,
            state: {
                isLoading: false,
                item: {},
                operationState: null
            },
            mutations: {
                startLoadItem(state) {
                    state.operationState = null;
                    state.isLoading = true;
                    state.item = {}
                },
                loadItem(state, item) {
                    state.item = item;
                    state.isLoading = false;
                },
                changeField(state, {field, value}) {
                    state.item[field] = value
                },
                setLoading(state, loading) {
                    state.isLoading = loading
                },
                changeOperationState(state, operationState) {
                    state.operationState = operationState
                }
            },
            actions: {
                async load({commit}, id) {
                    commit('startLoadItem');
                    const {data: item} = await api.get(`${resourceName}/${id}`);
                    commit('loadItem', item)
                },
                async submit({commit, dispatch, state: {item}}) {
                    if (item.id) {
                        commit('setLoading', true);
                        try {
                            await api.put(`${resourceName}/${item.id}`, item);
                            commit('changeOperationState', 'success');
                            dispatch('load', item.id);
                        }catch (e) {
                            commit('changeOperationState', 'fail')
                        }
                        finally {
                            commit('setLoading', false);
                        }
                    }
                }
            }
        }
    }
})