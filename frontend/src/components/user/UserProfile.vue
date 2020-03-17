<template>
    <div class="user-profile">
        <div class="user-profile__content" v-bind:class="{ '--verified': isVerified }">

            <div class="user-profile__favorites" v-if="isAchievement">
                <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="30" cy="30" r="30" fill="white"/>
                    <path d="M30 15L33.3677 25.3647H44.2658L35.4491 31.7705L38.8168 42.1353L30 35.7295L21.1832 42.1353L24.5509 31.7705L15.7342 25.3647H26.6323L30 15Z"
                          fill="#7B95A7"/>
                </svg>
            </div>

            <div class="user-profile__icon"
                 v-bind:style="{'background-image': 'url(' + avatar + ')'}">
                <div class="user-profile__icon-edit">
                    <span class="user-profile__icon-link" v-on:click="popupAvatarDefault">Обновить фотографию</span>
                    <span class="user-profile__icon-link" v-on:click="avatarDelete">Удалить</span>
                </div>
            </div>

            <!--  <div class="user-profile__icon" v-if="avatarLoadedCheck == 1"
                   v-bind:style="{'background-image': 'url(' + require('./../../assets/img/user/av' + defaultAvatarType + '.svg') + ')'}">
                  <div class="user-profile__icon-edit">
                      <span class="user-profile__icon-link" v-on:click="popupAvatarDefault">Обновить фотографию</span>
                      <span class="user-profile__icon-link" v-on:click="avatarDelete">Удалить</span>
                  </div>
              </div>
              <div class="user-profile__icon" v-if="avatarLoadedCheck == 2"
                   v-bind:style="{'background-image': 'url(' + require('./../../assets/img/user/default.svg') + ')'}">
                  <div class="user-profile__icon-edit">
                      <span class="user-profile__icon-link" v-on:click="popupAvatarDefault">Обновить фотографию</span>
                  </div>
              </div>
              <div class="user-profile__icon &#45;&#45;hl" v-if="avatarLoadedCheck == 3"
                   v-bind:style="{'background-image': 'url(' + require('./../../assets/user.png') + ')'}">
                  &lt;!&ndash; загруженная аватарка &ndash;&gt;
                  <div class="user-profile__icon-edit">
                      <span class="user-profile__icon-link">Обновить фотографию</span>
                      <span class="user-profile__icon-link" v-on:click="avatarDelete">Удалить</span>
                  </div>
              </div>
              <div class="user-profile__icon" v-if="avatarLoadedCheck == 4"
                   v-bind:style="{'background-image': 'url(' + require('./../../assets/img/user/default.svg') + ')'}">
                  <div class="user-profile__icon-edit">
                      <span class="user-profile__icon-link">Обновить фотографию</span>
                  </div>
              </div>-->

            <div class="user-profile__name">
                <username :value="name" placeholder="Ваше имя"/>
            </div>
            <div class="user-profile__title">
                <span>Всем привет! Я с вами :)</span>
            </div>
            <div class="user-profile__email">
                <span>{{ profile.email || 'Ваша эл. почта' }}</span>
            </div>
            <div class="user-profile__phone">
                <span>{{ profile.phone || 'Ваш телефон' }}</span>
            </div>
            <div class="user-profile__edit" v-if="$route.name !== 'profile-edit'">
                <nuxt-link :to="{name: 'profile-edit'}">
                    <span>Редактировать анкету</span>
                </nuxt-link>
            </div>

            <div class="popup__wrapper" v-show="popupAvatar">
                <div class="popup__in">
                    <span class="popup__close" v-on:click="popupAvatar = false"></span>
                    <p class="popup__text">Выберите себе аватар. Учтите, что сменить его вы сможете только на 7 уровне
                        :)</p>
                    <div class="user-profile__avatar-list">
                         <span v-for="(preset, index) in avatarPresets" v-bind:style="{'background-image': 'url(' + preset + ')'}"
                               v-on:click="chooseAvatarPreset(index+1)" class="user-profile__avatar"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {sync, get, call} from 'vuex-pathify'
    import Username from "../Username";
    import range from 'lodash/range'

    export default {
        components: {Username},
        data() {
            return {
                isAchievement: false,
                isVerified: true,
                userLevel: 6,
                isAvatarLoaded: false,
                defaultAvatarType: 0,
                popupAvatar: false
            }
        },
        computed: {
            avatar() {
                return this.profile.avatar || require('~/assets/img/user/default.svg')
            },
            currentPage() {
                return this.$route.path;
            },
            avatarLoadedCheck() {
                var avatarType = 0;

                if (this.userLevel < 7) {
                    this.isAvatarLoaded ? (avatarType = 1) : (avatarType = 2);
                } else {
                    this.isAvatarLoaded ? (avatarType = 3) : (avatarType = 4);
                }

                return avatarType;
            },
            name: get('authentication/name'),
            profile: sync('authentication/user'),
            avatarPresets() {
                return range(1, 7).map(presetNumber => require(`~/assets/img/user/av${presetNumber}.svg`))
            }
        },
        methods: {
            popupAvatarDefault: function () {
                this.popupAvatar = true;
            },
            async avatarDelete() {
                await this.$axios.delete('/api/profile/avatar')
                await this.loadUser();
            },
            async chooseAvatarPreset(presetNumber) {
                await this.$axios.post(`/api/profile/chooseAvatarPreset/${presetNumber}`)
                await this.loadUser();
                this.popupAvatar = false;
            },
            ...call('authentication', ['loadUser'])
        }
    };
</script>

<style lang="scss">
    @import "./../../styles/mixins.scss";

    .user-profile {
        background: #f1f8fc;
        padding: 40px 40px 35px;
        width: 100%;
        position: relative;

        &__avatar {
            width: 120px;
            height: 120px;
            background-position: center;
            background-size: 100%;
            margin: 30px 0 0;
            cursor: pointer;

            &-list {
                display: flex;
                justify-content: space-between;
                flex-wrap: wrap;
            }
        }

        &__content {
            &.--verified:before {
                content: "";
                background-image: url("data:image/svg+xml,%3Csvg width='50' height='70' viewBox='0 0 50 70' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0H50V70L25 60L0 70V0Z' fill='%237AB73F'/%3E%3Cpath fill-rule='evenodd' clip-rule='evenodd' d='M13 30.6733L25.5712 43L38 30.638L34.5812 27L25.5712 35.936L16.49 27.0353L13 30.6733Z' fill='white'/%3E%3C/svg%3E%0A");
                position: absolute;
                top: 0;
                left: 40px;
                width: 50px;
                height: 70px;
                z-index: 1;
            }
        }

        &__favorites {
            position: absolute;
            right: 70px;
            top: 40px;
            cursor: pointer;
            font-size: 0;

            path {
                transition: fill 0.3s;
            }

            &:hover {
                path {
                    fill: $yellow;
                }
            }
        }

        &__icon {
            position: relative;
            display: block;
            width: 250px;
            height: 250px;
            border-radius: 50%;
            margin: 0 auto;
            background-color: #ffffff;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            overflow: hidden;
            text-align: center;
            font-size: 0;

            &-link {
                display: block;
                font-size: 14px;
                line-height: 20px;
                color: #ffffff;
                cursor: pointer;
                transition: opacity 0.3s;

                &:hover {
                    opacity: 0.7;
                }

                & + .user-profile__icon-link {
                    margin: 10px 0 0;
                }
            }

            &-edit {
                padding: 15px 0 0;
                position: absolute;
                width: 250px;
                height: 90px;
                background: rgba(0, 0, 0, 0.8);
                bottom: 0;
                left: 0;
                display: none;
            }

            &.--hl {
                border: 4px solid #9348f2;
            }

            &:hover {
                .user-profile__icon-edit {
                    display: block;
                }
            }
        }

        &__name {
            font-weight: bold;
            font-size: 32px;
            line-height: 40px;
            color: #333333;
            margin-top: 28px;
        }

        &__title {
            margin-top: 26px;
            font-weight: bold;
            font-size: 16px;
            line-height: 20px;
            color: #333333;
        }

        &__email,
        &__phone {
            margin-top: 20px;
            font-size: 16px;
            line-height: 20px;
            color: #333333;
        }

        &__edit {
            margin-top: 30px;
            font-size: 14px;
            line-height: 20px;
            color: #5b6067;

            a {
                color: #5b6067;
                transition: opacity 0.3s;

                &:hover {
                    opacity: 0.7;
                }
            }
        }
    }
</style>