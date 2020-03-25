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
                <div class="input" :class="{error: !!violations.email}">
                    <input type="email" v-model="profile.email">
                    <span class="error-msg">{{ violations.email }}</span>
                </div>
            </div>
        </div>
        <div class="user-page__line">
            <div class="col --label">
                <label class="user-page__label">Телефон</label>
            </div>
            <div class="col">
                <div class="input" :class="{error: !!violations.phone}">
                    <client-only>
                        <input type="text" v-imask="{mask: '{+7}(000)000-00-00', lazy: false, unmask: true}"
                               :value="profile.phone" @accept="profile.phone = $event.detail.unmaskedValue"/>
                    </client-only>
                    <span class="error-msg">{{ violations.phone }}</span>
                </div>
            </div>
        </div>
        <div class="user-page__line">
            <div class="col --label">
                <label class="user-page__label">Смс код</label>
            </div>
            <div class="col --flex">
                <div class="input --flex-col --sm " :class="{error: !!smsError}">
                    <input type="text" v-model="smsCode">
                    <span class="error-msg">{{ smsError }}</span>
                </div>
                <div class="--flex-col">
                    <div class="user-page__sms" @click="sendSmsCode">
                        <img class="user-page__sms-img" :src="require('@/assets/icons/sms-phone.svg')"/>
                        <span class="user-page__sms-text" v-if="!smsWait">Отправить код</span>
                        <span class="user-page__sms-text"
                              v-else>Повторную отправку можно выполнить через 15 секунд</span>
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
        <div id="recaptcha_verifier"></div>
    </div>
</template>

<script>
    import {call} from 'vuex-pathify'
    import mapValidationErrors from "@/mapValidationErrors";
    import * as firebase from 'firebase/app'
    import 'firebase/auth'

    export default {
        name: "ProfileEdit",
        props: [
            'profile'
        ],

        data() {
            return {
                errors: [],
                codeSent: false,
                smsWait: false,
                smsErrorCode: null,
                smsCode: ''
            }
        },
        mounted() {
            if (!firebase.apps.length) {
                firebase.initializeApp({
                    apiKey: process.env.NUXT_ENV_FIREBASE_API_KEY
                });
                firebase.auth().languageCode = 'ru';
                this.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha_verifier', {
                    'size': 'invisible'
                });
            }
        },
        methods: {
            async sendSmsCode() {
                if (this.smsWait || !this.profile.phone || this.profile.phone.length !== 12) {
                    return
                }
                this.smsWait = true;
                const timeout = setTimeout(() => {
                    this.smsWait = false
                }, 15 * 1000)
                this.smsErrorCode = null;
                this.confirmationResult = null;
                try {
                    this.confirmationResult = await firebase.auth().signInWithPhoneNumber(this.profile.phone, this.recaptchaVerifier);
                    this.codeSent = true
                } catch (e) {
                    this.smsErrorCode = e.code
                }
            },
            async confirmSmsCode() {
                if (!this.smsCode) {
                    return
                }
                try {
                    const result = await this.confirmationResult.confirm(this.smsCode);
                    this.profile.phoneChangeToken = await result.user.getIdToken();
                } catch (e) {
                    this.smsErrorCode = e.code
                }
            },
            async submit() {
                this.smsErrorCode = null;
                this.errors = [];
                const loader = this.$loading.show();
                if (this.codeSent && this.smsCode) {
                    await this.confirmSmsCode()
                }
                if (this.smsErrorCode) {
                    loader.hide()
                    return;
                }

                try {
                    const {data, status} = await this.$axios.put('/api/profile', this.profile, {
                        validateStatus: status => status <= 400
                    })
                    if (status === 400) {
                        this.errors = data.errors.violations
                        return;
                    }
                    this.smsErrorCode = null;
                    this.codeSent = false
                    this.smsCode = null
                    await this.loadUser()
                } catch (e) {
                    throw e
                } finally {
                    loader.hide()
                }

            },
            ...call('authentication', ['loadUser'])
        },
        watch: {
            smsErrorCode(v) {
                console.log(v)
            },
            smsError(v) {
                console.log(v)
            }
        },
        computed: {
            violations() {
                return mapValidationErrors(this.errors)
            },
            smsError() {
                const messages = {
                    'auth/invalid-verification-code': 'Неверный код',
                    'auth/too-many-requests': 'Превышено допустимое количество попыток'
                }

                if (!this.smsErrorCode) {
                    return;
                }

                return messages[this.smsErrorCode] || 'Ошибка, пожалуйста повторите операцию'
            }
        }
    }
</script>

<style scoped>

</style>