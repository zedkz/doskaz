<template>
    <div class="blog__inside-comments">
        <h4>{{ declension }}</h4>
        <span class="custom-dropdown">
            <select v-model="comments_sort" @change="sortedComment()">
              <option>сначала новые</option>
              <option>сначала старые</option>
              <option>популярные</option>
            </select>
          </span>

        <Comments
                @formFocus="formFocus"
                v-for="comment in comments.items"
                :key="comment.id"
                :comment="comment"
                :comments="comments.items"
        />
        <form class="comment-form" v-if="$store.state.authentication.user">

              <textarea
                      ref="comment"
                      placeholder="Напишите комментарий"
                      name="comment"
                      rows="2"
                      v-model="commentText"
                      @input="resizeHeight"
              />
            <div class="form-actions">
                <div>
                    <button
                            type="button"
                            class="send-button"
                            @click="sendComment()"
                    >
                        <img src="@/assets/icons/send.svg" alt="" />
                    </button>
                    <button
                            type="button"
                            @click="clearComment()"
                            class="clear-button"
                            v-if="commentText.length > 0"
                    >
                        <img src="@/assets/icons/close.svg" alt="" />
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import Comments from "../Comments";
    export default {
        name: "CommentsBlock",
        props: ['id'],
        components: {Comments},
        data() {
            return {
                comments_sort: "сначала новые",
                commentText: "",
                comments: {
                    count: 0,
                    items: []
                },
                commentId: Number
            };
        },
        mounted() {
            this.$axios.get(`/api/blog/posts/${this.id}/comments`).then(res => {
                this.comments = res.data;
            }).catch(e => console.log(e.response));
        },
        methods: {
            sortedComment() {
                if (this.comments_sort == "сначала старые") {
                    this.$axios
                        .get(`/api/blog/posts/${this.id}/comments`, {
                            params: {sortOrder: "asc"}
                        })
                        .then(res => {
                            this.comments = res.data;
                        });
                } else if (this.comments_sort == "сначала новые") {
                    this.$axios
                        .get(`/api/blog/posts/${this.id}/comments`, {
                            params: {sortOrder: "desc"}
                        })
                        .then(res => {
                            this.comments = res.data;
                        });
                } else if (this.comments_sort == "популярные") {
                    this.$axios
                        .get(`/api/blog/posts/${this.id}/comments`, {
                            params: {sortBy: "popularity"}
                        })
                        .then(res => {
                            this.comments = res.data;
                        });
                }
            },
            formFocus(id) {
                this.$nextTick(() => {
                    this.$refs.comment.focus();
                });
                this.commentId = id;
            },
            sendComment() {
                this.$axios
                    .post(`/api/blog/posts/${this.id}/comments`, {
                        text: this.commentText,
                        parentId: this.commentId
                    })
                    .then(res => {
                        console.log(res);
                        this.$axios.get(`/api/blog/posts/${this.id}/comments`).then(res => {
                            this.comments = res.data;
                        });
                        this.commentId = null;
                        this.commentText = "";
                     //   this.$store.commit("setId", null);
                    });
               // this.$store.commit("setId", null);
            },
            clearComment() {
                this.commentText = "";
            },
            resizeHeight(e) {
                e.target.style.height = "70px";
                e.target.style.height = e.target.scrollHeight + "px";
            },
        },
        computed: {
            declension() {
                let number = this.comments.count;
                let txt = ["Комментарий", "Комментария", "Комментариев"];
                let cases = [2, 0, 1, 1, 1, 2];
                return (
                    number +
                    " " +
                    txt[
                        number % 100 > 4 && number % 100 < 20
                            ? 2
                            : cases[number % 10 < 5 ? number % 10 : 5]
                        ]
                );
            },
        }
    }
</script>

<style scoped>

</style>