<template>
    <div class="main-page">
        <IntroForm/>
        <ObjectModal></ObjectModal>
        <div class="main-page__map">
            <client-only>
                <MainMap/>
            </client-only>
        </div>

        <div class="main-page__options">
            <button class="button button_blue" type="button" @click="popupOpen = true">
                <img :src="require(`~/assets/icons/categories/${category}.svg`)" v-if="category"/>
            </button>
            <button class="button button_blue" type="button">
                <img :src="require(`~/assets/icons/site-map.svg`)"/>
            </button>
        </div>
        <div class="main-page__actions">
            <nuxt-link :to="{name: 'objects-add'}" class="button button_green" type="button" name="add_object">
                <svg
                        width="20"
                        height="20"
                        viewBox="0 0 20 20"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M12.5 0H7.5V7.5H0V12.5H7.5V20H12.5V12.5H20V7.5H12.5V0Z"
                            fill="white"
                    />
                </svg>
            </nuxt-link>
            <nuxt-link :to="{name: 'complaint'}" class="button button_red">
                <svg
                        width="19"
                        height="21"
                        viewBox="0 0 19 21"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                            d="M15.5527 5.65379C16.2218 5.65379 16.7643 5.11137 16.7643 4.44225C16.7643 3.77314 16.2218 3.23071 15.5527 3.23071C14.8836 3.23071 14.3412 3.77314 14.3412 4.44225C14.3412 5.11137 14.8836 5.65379 15.5527 5.65379Z"
                            fill="white"
                    />
                    <path
                            d="M12.322 3.23082C12.9911 3.23082 13.5335 2.68839 13.5335 2.01928C13.5335 1.35016 12.9911 0.807739 12.322 0.807739C11.6529 0.807739 11.1105 1.35016 11.1105 2.01928C11.1105 2.68839 11.6529 3.23082 12.322 3.23082Z"
                            fill="white"
                    />
                    <path
                            d="M9.09118 2.42308C9.76029 2.42308 10.3027 1.88065 10.3027 1.21154C10.3027 0.542424 9.76029 0 9.09118 0C8.42206 0 7.87964 0.542424 7.87964 1.21154C7.87964 1.88065 8.42206 2.42308 9.09118 2.42308Z"
                            fill="white"
                    />
                    <path
                            d="M5.86046 4.03843C6.52958 4.03843 7.072 3.49601 7.072 2.82689C7.072 2.15778 6.52958 1.61536 5.86046 1.61536C5.19135 1.61536 4.64893 2.15778 4.64893 2.82689C4.64893 3.49601 5.19135 4.03843 5.86046 4.03843Z"
                            fill="white"
                    />
                    <path
                            d="M14.3412 4.44232V9.69232C14.3412 9.91524 14.1603 10.0962 13.9374 10.0962C13.7145 10.0962 13.5336 9.91524 13.5336 9.69232V2.01924H11.1105V8.88462C11.1105 9.10755 10.9296 9.28847 10.7066 9.28847C10.4837 9.28847 10.3028 9.10755 10.3028 8.88462V1.21155H7.87971V8.88462C7.87971 9.10755 7.69878 9.28847 7.47586 9.28847C7.25294 9.28847 7.07201 9.10755 7.07201 8.88462V2.82693H4.64894V12.9231L3.01336 10.685C2.52874 9.93786 1.58294 9.68747 0.889937 10.1155C0.19936 10.5533 0.0281296 11.508 0.506283 12.2527C0.506283 12.2527 3.14421 16.2451 4.26851 17.9542C5.39282 19.6633 7.21417 21 10.6202 21C16.2595 21 16.7643 16.6449 16.7643 15.3462C16.7643 14.0474 16.7643 4.44232 16.7643 4.44232H14.3412Z"
                            fill="white"
                    />
                </svg>
            </nuxt-link>
        </div>
        <div class="popup__wrapper" v-if="confirmPopup">
            <div class="popup__in --md">
                <span class="popup__close" v-on:click="confirmPopup = false"></span>
                <h5 class="popup__title">Подтвердите данные об объекте</h5>
                <p class="popup__text">Считаете ли вы, что все данные об объекте «Суши-бар Saya Sushi» заполнены верно?</p>
                <div class="popup__buttons">
                    <button type="button" class="popup__button --no">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.28 1.28H0V9.6H0.38976C1.33248 9.6 2.1984 10.1178 2.64448 10.9478L4.15936 13.7658L4.48 16H5.12C7.04 16 7.04 14.2406 7.04 12.8C7.04 12.3302 6.4 10.24 6.4 10.24H12.48C13.3637 10.24 14.08 9.52366 14.08 8.64C14.08 8.11661 13.8287 7.65191 13.4402 7.36C13.8287 7.06809 14.08 6.60339 14.08 6.08C14.08 5.39275 13.6467 4.80671 13.0384 4.58014C13.2883 4.29786 13.44 3.92665 13.44 3.52C13.44 2.74593 12.8903 2.10025 12.16 1.95201V1.28C12.16 0.573076 11.5869 0 10.88 0H4.36992C3.21088 0 2.09984 0.46016 1.28 1.28Z" fill="white"/>
                        </svg>
                        <span>Нет</span>
                    </button>
                    <button type="button" class="popup__button --yes">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.28 14.72H0V6.4H0.38976C1.33248 6.4 2.1984 5.88224 2.64448 5.05216L4.15936 2.23424L4.48 0H5.12C7.04 0 7.04 1.75936 7.04 3.2C7.04 3.66976 6.4 5.76 6.4 5.76H12.48C13.3637 5.76 14.08 6.47634 14.08 7.36C14.08 7.88339 13.8287 8.34809 13.4402 8.64C13.8287 8.93191 14.08 9.39661 14.08 9.92C14.08 10.6072 13.6467 11.1933 13.0384 11.4199C13.2883 11.7021 13.44 12.0734 13.44 12.48C13.44 13.2541 12.8903 13.8997 12.16 14.048V14.72C12.16 15.4269 11.5869 16 10.88 16H4.36992C3.21088 16 2.09984 15.5398 1.28 14.72Z" fill="white"/>
                        </svg>
                        <span>Да</span>
                    </button>
                </div>
            </div>
        </div>
        <nuxt/>
    </div>
</template>

<script>
    import IntroForm from "./../components/IntroForm.vue";
    import StartCategoryForm from "./../components/StartCategoryForm.vue";
    import ObjectModal from "./../components/ObjectModal.vue";
    import MainMap from "./../components/MainMap.vue";
    import LoginForm from "../components/LoginForm";
    import {get, sync} from 'vuex-pathify'

    export default {
        data() {
            return {
                confirmPopup: false
            }
        },
        components: {
            LoginForm,
            IntroForm,
            StartCategoryForm,
            ObjectModal,
            MainMap
        },
        computed: {
            popupOpen: sync('disabilitiesCategorySettings/popupOpen'),
            category: sync('disabilitiesCategorySettings/category'),
        }
    }
</script>

<style lang="scss">
    @import "./../styles/mixins.scss";

    .main-page {
        display: block;
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        background: #e5e5e5;
        overflow: hidden;

        &__map {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            z-index: 1;
        }

        &__options {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            align-items: center;
            position: absolute;
            top: 20px;
            right: 20px;
            background: $white;
            padding: 20px;
            z-index: 10;

            @media all and (max-width: 1023px) {
                right: 0;
                flex-direction: column;
            }

            .button {
                border: none;
                width: 40px;
                height: 40px;
                display: flex;
                flex-direction: row;
                justify-content: center;
                align-items: center;
                cursor: pointer;
                transition: opacity 0.3s;
                margin-right: 20px;

                @media all and (max-width: 1023px) {
                    margin: 0 0 10px;

                }

                &:last-child {
                    margin-right: 0;
                    @media all and (max-width: 1023px) {
                        margin: 0;
                    }
                }

                &:hover {
                    opacity: 0.7;
                }

                &_red {
                    background: $red;
                }

                &_green {
                    background: $green;
                }

                &_blue {
                    background: $blue;
                }
            }
        }

        &__actions {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            align-items: center;
            position: absolute;
            bottom: 20px;
            right: 20px;
            z-index: 10;

            @media all and (max-width: 1023px) {
                flex-direction: column;
            }

            .button {
                border: none;
                width: 50px;
                height: 50px;
                border-radius: 50%;
                display: flex;
                flex-direction: row;
                justify-content: center;
                align-items: center;
                cursor: pointer;
                transition: opacity 0.3s;
                margin-right: 10px;

                @media all and (max-width: 1023px) {
                    margin: 0 0 10px;
                }

                &:last-child {
                    margin-right: 0;
                    @media all and (max-width: 1023px) {
                       margin: 0;
                    }
                }

                &:hover {
                    opacity: 0.7;
                }

                &_red {
                    background: $red;
                }

                &_green {
                    background: $green;
                }

                &_blue {
                    background: $blue;
                }
            }
        }
    }
</style>
