<template>
    <div class="user-comments__item">
        <div class="user-comments__image" v-bind:style="{'background-image': 'url(' + item.image + ')'}"></div>
        <div class="user-comments__description">
            <p class="user-comments__text">{{item.text}}</p>
            <div class="user-comments__info">{{relativeDate}}&nbsp;{{objectType}}&nbsp;<nuxt-link :to="link"><strong>{{item.title}}</strong></nuxt-link></div>
        </div>
    </div>
</template>

<script>
    import ru from 'date-fns/locale/ru'
    import {formatRelative} from 'date-fns'
    import capitalize from 'lodash/capitalize'

    export default {
        props: [
            'item'
        ],
        methods: {
          openLink() {
              this.$router.push(this.link)
          }
        },
        computed: {
            objectType() {
                return this.item.type === 'post' ? 'к посту' : 'к объекту'
            },
            relativeDate() {
                return capitalize(formatRelative( new Date(this.item.date), new Date(), {
                    locale: ru
                }))
            },
            link() {
                return this.item.type === 'post' ? {name: 'blog-cat-slug', params: {cat: this.item.categorySlug, slug: this.item.slug}} : {name: 'objects-id', params: {id: this.item.objectId}}
            }
        }
    };
</script>