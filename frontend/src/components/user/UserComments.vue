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
                    :commentObjectImg="require('./../../assets/img/objects/1.png')"
                    commentText="Я вчера там был, таблички уже повесили :)"
                    commentDate="Сегодня в 14:23"
                    commentObject="Суши-бар Saya Sushi"
            />
            <UserComment
                    :commentObjectImg="require('./../../assets/img/objects/1.png')"
                    commentText="Хотелось бы добавить, что входная группа сделана не очень удобно для людей, передвигающихся на колясках. Угол наклона пандуса очень большой, подниматься без посторонней помощи сложно. А зимой там ещё хуже будет."
                    commentDate="Вчера в 18:01"
                    commentObject="Стоматологическая клиника Vitadent"
            />
            <UserComment
                    :commentObjectImg="require('./../../assets/img/objects/1.png')"
                    commentText="Я вчера там был, таблички уже повесили :)"
                    commentDate="Сегодня в 14:23"
                    commentObject="Суши-бар Saya Sushi"
            />
            <UserComment
                    :commentObjectImg="require('./../../assets/img/objects/1.png')"
                    commentText="Хотелось бы добавить, что входная группа сделана не очень удобно для людей, передвигающихся на колясках. Угол наклона пандуса очень большой, подниматься без посторонней помощи сложно. А зимой там ещё хуже будет."
                    commentDate="Вчера в 18:01"
                    commentObject="Стоматологическая клиника Vitadent"
            />
        </div>
    </div>
</template>

<script>
    import UserComment from "./UserComment";

    export default {
        components: {
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