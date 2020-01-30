export default {
    state() {
        return {
            categories: [],
            categoryId: []
        }
    },
    mutations: {
        setCategories(state, payload) {
            state.categories = payload
        },
        setCategoryId(state, payload) {
            state.categoryId.push(payload)
        }
    },
    actions: {
        getCategories({commit, state}) {
            if (state.categories.length) {
                return;
            }
            return this.$axios.get(`/api/objectCategories`).then(res => {
                commit('setCategories', res.data);
            })
        }
    },
    getters: {
        retCategories: state => {
            return state.categories
        },
        retCategoryId: state => {
            return state.categoryId
        }
    }
}