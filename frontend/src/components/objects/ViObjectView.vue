<template>
    <div class="vi" :class="{'--noto': fontFamily == 'Noto', '--black': colorTheme == 'black', '--sm': fontSize == 'sm', '--md': fontSize == 'md','--lrg': fontSize == 'lrg'}">
        <div class="vi-container">
            <ViHeader></ViHeader>
            <div class="vi-object" v-if="objectInfoShow === false">
                <a href="#" class="vi-object__top-link">Вернуться в категорию Питание / Бары</a>
                <h2 class="vi-object__title">{{ object.title }}</h2>
                <div class="vi-object__edit">
                    <span class="vi-object__address">{{ object.address }}</span>
                    <!--<a href="" class="vi-object__edit-link">Редактировать</a>-->
                </div>
                <div class="vi-object__tab-link-b">
                    <span class="vi-object__tab-link" :class="{ '--active': activeTab == 0 }" @click="setActiveTab(0)">Описание</span>
                    <span class="vi-object__tab-link" :class="{ '--active': activeTab == 1 }" @click="setActiveTab(1)">Фото</span>
                    <span class="vi-object__tab-link" :class="{ '--active': activeTab == 2 }" @click="setActiveTab(2)">Видео</span>
                    <span class="vi-object__tab-link" :class="{ '--active': activeTab == 3 }" @click="setActiveTab(3)">Отзывы</span>
                    <span class="vi-object__tab-link" :class="{ '--active': activeTab == 4 }" @click="setActiveTab(4)">История</span>
                </div>
                <div class="vi-object__tab-content-b">
                    <div class="vi-object__tab-content" v-if="activeTab == 0">
                        <div class="vi-object__available-top">
                            <h4 class="vi-object__available-top__title">Оценка объекта: Частично доступно</h4>
                            <div class="vi-object__available-top__item">Парковка — частично доступно</div>
                            <div class="vi-object__available-top__item">Входная группа — доступно</div>
                            <div class="vi-object__available-top__item">Пути движения по объекту — доступно</div>
                            <div class="vi-object__available-top__item">Навигация — недоступно</div>
                            <div class="vi-object__available-top__item">Зона оказания услуги — доступно</div>
                            <div class="vi-object__available-top__item">Доступность услуги — доступно</div>
                            <div class="vi-object__available-top__item">Туалет — доступно</div>
                        </div>
                        <p class="vi-object__text">{{ object.description }}</p>
                        <div class="vi-object__verification-b">
                            <button type="button" class="vi__button" @click="objectInfoShow = true">Подробная информация</button>
                            <span class="vi-object__verification">Объект частично верифицирован</span>
                        </div>
                    </div>
                    <div class="vi-object__tab-content" v-if="activeTab == 1">
                        <div class="vi-object__photo">
                            <img :src="require('@/assets/img/files/01.png')"/>
                            <img :src="require('@/assets/img/files/02.png')"/>
                            <img :src="require('@/assets/img/files/03.png')"/>
                            <img :src="require('@/assets/img/files/blog1.png')"/>
                            <img :src="require('@/assets/img/files/blog2.png')"/>
                            <img :src="require('@/assets/img/files/represent.jpg')"/>
                        </div>
                    </div>
                    <div class="vi-object__tab-content" v-if="activeTab == 2">

                    </div>
                    <div class="vi-object__tab-content" v-if="activeTab == 3">
                        <ul class="vi-object__review-list">
                            <li class="vi-object__review">
                                <div class="vi-object__review-top">
                                    <span class="vi-object__review-author">Елена Малышева</span>
                                    <span class="vi-object__review-date">10.12.2013</span>
                                </div>
                                <p class="vi-object__review-text">Была там на днях, очень понравилось. Без туалета, конечно, не очень удобно, но руки помыть можно без проблем. Персонал очень вежливый, помогали мне. Суши просто огонь и пицца прям что надо, рекомендую!</p>
                            </li>
                            <li class="vi-object__review">
                                <div class="vi-object__review-top">
                                    <span class="vi-object__review-author">Елена Малышева</span>
                                    <span class="vi-object__review-date">10.12.2013</span>
                                </div>
                                <p class="vi-object__review-text">Была там на днях, очень понравилось. Без туалета, конечно, не очень удобно, но руки помыть можно без проблем. Персонал очень вежливый, помогали мне. Суши просто огонь и пицца прям что надо, рекомендую!</p>
                            </li>
                            <li class="vi-object__review">
                                <div class="vi-object__review-top">
                                    <span class="vi-object__review-author">Елена Малышева</span>
                                    <span class="vi-object__review-date">10.12.2013</span>
                                </div>
                                <p class="vi-object__review-text">Была там на днях, очень понравилось. Без туалета, конечно, не очень удобно, но руки помыть можно без проблем. Персонал очень вежливый, помогали мне. Суши просто огонь и пицца прям что надо, рекомендую!</p>
                            </li>
                            <li class="vi-object__review">
                                <div class="vi-object__review-top">
                                    <span class="vi-object__review-author">Елена Малышева</span>
                                    <span class="vi-object__review-date">10.12.2013</span>
                                </div>
                                <p class="vi-object__review-text">Была там на днях, очень понравилось. Без туалета, конечно, не очень удобно, но руки помыть можно без проблем. Персонал очень вежливый, помогали мне. Суши просто огонь и пицца прям что надо, рекомендую!</p>
                            </li>
                        </ul>
                        <div class="vi-object__review-add">
                            <button type="button" class="vi__button" @click="reviewNew = true">Оставить отзыв</button>
                        </div>
                        <div class="vi-object__review-new" v-if="reviewNew">
                            <textarea placeholder="Текст сообщения"></textarea>
                            <button type="button" class="vi__button">Отправить</button>
                        </div>
                    </div>
                    <div class="vi-object__tab-content" v-if="activeTab == 4">
                        <ul class="vi-object__history">
                            <li class="vi-object__history-item">
                                <span class="vi-object__history-date">12 августа</span>
                                <p class="vi-object__history-text"><b>Алдияр Тулебаев</b> добавил 2 фотографии</p>
                            </li>
                            <li class="vi-object__history-item">
                                <span class="vi-object__history-date">12 августа</span>
                                <p class="vi-object__history-text"><b>Алдияр Тулебаев</b> добавил 2 фотографии</p>
                            </li>
                            <li class="vi-object__history-item">
                                <span class="vi-object__history-date">12 августа</span>
                                <p class="vi-object__history-text"><b>Алдияр Тулебаев</b> добавил 2 фотографии</p>
                            </li>
                            <li class="vi-object__history-item">
                                <span class="vi-object__history-date">12 августа</span>
                                <p class="vi-object__history-text"><b>Алдияр Тулебаев</b> добавил 2 фотографии</p>
                            </li>
                        </ul>
                    </div>
                    <div class="vi-object__content-complaint">
                        <button type="button" class="vi__button">Подать жалобу</button>
                        <button type="button" class="vi__button">Подтвердить данные</button>
                    </div>
                </div>
            </div>
            <div class="vi-object__available" v-if="objectInfoShow === true">
                <span class="vi-object__top-link" @click="objectInfoShow = false">Вернуться к объекту Saya Sushi, суши-бар</span>
                <h2 class="vi-object__title">Подробная информация</h2>
                <div class="vi-object__anchor-b">
                    <div class="vi-object__anchor-list">
                        <div class="vi-object__anchor-item">
                            <span class="vi-object__anchor" @click="setVisible('detail_1')" :class="{ '--active': visibleDetail == 'detail_1' }">Общая информация</span>
                        </div>
                        <div class="vi-object__anchor-item">
                            <span class="vi-object__anchor" @click="setVisible('detail_2')" :class="{ '--active': visibleDetail == 'detail_2' }">Парковка</span>
                        </div>
                        <div class="vi-object__anchor-item">
                            <span class="vi-object__anchor" @click="setVisible('detail_3')" :class="{ '--active': visibleDetail == 'detail_3' }">Входная группа</span>
                        </div>
                        <div class="vi-object__anchor-item">
                            <span class="vi-object__anchor" @click="setVisible('detail_4')" :class="{ '--active': visibleDetail == 'detail_4' }">Пути движения по объекту</span>
                        </div>
                    </div>
                    <div class="vi-object__anchor-list">
                        <div class="vi-object__anchor-item">
                            <span class="vi-object__anchor" @click="setVisible('detail_5')" :class="{ '--active': visibleDetail == 'detail_5' }">Зона оказания услуги</span>
                        </div>
                        <div class="vi-object__anchor-item">
                            <span class="vi-object__anchor" @click="setVisible('detail_6')" :class="{ '--active': visibleDetail == 'detail_6' }">Туалет</span>
                        </div>
                        <div class="vi-object__anchor-item">
                            <span class="vi-object__anchor" @click="setVisible('detail_7')" :class="{ '--active': visibleDetail == 'detail_7' }">Навигация</span>
                        </div>
                        <div class="vi-object__anchor-item">
                            <span class="vi-object__anchor" @click="setVisible('detail_8')" :class="{ '--active': visibleDetail == 'detail_8' }">Доступность услуги</span>
                        </div>
                    </div>
                    <a href="" class="vi__button">Скачать</a>
                </div>
                <div class="vi-object__available-content">
                    <div class="vi-object__available-item" id="detail_1">
                        <h4 class="vi-object__available-title">Общая информация</h4>
                        <div class="vi-object__available-line">
                            <div class="vi-object__available-text">
                                Количество парковочных мест (Не менее одного на 25 мест)
                            </div>
                            <div class="vi-object__available-status">
                                Нет
                            </div>
                        </div>
                        <div class="vi-object__available-line">
                            <div class="vi-object__available-text">
                                Количество парковочных мест (Не менее одного на 25 мест)
                            </div>
                            <div class="vi-object__available-status">
                                Не предусмотрено
                            </div>
                        </div>
                        <div class="vi-object__available-line">
                            <div class="vi-object__available-text">
                                Количество парковочных мест (Не менее одного на 25 мест)
                            </div>
                            <div class="vi-object__available-status">
                                Не предусмотрено
                            </div>
                        </div>
                        <div class="vi-object__available-line">
                            <div class="vi-object__available-text">
                                Количество парковочных мест (Не менее одного на 25 мест)
                            </div>
                            <div class="vi-object__available-status">
                                Не предусмотрено
                            </div>
                        </div>
                    </div>
                    <div class="vi-object__available-item" id="detail_2">
                        <h4 class="vi-object__available-title">Парковка</h4>
                        <div class="vi-object__available-line">
                            <div class="vi-object__available-text">
                                Количество парковочных мест (Не менее одного на 25 мест)
                            </div>
                            <div class="vi-object__available-status">
                                Да
                            </div>
                        </div>
                        <div class="vi-object__available-line">
                            <div class="vi-object__available-text">
                                Количество парковочных мест (Не менее одного на 25 мест)
                            </div>
                            <div class="vi-object__available-status">
                                Не предусмотрено
                            </div>
                        </div>
                        <h5 class="vi-object__available-text__title">Лестница наружная</h5>
                        <div class="vi-object__available-line">
                            <div class="vi-object__available-text">
                                Количество парковочных мест (Не менее одного на 25 мест)
                            </div>
                            <div class="vi-object__available-status">
                                Не предусмотрено
                            </div>
                        </div>
                        <div class="vi-object__available-line">
                            <div class="vi-object__available-text">
                                Количество парковочных мест (Не менее одного на 25 мест)
                            </div>
                            <div class="vi-object__available-status">
                                Не предусмотрено
                            </div>
                        </div>
                    </div>
                    <div class="vi-object__available-item" id="detail_3">
                        <h4 class="vi-object__available-title">Входная группа</h4>
                        <div class="vi-object__available-line">
                            <div class="vi-object__available-text">
                                Количество парковочных мест (Не менее одного на 25 мест)
                            </div>
                            <div class="vi-object__available-status">
                                Не предусмотрено
                            </div>
                        </div>
                    </div>
                    <div class="vi-object__available-item" id="detail_4">
                        <h4 class="vi-object__available-title">Пути движения по объекту</h4>
                        <div class="vi-object__available-line">
                            <div class="vi-object__available-text">
                                Количество парковочных мест (Не менее одного на 25 мест)
                            </div>
                            <div class="vi-object__available-status">
                                Да
                            </div>
                        </div>
                    </div>
                    <div class="vi-object__available-item" id="detail_5">
                        <h4 class="vi-object__available-title">Зона оказания услуги</h4>
                        <div class="vi-object__available-line">
                            <div class="vi-object__available-text">
                                Количество парковочных мест (Не менее одного на 25 мест)
                            </div>
                            <div class="vi-object__available-status">
                                Да
                            </div>
                        </div>
                    </div>
                    <div class="vi-object__available-item" id="detail_6">
                        <h4 class="vi-object__available-title">Туалет</h4>
                        <div class="vi-object__available-line">
                            <div class="vi-object__available-text">
                                Количество парковочных мест (Не менее одного на 25 мест)
                            </div>
                            <div class="vi-object__available-status">
                                Да
                            </div>
                        </div>
                    </div>
                    <div class="vi-object__available-item" id="detail_7">
                        <h4 class="vi-object__available-title">Навигация</h4>
                        <div class="vi-object__available-line">
                            <div class="vi-object__available-text">
                                Количество парковочных мест (Не менее одного на 25 мест)
                            </div>
                            <div class="vi-object__available-status">
                                Да
                            </div>
                        </div>
                    </div>
                    <div class="vi-object__available-item" id="detail_8">
                        <h4 class="vi-object__available-title">Доступность услуги</h4>
                        <div class="vi-object__available-line">
                            <div class="vi-object__available-text">
                                Количество парковочных мест (Не менее одного на 25 мест)
                            </div>
                            <div class="vi-object__available-status">
                                Да
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ViFooter></ViFooter>
        </div>
    </div>
</template>

<script>
    import ViHeader from "~/components/ViHeader";
    import ViFooter from "~/components/ViFooter";
    import {eventBus} from "~/store/bus";
    export default {
        name: 'ViObjectView',
        props: [
            'object'
        ],
        data() {
            return{
                fontSize: 'lrg',
                colorTheme: 'white',
                fontFamily: 'Lato',
                activeTab: 0,
                reviewNew: false,
                objectInfoShow: false,
                visibleDetail: 'detail_1'
            }
        },
        created() {
            eventBus.$on('setFontSize', this.setFontSize);
            eventBus.$on('setColorTheme', this.setColorTheme);
            eventBus.$on('setFontFamily', this.setFontFamily);
        },
        components: {
            ViHeader,
            ViFooter
        },
        methods: {
            setVisible(detail) {
                this.visibleDetail = detail;console.log(detail);
                document.getElementById('' + detail + '').scrollIntoView();
            },
            setActiveTab(n){
                this.activeTab = n;
            },
            setFontSize(fsize) {
                this.fontSize = '' + fsize + '';
            },
            setColorTheme(ctheme) {
                this.colorTheme = '' + ctheme + '';
            },
            setFontFamily(ff) {
                this.fontFamily = '' + ff + '';
            }
        }
    }
</script>

<style lang="scss">

    .vi {
        &-object {
            padding: 40px 0;
            &__photo {
                display: flex;
                justify-content: flex-start;
                align-items: flex-start;
                flex-wrap: wrap;
                img {
                    height: 210px;
                    width: auto;
                    margin: 0 20px 20px 0;
                }
            }
            &__history {
                list-style: none;
                padding: 20px 0;
                margin: 0;
                &-item {
                    margin: 36px 0 0;
                    display: flex;
                    &:first-child {
                        margin: 0;
                    }
                }
                &-date {
                    font-size: 22px !important;
                    line-height: 24px;
                    width: 150px;
                }
                &-text {
                    width: calc(100% - 150px);
                    line-height: 24px;
                }
            }
            &__review {
                margin: 56px 0 0;
                &:first-child {
                    margin: 0;
                }
                &-list {
                    padding: 20px 0 0;
                    list-style: none;
                    margin: 0;
                }
                &-author {
                    line-height: 50px;
                    font-weight: 700;
                }
                &-date {
                    line-height: 50px;
                    margin: 0 0 0 20px;
                }
                &-text {
                    line-height: 50px;
                }
                &-add {
                    margin: 50px 0 0;
                }
                &-new {
                    margin: 60px 0 0;
                    textarea {
                        width: 100%;
                        min-height: 200px;
                        padding: 16px 30px 20px;
                        border: 1px solid;
                        margin: 0 0 30px;
                    }
                }
            }
            &__top {
                &-link {
                    display: block;
                    line-height: 24px;
                    margin: 0 0 32px;
                }
            }
            &__title {
                font-size: 40px !important;
                line-height: 44px;
                margin: 0 0 30px;
            }
            &__edit {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin: 0 0 40px;
                &-link {
                    line-height: 24px;
                }
            }
            &__address {
                line-height: 24px;
            }
            &__content {
                &-complaint {
                    margin: 52px 0 0;
                    display: flex;
                    .vi__button + .vi__button {
                        margin: 0 0 0 20px;
                    }
                }
            }
            &__tab {
                &-content {
                    padding: 40px 0;
                }
            }
            &__available {
                padding: 40px 0;
                &-title {
                    font-size: 40px !important;
                    line-height: 40px;
                    margin: 54px 0 30px;
                }
                &-top {
                    border-bottom: 1px solid;
                    padding: 0 0 40px;
                    margin: 0 0 46px;
                    &__title {
                        font-size: 32px;
                        line-height: 36px;
                        margin: 0;
                    }
                    &__item {
                        line-height: 24px;
                        margin: 32px 0 0;
                    }
                }
                &-line {
                    display: flex;
                    border-bottom: 1px solid;
                    padding: 25px 0;
                }
                &-text {
                    width: calc(100% - 270px);
                    line-height: 30px;
                    &__title {
                        margin: 36px 0 10px;
                    }
                }
                &-status {
                    width: 260px;
                    text-align: left;
                    line-height: 30px;
                }
            }
            &__anchor {
                line-height: 44px;
                height: 50px;
                padding: 0 20px;
                border: 3px solid transparent;
                display: inline-block;
                position: relative;
                cursor: pointer;
                &-list {
                    max-width: 33.33%;
                    min-width: 33.33%;
                    &:first-child {
                        margin: 0 0 0 -20px;
                    }
                }
                &-item {
                    height: 60px;
                    padding: 5px 0;
                }
                &.--active {
                    font-weight: 700;
                    border-color: #000;
                    &:before {
                        content: '';
                        position: absolute;
                        border-top: 6px solid #000000;
                        border-left: 7px solid transparent;
                        border-right: 7px solid transparent;
                        left: 50%;
                        margin: 0 0 0 -7px;
                        bottom: -9px;
                    }
                    &:after {
                        content: '';
                        position: absolute;
                        border-top: 5px solid #FFFFFF;
                        border-left: 6px solid transparent;
                        border-right: 6px solid transparent;
                        left: 50%;
                        margin: 0 0 0 -6px;
                        bottom: -5px;
                        z-index: 1;
                    }
                }
                &-b {
                    display: flex;
                    align-items: flex-end;
                    border-bottom: 2px solid;
                    padding: 0 0 42px;
                }
            }
            &__text {
                line-height: 1.5;
            }
            &__verification {
                line-height: 24px;
                &-b {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin: 40px 0 0;
                }
            }
        }
    }

</style>