<template>
    <div class="user-comments">
        <div class="user-objects__filter">
            <div class="filter">
                <div class="filter__text">Сортировать по</div>
                <div class="filter__dropdown">
                    <div class="dropdown">
                        <div class="dropdown__selected">
                            <span>дате добавления</span>
                        </div>
                        <div class="dropdown__list">
                            <div class="dropdown__item">
                                <span>дате добавления</span>
                            </div>
                            <div class="dropdown__item">
                                <span>дате добавления</span>
                            </div>
                            <div class="dropdown__item">
                                <span>дате добавления</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="user-comments__list">
            <UserComment
                    v-for="item in items"
                    :key="item.id"
                    :commentObjectImg="item.image"
                    :commentText="item.text"
                    :type="item.type"
                    :commentDate="item.date"
                    :commentObject="item.title"
            />
        </div>
        <div class="user-comments__pagination">
            <pagination :pages="pages"/>
        </div>
    </div>
</template>

<script>
    import UserComment from "./UserComment";
    import Pagination from "../Pagination";

    export default {
        props: [
            'pages',
            'items'
        ],
        components: {
            Pagination,
            UserComment
        }
    };
</script>

<style lang="scss">
    @import "./../../styles/mixins.scss";
    .user-comments {
        padding: 35px 0 0;
        &__list {
            margin: 55px 0 0;
        }
        &__item {
            display: flex;
            margin: 35px 0 0;
            &:first-child {
                margin: 0;
            }
        }
        &__image {
            width: 70px;
            height: 50px;
            background-size: cover;
        }
        &__description {
            margin: 0 0 0 40px;
            padding: 4px 0 0;
            max-width: calc(100% - 110px);
        }
        &__text {
             font-size: 16px;
             line-height: 20px;
        }
        &__info {
            margin: 11px 0 0;
            color: $text;
            font-size: 14px;
            line-height: 20px;
            strong {
                color: $text;
            }
        }
    }
</style>