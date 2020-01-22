import api from "@/api";
export default {
  state: {
    categories: [],
    categoryId: Number
  },
  mutations: {
    setCategories(state, payload) {
      state.categories = payload
    },
    setCategoryId(state, payload) {
      state.categoryId = payload
    }
  },
  actions: {
    getCategories(ctx) {
      api.get(`objectCategories`).then(res => {
        ctx.commit('setCategories', res.data);
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