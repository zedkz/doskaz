import api from '@/api'
import get from 'lodash/get'
import set from 'lodash/set'
import cloneDeep from 'lodash/cloneDeep'
import transform from 'lodash/transform'


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
                },
                async delete({dispatch}, id) {
                    await api.delete(`${resourceName}/${id}`);
                    await dispatch('load')
                },
            }
        },
        edit: {
            namespaced: true,
            state: {
                isLoading: false,
                item: {},
                operationState: null,
                violations: {}
            },
            mutations: {
                startLoadItem(state) {
                    state.violations = {};
                    state.operationState = null;
                    state.isLoading = true;
                    state.item = {}
                },
                loadItem(state, item) {
                    state.item = item;
                    state.isLoading = false;
                },
                changeField(state, {field, value}) {
                    state.item = set(cloneDeep(state.item), field, value);

                },
                setLoading(state, loading) {
                    state.isLoading = loading
                },
                changeOperationState(state, operationState) {
                    state.operationState = operationState
                },
                replaceViolations(state, payload) {
                    state.violations = transform(payload, (res, i) => {
                        res[i.propertyPath] = i;
                    }, {});
                },
                reset(state) {
                    state.violations = {};
                    state.operationState = null;
                    state.isLoading = false;
                    state.item = {}
                },
                initialize(state, itemData) {
                    state.item = itemData
                }
            },
            getters: {
                getItemProperty: state => property => get(state.item, property)
            },
            actions: {
                async load({commit}, id) {
                    commit('startLoadItem');
                    const {data: item} = await api.get(`${resourceName}/${id}`);
                    commit('loadItem', item)
                },
                async create({commit, state: {item}}) {
                    commit('setLoading', true);
                    try {
                        const {data: createdItem} = await api.post(`${resourceName}`, item);
                        await commit('loadItem', createdItem);
                    } catch (e) {
                        const violations = get(e, 'response.data.errors.violations', []);
                        commit('replaceViolations', violations);
                        throw e
                    } finally {
                        commit('setLoading', false);
                    }
                },
                async submit({commit, dispatch, state: {item}}) {
                    commit('setLoading', true);
                    try {
                        await api.put(`${resourceName}/${item.id}`, item);
                        await dispatch('load', item.id);
                        commit('changeOperationState', 'success');
                    } catch (e) {
                        const violations = get(e, 'response.data.errors.violations', []);
                        commit('replaceViolations', violations);
                        commit('changeOperationState', 'fail')
                    }
                    commit('setLoading', false);
                },
                async reset({commit}) {
                    commit('reset')
                }
            }
        }
    }
})