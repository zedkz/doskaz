<template>
  <div class="blog__inside">
    <div class="breadcrumbs">
      <router-link :to="{ name: 'blog' }" class="breadcrumbs__link"
        >Блог</router-link
      >
      <router-link
        :to="{
          name: 'blog',
          params: { categorySlug: $route.params.categorySlug }
        }"
        class="breadcrumbs__link"
        >{{ post.categoryTitle }}
      </router-link>
    </div>
    <div class="blog__in">
      <div class="blog__content">
        <div class="blog__inside-content">
          <h3>{{ post.title }}</h3>
          <img :src="post.image" :alt="post.title" />
          <div v-html="post.content"></div>
          <div class="blog__inside-bottom">
            <span class="blog__inside-date" v-if="post.id">{{
              post.publishedAt | date
            }}</span>
            <div class="social --md">
              <a class="social__link --fcb" @click="share('fb')">
                <img src="@/assets/img/social/fcb.svg" />
              </a>
              <a class="social__link --vk" @click="share('vk')">
                <img src="@/assets/img/social/vk.svg" />
              </a>
              <a class="social__link --ok" @click="share('ok')">
                <img src="@/assets/img/social/ok.svg" />
              </a>
              <a class="social__link --my" @click="share('mailru')">
                <img src="@/assets/img/social/my.svg" />
              </a>
            </div>
          </div>

          <!-- <vue-disqus shortname="pavlodarzedkz" :title="post.title" :key="post.id"/> -->
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
          />
          <form class="comment-form">
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
                  @click="sendComment('clear')"
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
      </div>
      <div class="blog__side">
        <div class="blog__category">
          <span class="blog__category-title">Похожие материалы</span>
          <ul class="blog__material">
            <li
              class="blog__material-item"
              v-for="post in similarPosts"
              :key="post.id"
            >
              <router-link
                :to="{
                  name: 'blogView',
                  params: {
                    categorySlug: post.categorySlug,
                    postSlug: post.slug
                  }
                }"
                class="blog__material-link"
              >
                <img :src="post.image" :alt="post.title" />
                <span>{{ post.title }}</span>
              </router-link>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import VueDisqus from "vue-disqus";
import Comments from "@/components/Comments";
import api from "@/api";
import get from "lodash/get";
import { format } from "date-fns";
import { ru } from "date-fns/locale";

Vue.use(VueDisqus);

export default {
  components: { Comments },
  metaInfo() {
    return {
      title: get(this.post, "meta.title"),
      meta: [
        { name: "keywords", content: get(this.post, "meta.keywords") },
        { name: "description", content: get(this.post, "meta.description") },
        { property: "og:title", content: get(this.post, "meta.ogTitle") },
        {
          property: "og:description",
          content: get(this.post, "meta.ogDescription")
        },
        { property: "og:image", content: get(this.post, "meta.ogImage") }
      ].filter(({ content }) => !!content)
    };
  },
  data() {
    return {
      comments_sort: "сначала новые",
      post: {},
      similarPosts: [],
      commentText: "",
      comments: [],
      notSortedComments: [],
      commentId: Number
    };
  },
  filters: {
    date(value) {
      return format(new Date(value), "d MMMM y", { locale: ru });
    }
  },
  watch: {
    $route: {
      handler() {
        this.loadPost();
      },
      immediate: true
    }
  },
  methods: {
    sortedComment() {
      if (this.comments_sort == "сначала старые") {
        this.comments.items.reverse();
      } else if (this.comments_sort == "сначала новые") {
        this.comments.items = this.comments.items.reverse();
      }
    },
    formFocus(id) {
      this.$refs.comment.focus();
      this.commentId = id;
    },
    sendComment() {
      api
        .post(`blogPosts/${this.post.id}/comments`, {
          text: this.commentText,
          parentId: this.$store.getters.getId
        })
        .then(res => {
          console.log(res);
          api.get(`blogPosts/${this.post.id}/comments`).then(res => {
            this.comments = res.data;
          });
          this.comment = "";
          this.$store.commit("setId", null);
        });
      this.$store.commit("setId", null);
    },
    clearComment() {
      this.commentText = "";
    },
    resizeHeight(e) {
      e.target.style.height = "70px";
      e.target.style.height = e.target.scrollHeight + "px";
    },
    async loadPost() {
      await api
        .get(`blogPosts/bySlug/${this.$route.params.postSlug}`)
        .then(res => {
          this.post = res.data.post;
          this.similarPosts = res.data.similar;
          api.get(`blogPosts/${res.data.post.id}/comments`).then(res => {
            this.comments = res.data;
            this.$store.commit('setComments', res.data.items)
          });
        });
    },
    share(network) {
      window.open(this.shareLinks[network]);
    }
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
    shareLinks() {
      const path = encodeURIComponent(
        window.location.origin + this.$route.fullPath
      );

      return {
        ok: `https://connect.ok.ru/dk?st.cmd=WidgetSharePreview&st.shareUrl=${path}`,
        fb: `https://www.facebook.com/sharer.php?u=${path}`,
        vk: `https://vk.com/share.php?url=${path}`,
        mailru: `https://connect.mail.ru/share?url=${path}`
      };
    }
  }
};
</script>

<style lang="scss">
/* Custom dropdown */
.custom-dropdown {
  position: relative;
  display: inline-block;
  vertical-align: middle;
  margin: 10px; /* demo only */
}

.custom-dropdown select {
  cursor: pointer;
  background-color: #fff;
  color: #5b6067;
  font-size: 14px;
  padding: 0.5em;
  padding-right: 2.5em;
  border: 0;
  margin: 0;
  border-radius: 3px;
  text-indent: 0.01px;
  text-overflow: "";
}

.custom-dropdown::before,
.custom-dropdown::after {
  content: "";
  position: absolute;
  pointer-events: none;
}

.custom-dropdown::after {
  /*  Custom dropdown arrow */
  content: "\25BC";
  height: 1em;
  font-size: 0.625em;
  line-height: 1;
  right: 1.2em;
  top: 50%;
  margin-top: -0.5em;
}

.custom-dropdown::before {
  /*  Custom dropdown arrow cover */
  width: 2em;
  right: 0;
  top: 0;
  bottom: 0;
  border-radius: 0 3px 3px 0;
}

.custom-dropdown select[disabled] {
  color: rgba(0, 0, 0, 0.3);
}

.custom-dropdown select[disabled]::after {
  color: rgba(0, 0, 0, 0.1);
}

.custom-dropdown::after {
  color: rgba(0, 0, 0, 0.4);
}

select::-ms-expand {
  display: none;
}
.comment-form {
  display: flex;
  margin-top: 35px;

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

.slider {
  position: relative;
  padding: 0 20px;
  margin: 30px 0 70px;

  img {
    margin: 0 auto;
  }

  .slick-prev {
    position: absolute;
    left: 0;
    top: 50%;
    width: 20px;
    height: 50px;
    margin: -25px 0 0;
    cursor: pointer;
  }

  .slick-next {
    position: absolute;
    right: 0;
    top: 50%;
    width: 20px;
    height: 50px;
    margin: -25px 0 0;
    cursor: pointer;
  }
}

.blog {
  &__inside {
    padding: 35px 0 40px;

    &-content {
      > h3 {
        font-size: 32px;
        line-height: 40px;
        margin: 0 0 20px;
      }

      > h4 {
        font-size: 22px;
        line-height: 30px;
        margin: 0 0 18px 0;
      }

      > p {
        font-size: 16px;
        line-height: 30px;
        margin: 20px 0;
      }

      > img {
        max-width: 100%;
        margin: 32px 0 28px;
        display: block;
      }

      > ul {
        padding: 0 0 0 40px;
        margin: -10px 0 20px;
        list-style: none;

        li {
          position: relative;
          font-size: 16px;
          line-height: 30px;
          margin: 10px 0 0;

          &:first-child {
            margin: 0;
          }

          &:before {
            position: absolute;
            left: -18px;
            top: 12px;
            content: "";
            width: 6px;
            height: 6px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
            background: #0f6bf5;
          }
        }
      }

      > a {
        display: flex;
        align-items: center;
        padding: 20px 40px;
        background: #d5e9fc;
        font-size: 0;
        transition: opacity 0.3s;

        &:hover {
          opacity: 0.7;
        }

        svg {
          display: inline-block;
          vertical-align: middle;
        }

        div {
          text-align: center;
          width: 30px;
          height: 30px;
          line-height: 30px;
          background: #0f6bf5;
          margin: 0 10px 0 0;
        }

        span {
          font-size: 16px;
          line-height: 30px;
          color: #333333;
        }
      }
    }

    &-pic {
      display: flex;
      flex-wrap: wrap;
      align-items: flex-start;
      justify-content: flex-start;
      margin: -5px -15px;

      img {
        margin: 15px;
      }
    }

    &-bottom {
      margin: 30px 0 28px;
      padding: 0 0 40px;
      border-bottom: 1px solid #7b95a7;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    &-date {
      color: #5b6067;
      font-size: 14px;
      line-height: 20px;
    }

    .blog__in {
      padding: 32px 0 0;
    }
  }

  &__material {
    list-style: none;
    padding: 0;

    &-item {
      margin: 30px 0 0;
    }

    &-link {
      display: block;
      transition: opacity 0.3s;

      &:hover {
        opacity: 0.7;
      }

      img {
        display: block;
        max-width: 100%;
        margin: 0 0 15px;
      }

      span {
        display: block;
        font-size: 14px;
        line-height: 20px;
        color: #333333;
      }
    }
  }
}

.breadcrumbs {
  font-size: 0;

  &__link {
    display: inline-block;
    vertical-align: middle;
    font-size: 14px;
    line-height: 20px;
    color: #5b6067;
    transition: opacity 0.3s;

    &:hover {
      opacity: 0.7;
    }

    &:before {
      content: "/";
      display: inline-block;
      vertical-align: middle;
      margin: 0 5px;
    }

    &:first-child {
      &:before {
        display: none;
      }
    }
  }
}
</style>
