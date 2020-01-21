import api from "@/api";
export default {
  state: {
    categories: []
  },
  mutations: {
    setCategories(state, payload) {
      state.categories = payload
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
    }
  }
}