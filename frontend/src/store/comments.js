export default {
  state: {
    commentId: null,
    comments: []
  },
  mutations: {
    setId(state, id) {
      if (id == undefined) {
        id = null
      }
      state.commentId = id;
    }
  },
  actions: {},
  getters: {
    getId: state => {
      return state.commentId
    }
  }
}