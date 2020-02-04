<template>
    <div class="user-page">
        <MainHeader />
        <UserPageHeader />
        <div class="container">
            <div class="user-page__row">
                <div class="user-page__profile">
                    <UserProfile />
                    <UserLevel />
                    <UserTask />
                </div>
                <div class="user-page__tabs">
                    <div class="user-page__edit">
                        <h3 class="user-page__title">Редактирование анкеты</h3>
                        <p class="user-page__text --line">За заполнение анкеты вы получите 70 баллов.</p>
                        <p class="user-page__text --line">Ваша личная информация не будет видна другим пользователям</p>
                        <div class="user-page__line">
                            <div class="col --label">
                                <label class="user-page__label">Фамилия</label>
                            </div>
                            <div class="col">
                                <div class="input">
                                    <input type="text">
                                </div>
                            </div>
                        </div>
                        <div class="user-page__line">
                            <div class="col --label">
                                <label class="user-page__label">Имя</label>
                            </div>
                            <div class="col">
                                <div class="input">
                                    <input type="text">
                                </div>
                            </div>
                        </div>
                        <div class="user-page__line">
                            <div class="col --label">
                                <label class="user-page__label">Отчество</label>
                            </div>
                            <div class="col">
                                <div class="input">
                                    <input type="text">
                                </div>
                            </div>
                        </div>
                        <div class="user-page__line">
                            <div class="col --label">
                                <label class="user-page__label">Эл. Почта</label>
                            </div>
                            <div class="col">
                                <div class="input" v-bind:class="emailValid()">
                                    <input type="email" v-model="email">
                                </div>
                            </div>
                        </div>
                        <div class="user-page__line">
                            <div class="col --label">
                                <label class="user-page__label">Телефон</label>
                            </div>
                            <div class="col">
                                <div class="input">
                                    <masked-input  mask="\+\7(111)111-11-11"/>
                                </div>
                            </div>
                        </div>
                        <div class="user-page__line disabled">
                            <div class="col --label">
                                <label class="user-page__label">Отображаемый статус</label>
                            </div>
                            <div class="col">
                                <div class="input disabled">
                                    <input type="text" readonly placeholder="Будет доступен с 5 уровня">
                                </div>
                            </div>
                        </div>
                        <div class="user-page__line">
                            <div class="col --label"></div>
                            <div class="col">
                                <button type="button" class="user-page__button">Сохранить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import MainHeader from "./../components/MainHeader";
    import UserPageHeader from "./../components/user/UserPageHeader.vue"
    import UserProfile from "./../components/user/UserProfile";
    import UserLevel from "./../components/user/UserLevel";
    import UserTask from "./../components/user/UserTask";
    import maskedInput from 'vue-masked-input'

    export default {
        data() {
          return {
              email: '',
              reg: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/
          }
        },
        methods: {
            emailValid: function() {
                return (this.email == "")? "" : (this.reg.test(this.email)) ? '' : 'error';
            }
        },
        components: {
            MainHeader,
            UserPageHeader,
            UserProfile,
            UserLevel,
            UserTask,
            maskedInput
        }
    };
</script>

<style lang="scss">
    @import "./../styles/mixins.scss";

    .user-page {
        &__edit {
            padding: 26px 0 0;
            width: 560px;
        }
        &__title {
            margin: 0 0 30px;
        }
        &__text {
            font-size: 14px;
            line-height: 20px;
            &.--line {
                margin: 0;
            }
        }
        &__label {
            font-size: 16px;
            line-height: 17px;
            font-weight: 700;
            display: block;
            padding: 0 20px 0 0;
        }
        &__button {
            width: 170px;
            line-height: 50px;
            color: #fff;
            font-size: 14px;
            border: none;
            outline: none;
            background: $blue;
            cursor: pointer;
            -webkit-transition: opacity 0.4s;
            -moz-transition: opacity 0.4s;
            -ms-transition: opacity 0.4s;
            -o-transition: opacity 0.4s;
            transition: opacity 0.4s;
            &:hover {
                opacity: 0.7;
            }
        }
        &__line {
             display: flex;
             position: relative;
             margin: 40px 0 0;
             .input {
                &.error {
                    border-color: $red;
                }
                input {
                    font-size: 14px;
                }
             }
             &.disabled {
                opacity: 0.5;
             }
             .col {
                 position: relative;
                 -ms-flex-preferred-size: 0;
                 flex-basis: 0;
                 -ms-flex-positive: 1;
                 -webkit-box-flex: 1;
                 flex-grow: 1;
                 max-width: 100%;
                 &.--label {
                    min-width: 150px;
                    max-width: 150px;
                    display: flex;
                    align-items: center;
                 }
             }
        }
    }
</style>