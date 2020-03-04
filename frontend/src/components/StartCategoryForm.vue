<template>
    <div class="login-form" :class="{'isOpened': popupOpen}">
        <div class="login-form__bg"></div>
        <div class="login-form__content">
            <div class="login-form__cat">
                <h4 class="title --small">Добро пожаловать на портал Доступный Казахстан</h4>
                <p class="login-form__text">Пожалуйста, выберите свою категорию, <br>чтобы работать с сайтом вам было
                    максимально комфортно</p>
                <div class="start-cat__list">
                    <button class="start-cat__item" @click="selectCategory(category.key)" v-for="category in categories"
                            :key="category.key" :class="{active: category.key===selectedCategory}">
						<span class="start-cat__icon">
							<img :src="require(`~/assets/icons/categories/${category.key}.svg`)">
						</span>
                        <span class="start-cat__text">{{ category.title }}</span>
                    </button>
                </div>
                <button class="start-cat__link" @click="selectCategory('justView')">
                    Нет, спасибо. Я просто посмотреть
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import {call, get} from 'vuex-pathify'

    export default {
        data() {
            return {}
        },
        mounted() {
          //  this.init()
        },
        computed: {
            ...get('disabilitiesCategorySettings', {
                popupOpen: 'popupOpen',
                selectedCategory: 'category'
            }),
            categories() {
                return [
                    {key: 'movement', title: 'Люди, передвигающиеся на кресло-коляске'},
                    {key: 'vision', title: 'Люди с нарушениями зрения'},
                    {key: 'limb', title: 'Люди с нарушением опорно-двигательного аппарата'},
                    {key: 'hearing', title: 'Люди с нарушениями слуха'},
                    {key: 'temporal', title: 'Временно травмированные люди'},
                    {key: 'babyCarriage', title: 'Люди с детскими колясками'},
                    {key: 'missingLimbs', title: 'Люди с отсутствующими конечностями'},
                    {key: 'pregnant', title: 'Беременные женщины'},
                    {key: 'intellectual', title: 'Люди с интелектуальной инвалидностью'},
                    {key: 'agedPeople', title: 'Пожилые люди'},
                ]
            }
        },
        methods: {
            ...call('disabilitiesCategorySettings', [
                'selectCategory',
                'init'
            ])
        }
    }
</script>

<style lang="scss" scoped>
    @import "./../styles/mixins.scss";

    .login-form {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1100;
        display: none;

        &.isOpened {
            display: block;
        }

        &__bg {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            z-index: 0;
            background: rgba(0, 0, 0, 0.7);
        }

        &__content {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        &__cat {
            background: $white;
            position: relative;
            width: 820px;
            padding: 56px 60px;
            text-align: center;
        }

        &__text {
            font-size: 16px;
            line-height: 20px;
            margin: 30px 0 35px;
        }
    }

    .start-cat {
        &__link {
            border: none;
            background: transparent;
            cursor: pointer;
            font-size: 16px;
            line-height: 20px;
            color: #333333;
            text-decoration: underline;

            &:hover {
                opacity: 0.7;
            }
        }

        &__list {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin: 0 0 24px;
        }

        &__item {
            display: flex;
            height: 50px;
            align-items: center;
            width: calc(50% - 20px);
            margin: 0 0 30px;
            border: none;
            background: transparent;
            outline: none;
            padding: 0;
            cursor: pointer;

            &:hover {
                background: #F1F8FC;
                font-weight: 700;
            }

            &.active {
                background: #F1F8FC;
                font-weight: 700;
            }
        }

        &__icon {
            width: 50px;
            height: 50px;
            line-height: 50px;
            text-align: center;
            font-size: 0;
            background: #0F6BF5;
            display: inline-block;

            svg {
                display: inline-block;
                vertical-align: middle;
            }

            img {
                display: inline-block;
                vertical-align: middle;
            }

        }

        &__text {
            height: 50px;
            width: 280px;
            font-size: 16px;
            line-height: 20px;
            padding: 0 0 0 10px;
            text-align: left;
            color: #333333;
            display: flex;
            align-items: center;
        }
    }
</style>