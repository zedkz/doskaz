<template>
  <div class="comments-block">
    <div class="comments-list">
      <div class="person-comment">
        <div>
          <img
            :src="comment.userAvatar"
            class="avatar"
            v-if="!!comment.userAvatar"
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
            <span class="date-comment small">{{
              formatDate(comment.createdAt)
            }}</span>
            <span class="small" @click="requestComment(comment.id)"
              >Ответить</span
            >
            <slot> </slot>
          </div>
          <transition-group class="slide-group" name="slide" mode="out-in">
          <Comments
            v-show="showAllComments"
            v-for="(replie, i) in comment.replies"
            :comment="replie"
            :index="i"
            :key="replie.id"
            :parentItem="comment"
          >
          </Comments>
          </transition-group>
          <p class="check-comments"
            v-if="showAllComments == false && comment.replies.length > 1"
            @click="showAllComments = true"
          >
            Показать комментарии &#11206;
          </p>
          <p class="check-comments"
            v-if="showAllComments == true && comment.replies.length > 1"
            @click="showAllComments = false"
          >
            Скрыть комментарии &#11205;
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Comments from "@/components/Comments";
import { format } from "date-fns";
import { ru } from "date-fns/locale";

export default {
  name: "Comments",
  components: { Comments },
  props: ["comment"],
  data: () => ({
    commentText: "",
    postId: "",
    comments: [],
    commentId: undefined,
    showAllComments: true
  }),
  methods: {
    formatDate(date) {
      return format(new Date(date), "d MMMM y", { locale: ru });
    },
    requestComment(id) {
      this.$store.commit("setId", id);
      this.$emit("formFocus");
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
.slide-enter-active, .slide-leave-active {
  transition: opacity .2s ease-in-out, transform .2s ease-in-out;
}

.slide-enter, .slide-leave-to {
  opacity: 0;
  transform: translateX(-20px);
}
.check-comments {
  margin: 30px 0;
  font-size: 14px;
  color: #5B6067;
}
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
    margin-top: 35px;

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
    .avatar {
      height: 20px;
      width: 30px;
      border-radius: 50%;
    }
    .no-avatar {
      height: 30px;
      width: 30px;
      border-radius: 50%;
    }
  }
}
</style>
