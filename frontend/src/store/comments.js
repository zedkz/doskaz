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
    },
    setComments(state, comments) {
      state.comments = comments;
    }
  },
  actions: {},
  getters: {
    getId: state => {
      return state.commentId
    },
    getComments: state => {
      return state.comments
    }
  }
}