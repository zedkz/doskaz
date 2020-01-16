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
          <Comments
            v-if="comments.length > 0"
            v-for="comment in comments"
            :key="comment.id"
            :comment="comment"
          />
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
      post: {},
      similarPosts: [],
      comments: []
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
    async loadPost() {
      await api
        .get(`blogPosts/bySlug/${this.$route.params.postSlug}`)
        .then(res => {
          this.post = res.data.post;
          this.similarPosts = res.data.similar;
          api.get(`blogPosts/${res.data.post.id}/comments`).then(res => {
            this.comments =  res.data.items;
          });
        });
    },
    share(network) {
      window.open(this.shareLinks[network]);
    }
  },
  computed: {
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
