<template>
    <div class="timeline">
        <div class="timeline__tab-links">
            <div
                    class="timeline__tab-link timeline__tab-link_blog"
                    :class="{'isActive': activeTab===0}"
                    @click="setActiveTab(0)"
            >
        <span>
          Блог
          <span class="new">2</span>
        </span>
            </div>
            <div class="timeline__tab-link" :class="{'isActive': activeTab===1}" @click="setActiveTab(1)"
                 v-if="isAuthenticated">
                <span>Лента событий</span>
            </div>
            <div class="spacer"></div>
            <div
                    v-if="isAuthenticated"
                    class="timeline__tab-link timeline__tab-link_user"
                    :class="{'isActive': activeTab===2}"
                    @click="setActiveTab(2)"
            >
        <span
                class="avatar"
                v-bind:style="{'background-image': 'url(' + require('./../assets/img/avatar.png') + ')'}"
        ></span>
                <span class="name">{{user.name || 'Без имени'}}</span>
            </div>
            <div
                    v-else
                    class="timeline__tab-link timeline__tab-link_user"
                    @click="showLoginForm"
            >
                <span class="name">Вход</span>
            </div>
        </div>
        <div class="timeline__tabs">
            <div class="timeline__tab timeline__tab_blog" :class="{'isActive': activeTab===0}">
                <a href="#" class="item">
                    <div
                            class="item__img"
                            v-bind:style="{'background-image': 'url(' + require('./../assets/img/files/blog1.png') + ')'}"
                    ></div>
                    <div class="item__info">
                        <p class="item__date">
                            <span>Новости</span>
                            <span>20 июля</span>
                        </p>
                        <h3 class="item__title">Жалоба на отделение банка</h3>
                        <p
                                class="item__text"
                        >Каждый гражданин может повлиять на то, чтобы его окружала городская безбарьерная среда</p>
                    </div>
                </a>
                <a href="#" class="item">
                    <div
                            class="item__img"
                            v-bind:style="{'background-image': 'url(' + require('./../assets/img/files/blog2.png') + ')'}"
                    ></div>
                    <div class="item__info">
                        <p class="item__date">
                            <span>Новости</span>
                            <span>20 июля</span>
                        </p>
                        <h3 class="item__title">«Народный контроль» в Павлодаре: эпизоды 3 и 4</h3>
                        <p
                                class="item__text"
                        >Сотрудничество между проектом «Доступный Казахстан» и телеканалом Хабар</p>
                    </div>
                </a>
                <a href="#" class="item">
                    <div
                            class="item__img"
                            v-bind:style="{'background-image': 'url(' + require('./../assets/img/files/blog2.png') + ')'}"
                    ></div>
                    <div class="item__info">
                        <p class="item__date">
                            <span>Новости</span>
                            <span>20 июля</span>
                        </p>
                        <h3 class="item__title">«Народный контроль» в Павлодаре: эпизоды 3 и 4</h3>
                        <p
                                class="item__text"
                        >Сотрудничество между проектом «Доступный Казахстан» и телеканалом Хабар</p>
                    </div>
                </a>
                <div class="item item_link">
                    <router-link :to="{name: 'blog'}">
                        <span>Перейти в раздел</span>
                    </router-link>
                </div>
            </div>
            <div class="timeline__tab timeline__tab_events" :class="{'isActive': activeTab===1}">
                <div class="scroll">
                    <div class="item">
                        <div class="item__date">
                            <span>12 августа</span>
                        </div>
                        <div class="item__text">
              <span>
                <b>Арай Молдахметова</b> прокомментировала ваш объект
                <b>Суши-бар Saya Sushi</b>
              </span>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item__date">
                            <span>12 августа</span>
                        </div>
                        <div class="item__text">
              <span>
                <b>Арай Молдахметова</b> прокомментировала ваш объект
                <b>Суши-бар Saya Sushi</b>
              </span>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item__date">
                            <span>12 августа</span>
                        </div>
                        <div class="item__text">
              <span>
                <b>Арай Молдахметова</b> прокомментировала ваш объект
                <b>Суши-бар Saya Sushi</b>
              </span>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item__date">
                            <span>12 августа</span>
                        </div>
                        <div class="item__text">
              <span>
                <b>Арай Молдахметова</b> прокомментировала ваш объект
                <b>Суши-бар Saya Sushi</b>
              </span>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item__date">
                            <span>12 августа</span>
                        </div>
                        <div class="item__text">
              <span>
                <b>Арай Молдахметова</b> прокомментировала ваш объект
                <b>Суши-бар Saya Sushi</b>
              </span>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item__date">
                            <span>12 августа</span>
                        </div>
                        <div class="item__text">
              <span>
                <b>Арай Молдахметова</b> прокомментировала ваш объект
                <b>Суши-бар Saya Sushi</b>
              </span>
                        </div>
                    </div>
                </div>
                <div class="link">
                    <a href="#">
                        <span>Перейти в профиль</span>
                    </a>
                </div>
            </div>
            <div class="timeline__tab timeline__tab_user" :class="{'isActive': activeTab===2}">
                <UserTabs></UserTabs>
            </div>
        </div>
    </div>
</template>

<script>
    import UserTabs from "./../components/UserTabs";

    export default {
        data() {
            return {
                activeTab: 0
            };
        },
        components: {
            UserTabs
        },
        methods: {
            setActiveTab(tab) {
                this.activeTab = tab;
            },
            showLoginForm() {
                this.$store.dispatch('showLoginForm')
            }
        },
        computed: {
            isAuthenticated() {
                return !!this.user
            },
            user() {
                return this.$store.state.authentication.user
            }
        }
    };
</script>

<style lang="scss">
    @import "./../styles/mixins.scss";

    .timeline {
        background: $white;
        width: 100%;
        flex: 1 0 auto;
        max-height: 400px;
        padding: 30px 0px 34px 40px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;

        &__tab-links {
            width: calc(100% - 40px);
            margin-right: 40px;
            border-bottom: 1px solid #7b95a7;
            display: flex;
            flex-direction: row;
            align-items: flex-end;
            justify-content: flex-start;
        }

        &__tab-link {
            font-size: 16px;
            line-height: 20px;
            color: $black;
            display: block;
            position: relative;
            margin-left: 25px;
            padding-bottom: 10px;
            cursor: pointer;
            transition: opacity 0.3s;

            &:first-child {
                margin-left: 0;
            }

            &:after {
                content: "";
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                border-bottom: 3px solid #0f6bf5;
                opacity: 0;
                transition: opacity 0.3s;
            }

            &:hover {
                opacity: 0.7;
            }

            &.isActive {
                font-weight: 700;

                &:after {
                    opacity: 1;
                }
            }

            &.timeline__tab-link_blog {
                .new {
                    position: relative;
                    top: -8px;
                    font-size: 10px;
                    line-height: 20px;
                    color: $black;
                    font-weight: 400;
                }
            }

            &.timeline__tab-link_user {
                display: flex;
                flex-direction: row;
                justify-content: flex-end;
                align-items: center;

                .avatar {
                    width: 30px;
                    height: 30px;
                    border-radius: 50%;
                    display: block;
                    margin-right: 10px;
                    background-position: center;
                    background-size: cover;
                    background-repeat: no-repeat;
                }
            }
        }

        &__tabs {
            display: block;
            margin-top: 30px;
            flex: 1 0 auto;
            max-height: calc(100% - 41px);
            width: 100%;
        }

        &__tab {
            display: none;

            &.isActive {
                display: block;
            }

            &.timeline__tab_blog {
                position: relative;
                overflow-x: hidden;
                overflow-y: auto;
                height: 100%;
                padding-right: 30px;

                &::-webkit-scrollbar {
                    width: 10px;
                }

                &::-webkit-scrollbar-track {
                    background: $tr;
                }

                &::-webkit-scrollbar-thumb {
                    background: transparentize(#c4c4c4, 0.5);
                }

                .item {
                    display: flex;
                    flex-direction: row;
                    justify-content: flex-start;
                    align-items: flex-start;
                    margin-top: 30px;
                    transition: opacity 0.3s;

                    &:first-child {
                        margin-top: 0;
                    }

                    &:nth-last-child(1) {
                        margin-bottom: 30px;
                    }

                    &:hover {
                        opacity: 0.7;
                    }

                    &.item_link {
                        position: relative;
                        bottom: 0;
                        left: 0;
                        right: 0;
                        height: 30px;
                        background: $white;

                        &:hover {
                            opacity: 1;
                        }

                        a {
                            margin-left: 180px;
                            transition: opacity 0.3s;

                            &:hover {
                                opacity: 0.7;
                            }

                            span {
                                font-size: 16px;
                                line-height: 20px;
                                color: $black;
                                text-decoration: underline;
                            }
                        }
                    }

                    &__img {
                        width: 150px;
                        height: 110px;
                        background-position: center;
                        background-repeat: no-repeat;
                        background-size: cover;
                        margin-right: 30px;
                    }

                    &__info {
                        display: block;
                        flex: 1 0 auto;
                        max-width: calc(100% - 180px);
                        position: relative;
                        top: -8px;
                    }

                    &__title {
                        margin-bottom: 2px;
                    }

                    &__text {
                        margin-bottom: 0px;
                    }

                    &__date {
                        font-size: 14px;
                        color: #5b6067;
                        margin-bottom: 0px;

                        span {
                            margin-left: 14px;

                            &:first-child {
                                margin-left: 0;
                            }
                        }
                    }
                }
            }

            &.timeline__tab_events {
                position: relative;
                height: 100%;

                .scroll {
                    position: relative;
                    overflow-x: hidden;
                    overflow-y: auto;
                    height: calc(100% - 90px);
                    padding-right: 30px;

                    &::-webkit-scrollbar {
                        width: 10px;
                    }

                    &::-webkit-scrollbar-track {
                        background: $tr;
                    }

                    &::-webkit-scrollbar-thumb {
                        background: transparentize(#c4c4c4, 0.5);
                    }
                }

                .item {
                    display: flex;
                    flex-direction: row;
                    justify-content: flex-start;
                    align-items: flex-start;
                    margin-top: 30px;

                    &:first-child {
                        margin-top: 0;
                    }

                    &__date {
                        width: 110px;
                        font-size: 14px;
                        line-height: 20px;
                        color: #5b6067;
                    }

                    &__text {
                        flex: 1 0 auto;
                        max-width: calc(100% - 110px);
                        font-size: 16px;
                        line-height: 20px;
                        color: #333333;
                    }
                }

                .link {
                    position: absolute;
                    bottom: 42px;
                    margin-left: 110px;

                    a {
                        text-decoration: underline;
                        font-size: 16px;
                        line-height: 20px;
                        color: $black;
                        transition: opacity 0.3s;

                        &:hover {
                            opacity: 0.7;
                        }
                    }
                }
            }

            &.timeline__tab_user {
                position: relative;
                height: 100%;

                .user-tabs {
                    height: 100%;

                    &__links {
                        display: flex;
                        justify-content: flex-start;
                        align-items: flex-start;
                    }

                    &__link {
                        display: block;
                        margin-left: 20px;
                        background: $tr;
                        padding: 10px;
                        font-size: 16px;
                        line-height: 20px;
                        color: #333333;
                        position: relative;
                        cursor: pointer;

                        &.isActive {
                            background: #f1f8fc;
                            font-weight: 700;
                        }

                        &.isUpdated {
                            &:after {
                                content: "";
                                position: absolute;
                                top: 10px;
                                right: 0;
                                width: 7px;
                                height: 7px;
                                border-radius: 50%;
                                background: #3dba3b;
                            }
                        }

                        &:first-child {
                            margin-left: 0;
                        }
                    }

                    &__tabs {
                        padding-top: 30px;
                        height: 100%;
                    }

                    &__tab {
                        height: 100%;
                        width: 100%;
                        display: none;

                        &.isActive {
                            display: block;
                        }

                        .scroll {
                            position: relative;
                            overflow-x: hidden;
                            overflow-y: auto;
                            height: 100%;
                            padding-right: 30px;
                            padding-bottom: 30px;

                            &::-webkit-scrollbar {
                                width: 10px;
                            }

                            &::-webkit-scrollbar-track {
                                background: $tr;
                            }

                            &::-webkit-scrollbar-thumb {
                                background: transparentize(#c4c4c4, 0.5);
                            }
                        }

                        .item {
                            display: flex;
                            width: 100%;
                            justify-content: flex-start;
                            align-items: flex-start;
                            margin-bottom: 40px;

                            &__icon {
                                width: 20px;
                                height: 20px;
                                display: flex;
                                flex-direction: row;
                                justify-content: center;
                                align-items: center;

                                svg {
                                    max-width: 100%;
                                    max-height: 100%;
                                }
                            }

                            &__date {
                                margin-left: 30px;
                                font-size: 14px;
                                line-height: 20px;
                                color: #5b6067;
                                width: 100px;
                            }

                            &__text {
                                flex: 1 0 auto;
                                max-width: calc(100% - 150px);
                                font-size: 16px;
                                line-height: 20px;
                                color: #333333;
                            }
                        }
                    }
                }
            }
        }
    }
</style>