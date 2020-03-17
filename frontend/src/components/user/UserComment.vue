<template>
    <div class="user-comments__item">
        <div class="user-comments__image" v-bind:style="{'background-image': 'url(' + commentObjectImg + ')'}"></div>
        <div class="user-comments__description">
            <p class="user-comments__text">{{commentText}}</p>
            <div class="user-comments__info">{{relativeDate}}&nbsp;{{objectType}}&nbsp;<strong>{{commentObject}}</strong></div>
        </div>
    </div>
</template>

<script>
    import ru from 'date-fns/locale/ru'
    import {formatRelative} from 'date-fns'
    import capitalize from 'lodash/capitalize'

    export default {
        props: [
            "commentObjectImg",
            "commentText",
            "commentDate",
            "commentObject",
            'type'
        ],
        computed: {
            objectType() {
                return this.type === 'post' ? 'к посту' : 'к объекту'
            },
            relativeDate() {
                return capitalize(formatRelative( new Date(this.commentDate), new Date(), {
                    locale: ru
                }))
            }
        }
    };
</script>