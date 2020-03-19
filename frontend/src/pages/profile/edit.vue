<template>
    <div class="user-page__edit">
            <h3 class="user-page__title">Редактирование анкеты</h3>
            <p class="user-page__text --line">За заполнение анкеты вы получите 70 баллов.</p>
            <p class="user-page__text --line">Ваша личная информация не будет видна другим пользователям</p>
            <div class="user-page__line">
                <div class="col --label">
                    <label class="user-page__label">Фамилия</label>
                </div>
                <div class="col">
                    <div class="input" :class="{error: !!violations.lastName}">
                        <input type="text" v-model="profile.lastName">
                    </div>
                </div>
            </div>
            <div class="user-page__line">
                <div class="col --label">
                    <label class="user-page__label">Имя</label>
                </div>
                <div class="col">
                    <div class="input" :class="{error: !!violations.firstName}">
                        <input type="text" v-model="profile.firstName">
                    </div>
                </div>
            </div>
            <div class="user-page__line">
                <div class="col --label">
                    <label class="user-page__label">Отчество</label>
                </div>
                <div class="col">
                    <div class="input" :class="{error: !!violations.middleName}">
                        <input type="text" v-model="profile.middleName">
                    </div>
                </div>
            </div>
            <div class="user-page__line">
                <div class="col --label">
                    <label class="user-page__label">Эл. Почта</label>
                </div>
                <div class="col">
                    <div class="input error" :class="{error: !!violations.email}">
                        <input type="email" v-model="profile.email">
                        <span class="error-msg">Неправильный адрес почты</span>
                    </div>
                </div>
            </div>
            <div class="user-page__line">
                <div class="col --label">
                    <label class="user-page__label">Телефон</label>
                </div>
                <div class="col">
                    <div class="input" :class="{error: !!violations.phone}">
                        <masked-input mask="\+\7(111)111-11-11" v-model="profile.phone"/>
                    </div>
                </div>
            </div>
            <div class="user-page__line">
                <div class="col --label">
                    <label class="user-page__label">Смс код</label>
                </div>
                <div class="col --flex">
                    <div class="input --flex-col --sm" :class="{error: !!violations.phone}">
                        <input type="text">
                    </div>
                    <div class="--flex-col">
                        <div class="user-page__sms">
                            <img class="user-page__sms-img" :src="require('@/assets/icons/sms-phone.svg')"/>
                            <span class="user-page__sms-text">Отправить код</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="user-page__line disabled">
                <div class="col --label">
                    <label class="user-page__label">Отображаемый статус</label>
                </div>
                <div class="col">
                    <div class="input disabled" :class="{error: !!violations.status}">
                        <input type="text" readonly placeholder="Будет доступен с 5 уровня">
                    </div>
                </div>
            </div>
            <div class="user-page__line">
                <div class="col --label"></div>
                <div class="col">
                    <button type="button" class="user-page__button" @click.prevent="submit">Сохранить</button>
                </div>
            </div>
        </div>
</template>

<script>
    import {call} from 'vuex-pathify'
    import mapValidationErrors from "@/mapValidationErrors";

    export default {
        async asyncData({$axios}) {
            const {data: profile} = await $axios.get('/api/profile')
            return {
                profile
            }
        },
        head() {
            return {
                title: 'Редактирование анкеты'
            }
        },
        data() {
            return {
                errors: []
            }
        },
        methods: {
            async submit() {
                const loader = this.$loading.show();

                try {
                    const {data, status} = await this.$axios.put('/api/profile', this.profile, {
                        validateStatus: status => status <= 400
                    })
                    if (status === 400) {
                        this.errors = data.errors.violations
                        return;
                    }
                    await this.loadUser()
                } catch (e) {
                    throw e
                } finally {
                    loader.hide()
                }

            },
            ...call('authentication', ['loadUser'])
        },
        computed: {
            violations() {
                return mapValidationErrors(this.errors)
            }
        }
    }
</script>

<style lang="scss">
    @import "@/styles/mixins.scss";

    .--flex {
        display: flex;
        &-col {
             -ms-flex-preferred-size: 0;
             flex-basis: 0;
             -ms-flex-positive: 1;
             -webkit-box-flex: 1;
             flex-grow: 1;
             max-width: 100%;
            &.--sm {
                 min-width: 110px;
                 max-width: 110px;
            }
        }
    }

    .user-page {
        &__sms {
            padding: 0 0 0 40px;
            display: flex;
            align-items: center;
            height: 100%;
            cursor: pointer;
            transition: opacity 0.4s;
            &:hover {
                opacity: 0.7;
            }
            &-img {
                margin: 0 10px 0 0;
            }
            &-text {
                font-size: 14px;
                line-height: 14px;
            }
        }
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

            .error-msg {
                display: none;
                position: absolute;
                left: 0;
                top: 100%;
                margin: 5px 0 0;
                font-size: 14px;
                line-height: 20px;
                color: $red;
            }

            .input {
                input {
                    font-size: 14px;
                }
                &.error {
                    border-color: $red;
                    position: relative;
                    .error-msg {
                        display: block;
                    }
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