<template>
    <div class="main-filter">
        <div class="main-filter__header">
            <div class="main-filter__menu">
                <a href="#"><span>Помощь</span></a>
                <a href="#"><span>О проекте</span></a>
                <nuxt-link :to="{name: 'blog-category'}"><span>Блог</span></nuxt-link>
                <a href="#"><span>Контакты</span></a>
            </div>

            <div class="spacer"></div>

            <div class="main-filter__visual">
                <svg
                        width="30"
                        height="16"
                        viewBox="0 0 30 16"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                            d="M15.0243 0C9.141 0 3.84117 3.01459 0 7.8282C3.84117 12.6904 9.141 15.6564 15.0243 15.6564C20.9076 15.6564 26.2075 12.6418 30.0486 7.8282C26.1588 3.01459 20.859 0 15.0243 0ZM15.0243 14.0519C11.5721 14.0519 8.80065 11.2804 8.80065 7.8282C8.80065 4.37601 11.5721 1.60454 15.0243 1.60454C18.4765 1.60454 21.248 4.37601 21.248 7.8282C21.248 11.2804 18.4279 14.0519 15.0243 14.0519Z"
                            fill="black"
                    />
                    <path
                            d="M17.8445 7.58509C17.1151 7.58509 16.483 7.00162 16.483 6.22366C16.483 5.73744 16.7748 5.29984 17.1638 5.05673C16.5803 4.5705 15.8023 4.32739 15.0244 4.32739C13.0795 4.32739 11.5236 5.88331 11.5236 7.8282C11.5236 9.7731 13.0795 11.329 15.0244 11.329C16.9693 11.329 18.5252 9.7731 18.5252 7.8282C18.5252 7.68234 18.5252 7.53647 18.4766 7.3906C18.2821 7.48785 18.0876 7.58509 17.8445 7.58509Z"
                            fill="black"
                    />
                </svg>
            </div>

            <div class="main-filter__language">
                <LangSelect />
            </div>
        </div>

        <div class="main-filter__title">
            <nuxt-link :to="{name: 'index'}" class="main-filter__logo">
                <img :src="require('@/assets/logo.svg')" alt />
            </nuxt-link>
            <div class="main-filter__geo">
                <div class="main-filter__geo-city" @click="selectCity = !selectCity">
                    <svg width="12" height="17" viewBox="0 0 12 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6 16.25C6 16.25 12 9.71155 12 6.34524C12 2.97893 9.31371 0.25 6 0.25C2.68629 0.25 0 2.97893 0 6.34524C0 9.71155 6 16.25 6 16.25ZM6 8.63095C7.24264 8.63095 8.25 7.6076 8.25 6.34524C8.25 5.08287 7.24264 4.05952 6 4.05952C4.75736 4.05952 3.75 5.08287 3.75 6.34524C3.75 7.6076 4.75736 8.63095 6 8.63095Z" fill="#3180F7"/>
                    </svg>
                    <span>Усть-Каменогорск</span>
                </div>
                <div class="main-filter__geo-sub" v-if="selectCity">
                    <div class="main-filter__geo-list --regions">
                        <span class="main-filter__geo-item__title">Область</span>
                        <span class="main-filter__geo-item" :class="{ selected: selectedRegion == 'region_3' }" @click="selectedRegion = 'region_3'">Акмолинская</span>
                        <span class="main-filter__geo-item" :class="{ selected: selectedRegion == 'region_4' }" @click="selectedRegion = 'region_4'">Актюбинская</span>
                        <span class="main-filter__geo-item" :class="{ selected: selectedRegion == 'region_5' }" @click="selectedRegion = 'region_5'">Алматинская</span>
                        <span class="main-filter__geo-item" :class="{ selected: selectedRegion == 'region_6' }" @click="selectedRegion = 'region_6'">Атырауская</span>
                        <span class="main-filter__geo-item" :class="{ selected: selectedRegion == 'region_7' }" @click="selectedRegion = 'region_7'">Восточно-Казахстанская</span>
                        <span class="main-filter__geo-item" :class="{ selected: selectedRegion == 'region_8' }" @click="selectedRegion = 'region_8'">Жамбылская</span>
                        <span class="main-filter__geo-item" :class="{ selected: selectedRegion == 'region_9' }" @click="selectedRegion = 'region_9'">Западно-Казахстанская</span>
                        <span class="main-filter__geo-item" :class="{ selected: selectedRegion == 'region_10' }" @click="selectedRegion = 'region_10'">Карагандинская</span>
                        <span class="main-filter__geo-item" :class="{ selected: selectedRegion == 'region_11' }" @click="selectedRegion = 'region_11'">Костанайская</span>
                        <span class="main-filter__geo-item" :class="{ selected: selectedRegion == 'region_12' }" @click="selectedRegion = 'region_12'">Кызылординская</span>
                        <span class="main-filter__geo-item" :class="{ selected: selectedRegion == 'region_13' }" @click="selectedRegion = 'region_13'">Мангистауская</span>
                        <span class="main-filter__geo-item" :class="{ selected: selectedRegion == 'region_14' }" @click="selectedRegion = 'region_14'">Павлодарская</span>
                        <span class="main-filter__geo-item" :class="{ selected: selectedRegion == 'region_15' }" @click="selectedRegion = 'region_15'">Северо-Казахстанская</span>
                        <span class="main-filter__geo-item" :class="{ selected: selectedRegion == 'region_16' }" @click="selectedRegion = 'region_16'">Туркестанская</span>
                    </div>
                    <div class="main-filter__geo-list --cities">
                        <span class="main-filter__geo-item__title">Город</span>
                        <div v-if="selectedRegion == 'region_3'">
                            <span class="main-filter__geo-item">Астана</span>
                            <span class="main-filter__geo-item">Кокшетау</span>
                            <span class="main-filter__geo-item">Степногорск</span>
                            <span class="main-filter__geo-item">Атбасар</span>
                            <span class="main-filter__geo-item">Макинск</span>
                        </div>
                        <div v-if="selectedRegion == 'region_4'">
                            <span class="main-filter__geo-item">Актобе</span>
                            <span class="main-filter__geo-item">Шалкар</span>
                            <span class="main-filter__geo-item">Эмба</span>
                        </div>
                        <div v-if="selectedRegion == 'region_5'">
                            <span class="main-filter__geo-item">Талдыкорган</span>
                            <span class="main-filter__geo-item">Талгар</span>
                            <span class="main-filter__geo-item">Алматы</span>
                            <span class="main-filter__geo-item">Отеген-батыр</span>
                        </div>
                        <div v-if="selectedRegion == 'region_6'">
                            <span class="main-filter__geo-item">Атырау</span>
                            <span class="main-filter__geo-item">Кульсары</span>
                            <span class="main-filter__geo-item">Ганюшкино</span>
                            <span class="main-filter__geo-item">Махамбет</span>
                        </div>
                        <div v-if="selectedRegion == 'region_7'">
                            <span class="main-filter__geo-item">Зыряновск</span>
                            <span class="main-filter__geo-item">Риддер</span>
                            <span class="main-filter__geo-item">Семей</span>
                            <span class="main-filter__geo-item">Усть-Каменогорск</span>
                        </div>
                        <div v-if="selectedRegion == 'region_8'">
                            <span class="main-filter__geo-item">Тараз</span>
                            <span class="main-filter__geo-item">Шу</span>
                            <span class="main-filter__geo-item">Каскелен</span>
                            <span class="main-filter__geo-item">Бауржан Момышулы</span>
                        </div>
                        <div v-if="selectedRegion == 'region_9'">
                            <span class="main-filter__geo-item">уральск</span>
                            <span class="main-filter__geo-item">Аксай</span>
                            <span class="main-filter__geo-item">Федоровка</span>
                        </div>
                        <div v-if="selectedRegion == 'region_10'">
                            <span class="main-filter__geo-item">Караганда</span>
                            <span class="main-filter__geo-item">Темиртау</span>
                            <span class="main-filter__geo-item">Жезказган</span>
                            <span class="main-filter__geo-item">Балхаш</span>
                        </div>
                        <div v-if="selectedRegion == 'region_11'">
                            <span class="main-filter__geo-item">Костаная</span>
                            <span class="main-filter__geo-item">Рудный</span>
                            <span class="main-filter__geo-item">Затобольск</span>
                            <span class="main-filter__geo-item">Лисаковск</span>
                        </div>
                        <div v-if="selectedRegion == 'region_12'">
                            <span class="main-filter__geo-item">Кызылорда</span>
                            <span class="main-filter__geo-item">Байконур</span>
                            <span class="main-filter__geo-item">Аральск</span>
                        </div>
                        <div v-if="selectedRegion == 'region_13'">
                            <span class="main-filter__geo-item">Актау</span>
                            <span class="main-filter__geo-item">Жанаозен</span>
                            <span class="main-filter__geo-item">Форт-Шевченко</span>
                            <span class="main-filter__geo-item">Мангистау</span>
                        </div>
                        <div v-if="selectedRegion == 'region_14'">
                            <span class="main-filter__geo-item">Павлодар</span>
                            <span class="main-filter__geo-item">Аксу</span>
                            <span class="main-filter__geo-item">Экибастуз</span>
                            <span class="main-filter__geo-item">Калкаман</span>
                        </div>
                        <div v-if="selectedRegion == 'region_15'">
                            <span class="main-filter__geo-item">Петропавловск</span>
                            <span class="main-filter__geo-item">Булаево</span>
                            <span class="main-filter__geo-item">Сергеевка</span>
                        </div>
                        <div v-if="selectedRegion == 'region_16'">
                            <span class="main-filter__geo-item">Туркестан</span>
                            <span class="main-filter__geo-item">Арыс</span>
                            <span class="main-filter__geo-item">Кентау</span>
                            <span class="main-filter__geo-item">Сарыагаш</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-filter__search">
            <form class="input">
                <input type="text" placeholder="Тип объекта, название или улица" />
                <button alt="search">
                    <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                                d="M23.3397 20.1519L19.3617 16.1746C20.4101 14.5385 21.036 12.6053 21.036 10.5179C21.036 4.70874 16.3272 0 10.518 0C4.70944 0 0 4.70874 0 10.518C0 16.3273 4.70944 21.036 10.518 21.036C12.6053 21.036 14.5385 20.4101 16.1739 19.3617L20.1518 23.3397C21.0322 24.2201 22.4593 24.2201 23.3397 23.3397C24.2201 22.4593 24.2201 21.0323 23.3397 20.1519ZM10.518 18.0309C6.369 18.0309 3.00511 14.6677 3.00511 10.518C3.00511 6.36905 6.36905 3.00516 10.518 3.00516C14.6676 3.00516 18.0308 6.36905 18.0308 10.518C18.0308 14.6677 14.6676 18.0309 10.518 18.0309Z"
                                fill="#5B6067"
                        />
                    </svg>
                </button>
            </form>
            <div class="voice-input">
                <button>
                    <svg
                            width="18"
                            height="24"
                            viewBox="0 0 18 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                    >
                        <g clip-path="url(#clip0)">
                            <path
                                    d="M8.90137 18.0282V22.5352"
                                    stroke="#5B6067"
                                    stroke-width="2.5"
                                    stroke-miterlimit="10"
                            />
                            <path
                                    d="M5.40845 22.5352H12.3944"
                                    stroke="#5B6067"
                                    stroke-width="2.5"
                                    stroke-miterlimit="10"
                                    stroke-linecap="round"
                            />
                            <path
                                    d="M16.3381 10.9296C16.3381 14.9859 12.9578 18.3662 8.90146 18.3662C4.84513 18.3662 1.46484 14.9859 1.46484 10.9296"
                                    stroke="#5B6067"
                                    stroke-width="2.5"
                                    stroke-miterlimit="10"
                                    stroke-linecap="round"
                            />
                            <path
                                    d="M8.90143 14.9859C6.64791 14.9859 4.84509 13.1831 4.84509 10.9296V4.16901C4.84509 1.91549 6.64791 0.112671 8.90143 0.112671C11.155 0.112671 12.9578 1.91549 12.9578 4.16901V10.9296C12.9578 13.1831 11.155 14.9859 8.90143 14.9859Z"
                                    fill="#5B6067"
                            />
                        </g>
                        <defs>
                            <clipPath id="clip0">
                                <rect width="17.6901" height="24" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                </button>
            </div>
        </div>

        <CategorySelector />
    </div>
</template>

<script>
    import CategorySelector from "./../components/CategorySelector";
    import LangSelect from "./../components/LangSelect";
    export default {
        data() {
            return {
                selectCity: false,
                selectedRegion: 'region_7'
            };
        },
        components: {
            CategorySelector,
            LangSelect
        },
        methods: {}
    };
</script>

<style lang="scss">
    @import "./../styles/mixins.scss";

    .main-filter {
        background: $white;
        width: 100%;
        flex: 1 0 auto;
        margin-bottom: 10px;
        padding: 15px 0 15px 40px;
        max-height: calc(100% - 400px);

        &__header {
            display: flex;
            align-items: center;
            padding-right: 40px;
        }

        &__menu {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            a {
                font-size: 14px;
                line-height: 20px;
                color: #333333;
                transition: opacity 0.3s;
                margin-right: 14px;
                &:last-child {
                     margin-right: 0;
                 }
                &:hover {
                     opacity: 0.7;
                 }
            }
        }

        &__visual {
            margin: 0 15px;
            cursor: pointer;
            transition: opacity 0.3s;
            &:hover {
             opacity: 0.7;
         }
        }

        &__title {
            padding-top: 20px;
            padding-right: 40px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: flex-end;
        }

        &__logo {
            display: block;
        }

        &__geo {
            margin-bottom: 4px;
            position: relative;
            z-index: 2;
            &-city {
                display: flex;
                flex-direction: row;
                align-items: center;
                justify-content: flex-end;
                cursor: pointer;
                transition: opacity 0.3s;
                &:hover {
                    opacity: 0.7;
                }
                span {
                    font-size: 16px;
                    line-height: 20px;
                    color: #333333;
                    border-bottom: 1px dashed #333333;
                }

                svg {
                    margin-right: 7px;
                }
            }
            &-sub {
                 margin: 16px 0 0;
                 position: absolute;
                 border: 1px solid $stroke;
                 left: 0;
                 top: 100%;
                 background: #ffffff;
                 display: flex;
            }
            &-list {
                 padding: 15px 0 25px;
                &.--regions {
                     border-right: 1px solid rgba(123, 149, 167, 0.3);
                    .main-filter__geo-item {
                        padding: 0 23px 0 20px;
                        min-width: 230px;
                        &__title {
                            padding: 0 23px 0 20px;
                        }
                    }
                }
                &.--cities {
                    .main-filter__geo-item {
                       padding: 0 23px 0 30px;
                       min-width: 230px;
                       &__title {
                          padding: 0 23px 0 30px;
                       }
                    }
                }
            }
            &-item {
                display: block;
                cursor: pointer;
                font-size: 16px;
                line-height: 30px;
                white-space: nowrap;
                background: transparent;
                transition: background 0.3s;
                &__title {
                    font-size: 14px;
                    line-height: 20px;
                    color: $stroke;
                    margin: 0 0 4px;
                    display: block;
                }
                &.selected, &:hover {
                    background: $light-gray;
                    font-weight: 700;
                 }
            }
        }

        &__search {
             padding-right: 40px;
             padding-top: 30px;
             padding-bottom: 30px;
             display: flex;
             flex-direction: row;
             justify-content: flex-start;
             align-items: center;

            .input {
                margin-right: 10px;
                input {
                    width: calc(100% - 40px);
                }
            }

            .voice-input {
                display: block;
                button {
                   border: 1px solid #7b95a7;
                   height: 50px;
                   width: 50px;
                   display: flex;
                   flex-direction: row;
                   justify-content: center;
                   align-items: center;
                   background: $tr;
                   cursor: pointer;
                }
            }
        }
    }
</style>