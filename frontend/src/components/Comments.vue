<template>
  <div class="comments-block">
    <h4>{{ declension }}</h4>
    <div class="comments-list">
      <div class="person-comment" v-for="comment in comments" :key="comment.id">
        <div>
          <img
            :src="comment.userAvatar"
            class="avatar"
            v-if="!!comment.userAvatar.length"
          />
          <div
            v-else
            :style="`background:${colorGenerator()}`"
            class="no-avatar"
          ></div>
        </div>
        <div class="person-info">
          <div>
            <span class="person-name">{{ comment.userName }}</span>
            <p class="text-comment">{{ comment.text }}</p>
            <span class="date-comment small">Вчера в 22:25</span>
            <span
              class="small"
              @click="requestComment(comment.id)"
              >Ответить</span
            >
          </div>
          <div
            class="replie-comment"
            v-for="replie in comment.replies"
            :key="replie.id"
          >
            <div>
              <img
                :src="replie.userAvatar"
                class="avatar"
                v-if="!!replie.userAvatar.length"
              />
              <div
                v-else
                :style="`background:${colorGenerator()}`"
                class="no-avatar"
              ></div>
            </div>
            <div class="person-info">
              <span class="person-name">{{ replie.userName }}</span
              ><small class="small">
                ответил {{ serchParenById(replie.parentId).userName }}</small
              >
              <p class="text-comment">{{ replie.text }}</p>
              <span class="date-comment small">Вчера в 22:25</span>
              <span class="small" @click="requestComment(replie.id)"
                >Ответить</span
              >
            </div>
          </div>
        </div>
      </div>

      <form>
        <textarea
          ref="comment"
          placeholder="Напишите комментарий"
          name="comment"
          id="1"
          rows="2"
          v-model="comment"
          @input="resizeHeight"
        />
        <div class="form-actions">
          <div>
            <button
              type="button"
              class="send-button"
              @click="sendComment('clear')"
            >
              <img src="@/assets/icons/send.svg" alt="" />
            </button>
            <button
              type="button"
              @click="clearComment()"
              class="clear-button"
              v-if="comment.length > 0"
            >
              <img src="@/assets/icons/close.svg" alt="" />
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import api from "@/api";

export default {
  props: ["id", "postSlug"],
  data: () => ({
    comment: "",
    postId: "",
    comments: [],
    commentId: undefined
  }),
  mounted() {
    api
      .get(`blogPosts/bySlug/${this.$route.params.postSlug}`)
      .then(response => {
        this.postId = response.data.post.id;
        api.get(`blogPosts/${this.postId}/comments`).then(res => {
          this.comments = res.data.items;
        });
      });
  },
  computed: {
    declension() {
      let number = this.comments.length;
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
    }
  },
  methods: {
    resizeHeight(e) {
      e.target.style.height = "70px";
      e.target.style.height = e.target.scrollHeight + "px";
    },
    sendComment() {
      api
        .post(`blogPosts/${this.postId}/comments`, {
          text: this.comment,
          parentId: this.commentId
        })
        .then(res => {
          console.log(res);
          this.comment = "";
          this.commentId = null
        });
      this.commentId = null;
    },
    requestComment(id) {
      this.commentId = id;
      this.$nextTick(() => {
        this.$refs.comment.focus();
      });
    },
    clearComment() {
      this.comment = "";
    },
    colorGenerator() {
      return "#" + ((Math.random() * 0xffffff) << 0).toString(16);
    },
    serchParenById(id) {
      return this.comments.find(comment => comment.id === id);
    }
  }
};
</script>

<style lang="scss" scoped>
.comments-block {
  h4 {
    font-size: 22px;
    line-height: 30px;
    margin: 27px 0 17px 0;
  }
  .replie-comment {
    margin-top: 29px;
  }
  .person-comment,
  .replie-comment {
    display: flex;
    margin-bottom: 35px;

    .person-info {
      padding-top: 6px;
      margin-left: 10px;

      .person-name {
        font-weight: bold;
        font-size: 16px;
      }

      .date-comment {
        margin-right: 40px;
      }

      .small {
        color: #5b6067;
        font-size: 14px;
      }
    }
    .no-avatar {
      height: 30px;
      width: 30px;
      border-radius: 50%;
    }
  }

  form {
    display: flex;

    textarea {
      padding: 14px 20px;
      width: 100%;
      border: 1px solid #7b95a7;
      box-sizing: border-box;
      resize: none;
      overflow: hidden;
      height: 100%;
    }

    .form-actions {
      display: flex;
      align-items: center;
      justify-content: center;

      button {
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        border: none;
        outline: none;
        background: none;
      }
    }
  }

  .comment-error {
    color: red;
  }
}
</style>
