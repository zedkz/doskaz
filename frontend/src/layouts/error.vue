<template>
    <div class="error-page" v-bind:style="{'background-image': 'url(' + require('./../assets/img/page-error-bg.png') + ')'}">
        <div class="main-header --light">
            <div class="main-header__content">
                <nuxt-link :to="{name: 'index'}" class="main-header__logo">
                    <img :src="require('@/assets/logo.svg')" alt />
                </nuxt-link>
                <div class="main-header__language">
                    <LangSelect />
                </div>
            </div>
        </div>
        <div class="container">
            <div class="error-page__content" v-if="error.statusCode == '404'">
                <h2 class="error-page__title">Ошибка 404</h2>
                <p class="error-page__text">К сожалению, страницы, на которую вы хотели попасть, нет на нашем сайте. Возможно, вы ввели неправильный адрес или она была удалена.</p>
                <p class="error-page__text">Попробуйте вернуться на главную страницу или воспользуйтесь поиском.</p>
                <div class="error-page__search">
                    <div class="input --search">
                        <input type="search" placeholder="Найти">
                    </div>
                </div>
            </div>
            <div class="error-page__content" v-if="error.statusCode == '500'">
                <h2 class="error-page__title">Ошибка 500</h2>
                <p class="error-page__text">Что-то пошло не так!</p>
                <p class="error-page__text">Какие-то технические неполадки. Мы обязательно это починим! А пока вернитесь на предыдущую страницу</p>
                <div class="error-page__link-b">
                    <a href="" class="error-page__link">Вернуться назад</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LangSelect from "./../components/LangSelect";
    export default {
        props: ['error'],
        components: {
            LangSelect
        }
    }
</script>

<style  lang="scss">
    .error-page {
        background-size: 100%;
        background-position: center bottom;
        min-height: 100vh;
        background-repeat: no-repeat;
        &__content {
            padding: 45px 0 30px;
        }
        &__title {
            font-weight: 600;
            font-size: 48px;
            line-height: 50px;
            margin: 0 0 43px;
        }
        &__text {
            max-width: 580px;
            font-size: 16px;
            line-height: 30px;
            margin: 20px 0;
        }
        &__search {
            width: 560px;
        }
        &__link {
            font-size: 18px;
            line-height: 20px;
            display: inline-block;
            border-bottom: 1px solid;
            transition: opacity 0.4s;
            &:hover {
                opacity: 0.7;
            }
            &-b {
                margin: 44px 0 0;
            }
        }
    }
</style>