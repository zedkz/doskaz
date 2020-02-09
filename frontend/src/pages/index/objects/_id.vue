<template>
    <div class="sidebar">
        <div class="object-side">
            <div class="object-side__top">
                <nuxt-link :to="{name: 'index'}" class="object-side__close"></nuxt-link>
                <div class="object-side__breadcrumb-b">
                    <div class="object-side__breadcrumb-icon --drink"></div>
                    <div class="object-side__breadcrumb-list">
                        <a href="" class="object-side__breadcrumb">Питание</a>
                        <a href="" class="object-side__breadcrumb">Бары</a>
                    </div>
                </div>
                <h2 class="object-side__title">Saya Sushi, суши-бар</h2>
                <div class="object-side__address">
                    Локомотивная, 7 <a href="" class="object-side__address-link">Редактировать объект</a>
                </div>
            </div>
            <div class="availability">
                <div class="availability__title --partially" v-show="isPartially">Частично доступно</div>
                <div class="availability__title --not-available" v-show="isNotAvailable">Недоступно</div>
                <div class="availability__title --available" v-show="isAvailable">Доступно</div>
                <div class="availability__list">
                    <div class="availability__item --partially">Парковка</div>
                    <div class="availability__item --partially">Зона оказания услуги</div>
                    <div class="availability__item --not-available">Входная группа</div>
                    <div class="availability__item --available">Доступность услуги</div>
                    <div class="availability__item --not-available">Пути движения по объекту</div>
                    <div class="availability__item --available">Туалет</div>
                    <div class="availability__item --available">Навигация</div>
                </div>
            </div>
            <div class="object-side__content">
                <div class="object-side__tab-link-b">
                    <a class="object-side__tab-link" @click.prevent="setActive('tab-description')" :class="{ active: isActive('tab-description') }" href="#tab-description">Описание</a>
                    <a class="object-side__tab-link" @click.prevent="setActive('tab-photo')" :class="{ active: isActive('tab-photo') }" href="#tab-photo">Фото<span class="object-side__tab-num">7</span></a>
                    <a class="object-side__tab-link" @click.prevent="setActive('tab-reviews')" :class="{ active: isActive('tab-reviews') }" href="#tab-reviews">Отзывы<span class="object-side__tab-num">12</span></a>
                    <a class="object-side__tab-link" @click.prevent="setActive('tab-details')" :class="{ active: isActive('tab-details') }" href="#tab-details">Подробности</a>
                    <a class="object-side__tab-link" @click.prevent="setActive('tab-history')" :class="{ active: isActive('tab-history') }" href="#tab-history">История</a>
                </div>
                <div class="object-side__tab-content-b">
                    <div class="object-side__tab-content" :class="{ active: isActive('tab-description') }" id="tab-description">
                        <p class="text">Суши бар находится на первом этаже, входная группа выполнена на одном уровне с землёй, заезжать на коляске удобно и просторно. Есть парковка с двумя специально отведёнными местами для инвалидов. Пути движения по объекту достаточно просторны, можно проехать не мешая движению других. Возле кассовой стойки можно комфортно общаться с продавцом. Туалет с чашами генуя, не оборудован для людей, передвигающихся на колясках. Навигация представлена только в виде табличек на парковке, внутри помещения никаких специальных указателей нет.</p>
                        <p class="text__verification">Объект частично верифицирован</p>
                        <div class="object-side__button-b">
                            <a href="" class="object-side__button --complaint">Подать жалобу</a>
                            <a href="" class="object-side__button --check">Подтвердить данные</a>
                        </div>
                    </div>
                    <div class="object-side__tab-content" :class="{ active: isActive('tab-photo') }" id="tab-photo">
                        <div class="object-side__photo">
                            <div class="object-side__photo-year">2019</div>
                        </div>
                        <div class="object-side__photo">
                            <div class="object-side__photo-year">2018</div>
                        </div>
                    </div>
                    <div class="object-side__tab-content" :class="{ active: isActive('tab-reviews') }" id="tab-reviews">
                        <ul class="object-side__review-list">
                            <li class="object-side__review-item">
                                <div class="object-side__review-top">
                                    <span class="object-side__review-title">Елена Малышева</span>
                                    <span class="object-side__review-date">10 июля, 15:32</span>
                                </div>
                                <p class="object-side__review-text">Была там на днях, очень понравилось. Без туалета, конечно, не очень удобно, но руки помыть можно без проблем. Персонал очень вежливый, помогали мне. Суши просто огонь и пицца прям что надо, рекомендую!</p>
                            </li>
                            <li class="object-side__review-item">
                                <div class="object-side__review-top">
                                    <span class="object-side__review-title">Аружан Толеухан</span>
                                    <span class="object-side__review-date">24 июня, 22:01</span>
                                </div>
                                <p class="object-side__review-text">Что могу сказать — в нашем городе не так уж много заведений, где нам можно комфортно покушать и отдохнуть. Так что Сая суши даже с имеющимися недостатками можно смело записывать в избранное.</p>
                            </li>
                            <li class="object-side__review-item">
                                <div class="object-side__review-top">
                                    <span class="object-side__review-title">Марат</span>
                                    <span class="object-side__review-date">12 июня, 18:40</span>
                                </div>
                                <p class="object-side__review-text">Мне там понравилось. Удобно, чисто и вкусно! У них ещё и доставка есть, кстати!</p>
                            </li>
                            <li class="object-side__review-item">
                                <div class="object-side__review-top">
                                    <span class="object-side__review-title">Елена Малышева</span>
                                    <span class="object-side__review-date">24 июня, 22:01</span>
                                </div>
                                <p class="object-side__review-text">Была там на днях, очень понравилось. Без туалета, конечно, не очень удобно, но руки помыть можно без проблем. Персонал очень вежливый, помогали мне. Суши просто огонь и пицца прям что надо, рекомендую!</p>
                            </li>
                            <li class="object-side__review-item">
                                <div class="object-side__review-top">
                                    <span class="object-side__review-title">Аружан Толеухан</span>
                                    <span class="object-side__review-date">10 июля, 15:32</span>
                                </div>
                                <p class="object-side__review-text">Что могу сказать — в нашем городе не так уж много заведений, где нам можно комфортно покушать и отдохнуть. Так что Сая суши даже с имеющимися недостатками можно смело записывать в избранное.</p>
                            </li>
                            <li class="object-side__review-item">
                                <div class="object-side__review-top">
                                    <span class="object-side__review-title">Марат</span>
                                    <span class="object-side__review-date">10 июля, 15:32</span>
                                </div>
                                <p class="object-side__review-text">Мне там понравилось. удобно, чисто и вкусно! У них ещё и доставка есть, кстати!</p>
                            </li>
                        </ul>
                    </div>
                    <div class="object-side__tab-content" :class="{ active: isActive('tab-details') }" id="tab-details">
                        Подробности будут позже
                    </div>
                    <div class="object-side__tab-content" :class="{ active: isActive('tab-history') }" id="tab-history">
                        <ul class="object-side__history-list">
                            <li class="object-side__history-item">
                                <span class="object-side__history-date">12 августа</span>
                                <p class="object-side__history-text"><b>Алдияр Тулебаев</b> добавил 2 фотографии</p>
                            </li>
                            <li class="object-side__history-item">
                                <span class="object-side__history-date">11 августа</span>
                                <p class="object-side__history-text"><b>Алдияр Тулебаев</b> изменил описание объекта</p>
                            </li>
                            <li class="object-side__history-item">
                                <span class="object-side__history-date">10 августа</span>
                                <p class="object-side__history-text"><b>Елена Михеева</b> прокомментировала объект</p>
                            </li>
                            <li class="object-side__history-item">
                                <span class="object-side__history-date">9 августа</span>
                                <p class="object-side__history-text"><b>Алия Серикпаева</b> прокомментировала объект</p>
                            </li>
                            <li class="object-side__history-item">
                                <span class="object-side__history-date">6 августа</span>
                                <p class="object-side__history-text">Модератор <b>Volkorn</b> верифицировал фотографии объекта</p>
                            </li>
                            <li class="object-side__history-item">
                                <span class="object-side__history-date">6 августа</span>
                                <p class="object-side__history-text">Модератор <b>Volkorn</b> верифицировал описание объекта</p>
                            </li>
                            <li class="object-side__history-item">
                                <span class="object-side__history-date">6 августа</span>
                                <p class="object-side__history-text">Модератор <b>Volkorn</b> верифицировал зоны доступности объекта</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                isPartially: false,
                isNotAvailable: false,
                isAvailable: true,
                activeItem: 'tab-description'
            };
        },
        methods: {
            isActive (tabItem) {
                return this.activeItem === tabItem
            },
            setActive (tabItem) {
                this.activeItem = tabItem
            }
        }
    };
</script>

<style lang="scss">
    @import "@/styles/mixins.scss";

    .--partially {
        background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAxNiAxNiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTE2IDBIMFYxNkgxNlYwWiIgZmlsbD0iI0Y4QUMxQSIvPgo8cGF0aCBkPSJNMTIuNzk3MiA2LjgwMDY2SDMuMjAyODJWOS4xOTkyNEgxMi43OTcyVjYuODAwNjZaIiBmaWxsPSJ3aGl0ZSIvPgo8L3N2Zz4K);
    }
    .--available {
        background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAxNiAxNiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTE2IDBIMFYxNkgxNlYwWiIgZmlsbD0iIzNEQkEzQiIvPgo8cGF0aCBkPSJNNC41OTk1MyA0Ljg4MTg0TDMuMTg4NiA2LjMwNjg4TDcuOTk5ODkgMTEuMTA0MUwxMi44MTEyIDYuMzA2ODhMMTEuMzg2MSA0Ljg4MTg0TDcuOTk5ODkgOC4yODIxOUw0LjU5OTUzIDQuODgxODRaIiBmaWxsPSJ3aGl0ZSIvPgo8L3N2Zz4K);
    }
    .--not-available {
        background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAiIGhlaWdodD0iMzAiIHZpZXdCb3g9IjAgMCAzMCAzMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjMwIiBoZWlnaHQ9IjMwIiBmaWxsPSIjREUxMjIwIi8+CjxwYXRoIGQ9Ik0xIDI5VjFIMjlWMjlIMVoiIHN0cm9rZT0iI0RFMTIyMCIgc3Ryb2tlLXdpZHRoPSIyIi8+CjxwYXRoIGQ9Ik0xNi45NDA0IDE1LjcwODlMMjEuMjgyNSAyMC4wMjgzTDIwLjAyODUgMjEuMjgyM0wxNS43MDkxIDE2Ljk0MDJMMTUuMDAwMiAxNi4yMjc1TDE0LjI5MTIgMTYuOTQwMkw5Ljk3MTg2IDIxLjI4MjNMOC43MTc4MyAyMC4wMjgzTDEzLjA1OTkgMTUuNzA4OUwxMy43NzI2IDE1TDEzLjA1OTkgMTQuMjkxTDguNzE3ODMgOS45NzE2N0w5Ljk3MTg2IDguNzE3NjVMMTQuMjkxMiAxMy4wNTk3TDE1LjAwMDIgMTMuNzcyNEwxNS43MDkxIDEzLjA1OTdMMjAuMDI4NSA4LjcxNzY1TDIxLjI4MjUgOS45NzE2N0wxNi45NDA0IDE0LjI5MUwxNi4yMjc3IDE1TDE2Ljk0MDQgMTUuNzA4OVoiIHN0cm9rZT0id2hpdGUiIHN0cm9rZS13aWR0aD0iMiIvPgo8L3N2Zz4K);
    }

    .object-side {
        width: 100%;
        height: 100%;
        background: #ffffff;
        position: relative;
        overflow-x: hidden;
        overflow-y: auto;
        &::-webkit-scrollbar {
            width: 10px;
        }

        &::-webkit-scrollbar-track {
            background: $tr;
        }

        &::-webkit-scrollbar-thumb {
            background: transparentize(#c4c4c4, 0.5);
        }

        .availability {
            padding: 30px 40px 37px;
            background: #FEF3DD;
            &__title {
                font-weight: 700;
                font-size: 16px;
                line-height: 30px;
                padding: 0 0 0 38px;
                margin: 0 0 4px;
                background-size: 30px 30px;
                background-repeat: no-repeat;
                background-position: left top;
            }
            &__list {
                display: flex;
                flex-wrap: wrap;
            }
            &__item {
                font-size: 16px;
                line-height: 20px;
                height: 20px;
                margin: 30px 0 0;
                width: 50%;
                padding: 0 0 0 26px;
                background-position: left center;
                background-size: 16px 16px;
                background-repeat: no-repeat;
            }
        }
        &__button {
            font-size: 16px;
            line-height: 20px;
            padding: 14px 43px 16px 50px;
            display: inline-block;
            color: #ffffff;
            -webkit-transition: opacity 0.3s;
            -moz-transition: opacity 0.3s;
            -ms-transition: opacity 0.3s;
            -o-transition: opacity 0.3s;
            transition: opacity 0.3s;
            background-position: center left 30px;
            background-repeat: no-repeat;
            &:hover {
                opacity: 0.7;
            }
            & + .object-side__button {
                margin: 0 0 0 20px;
            }
            &.--check {
                background-color: $blue;
                background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIiIGhlaWdodD0iMTAiIHZpZXdCb3g9IjAgMCAxMiAxMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGcgY2xpcC1wYXRoPSJ1cmwoI2NsaXAwKSI+CjxwYXRoIGQ9Ik0xMC4yMTc2IDBMNC40NDM1MSA1Ljk0MzQ3TDEuNzgyNDMgMy4xOTEzOUwwIDUuMDI2MTFMNC40NDM1MSA5LjZMMTIgMS44MzQ3MkwxMC4yMTc2IDBaIiBmaWxsPSJ3aGl0ZSIvPgo8L2c+CjxkZWZzPgo8Y2xpcFBhdGggaWQ9ImNsaXAwIj4KPHJlY3Qgd2lkdGg9IjEyIiBoZWlnaHQ9IjkuNiIgZmlsbD0id2hpdGUiLz4KPC9jbGlwUGF0aD4KPC9kZWZzPgo8L3N2Zz4K);
            }
            &.--complaint {
                background-color: $red;
                background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAxNiAxNiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEzLjM3MzYgNC4zMDc3QzEzLjg4MzQgNC4zMDc3IDE0LjI5NjcgMy44OTQ0MyAxNC4yOTY3IDMuMzg0NjJDMTQuMjk2NyAyLjg3NDgyIDEzLjg4MzQgMi40NjE1NSAxMy4zNzM2IDIuNDYxNTVDMTIuODYzOCAyLjQ2MTU1IDEyLjQ1MDUgMi44NzQ4MiAxMi40NTA1IDMuMzg0NjJDMTIuNDUwNSAzLjg5NDQzIDEyLjg2MzggNC4zMDc3IDEzLjM3MzYgNC4zMDc3WiIgZmlsbD0id2hpdGUiLz4KPHBhdGggZD0iTTEwLjkxMiAyLjQ2MTUxQzExLjQyMTggMi40NjE1MSAxMS44MzUxIDIuMDQ4MjMgMTEuODM1MSAxLjUzODQzQzExLjgzNTEgMS4wMjg2MyAxMS40MjE4IDAuNjE1MzU2IDEwLjkxMiAwLjYxNTM1NkMxMC40MDIyIDAuNjE1MzU2IDkuOTg4OTUgMS4wMjg2MyA5Ljk4ODk1IDEuNTM4NDNDOS45ODg5NSAyLjA0ODIzIDEwLjQwMjIgMi40NjE1MSAxMC45MTIgMi40NjE1MVoiIGZpbGw9IndoaXRlIi8+CjxwYXRoIGQ9Ik04LjQ1MDQ4IDEuODQ2MTVDOC45NjAyOCAxLjg0NjE1IDkuMzczNTYgMS40MzI4OCA5LjM3MzU2IDAuOTIzMDc3QzkuMzczNTYgMC40MTMyNzYgOC45NjAyOCAwIDguNDUwNDggMEM3Ljk0MDY4IDAgNy41Mjc0IDAuNDEzMjc2IDcuNTI3NCAwLjkyMzA3N0M3LjUyNzQgMS40MzI4OCA3Ljk0MDY4IDEuODQ2MTUgOC40NTA0OCAxLjg0NjE1WiIgZmlsbD0id2hpdGUiLz4KPHBhdGggZD0iTTUuOTg4OTMgMy4wNzY4N0M2LjQ5ODc0IDMuMDc2ODcgNi45MTIwMSAyLjY2MzU5IDYuOTEyMDEgMi4xNTM3OUM2LjkxMjAxIDEuNjQzOTkgNi40OTg3NCAxLjIzMDcxIDUuOTg4OTMgMS4yMzA3MUM1LjQ3OTEzIDEuMjMwNzEgNS4wNjU4NiAxLjY0Mzk5IDUuMDY1ODYgMi4xNTM3OUM1LjA2NTg2IDIuNjYzNTkgNS40NzkxMyAzLjA3Njg3IDUuOTg4OTMgMy4wNzY4N1oiIGZpbGw9IndoaXRlIi8+CjxwYXRoIGQ9Ik0xMi40NTA1IDMuMzg0NjNWNy4zODQ2M0MxMi40NTA1IDcuNTU0NDggMTIuMzEyNiA3LjY5MjMzIDEyLjE0MjggNy42OTIzM0MxMS45NzI5IDcuNjkyMzMgMTEuODM1MSA3LjU1NDQ4IDExLjgzNTEgNy4zODQ2M1YxLjUzODQ4SDkuOTg4OTNWNi43NjkyNUM5Ljk4ODkzIDYuOTM5MSA5Ljg1MTA5IDcuMDc2OTQgOS42ODEyNCA3LjA3Njk0QzkuNTExMzkgNy4wNzY5NCA5LjM3MzU1IDYuOTM5MSA5LjM3MzU1IDYuNzY5MjVWMC45MjMwOTZINy41Mjc0VjYuNzY5MjVDNy41Mjc0IDYuOTM5MSA3LjM4OTU1IDcuMDc2OTQgNy4yMTk3IDcuMDc2OTRDNy4wNDk4NiA3LjA3Njk0IDYuOTEyMDEgNi45MzkxIDYuOTEyMDEgNi43NjkyNVYyLjE1Mzg2SDUuMDY1ODZWOS44NDYxN0wzLjgxOTcgOC4xNDA5NEMzLjQ1MDQ3IDcuNTcxNzEgMi43Mjk4NiA3LjM4MDk0IDIuMjAxODYgNy43MDcxQzEuNjc1NyA4LjA0MDYzIDEuNTQ1MjQgOC43NjgwMiAxLjkwOTU1IDkuMzM1NEMxLjkwOTU1IDkuMzM1NCAzLjkxOTQgMTIuMzc3MiA0Ljc3NjAxIDEzLjY3OTRDNS42MzI2MyAxNC45ODE2IDcuMDIwMzIgMTYgOS42MTUzOSAxNkMxMy45MTIgMTYgMTQuMjk2NiAxMi42ODE5IDE0LjI5NjYgMTEuNjkyM0MxNC4yOTY2IDEwLjcwMjggMTQuMjk2NiAzLjM4NDYzIDE0LjI5NjYgMy4zODQ2M0gxMi40NTA1WiIgZmlsbD0id2hpdGUiLz4KPC9zdmc+Cg==);
            }
            &-b {
                padding: 150px 0 0;
                font-size: 0;
            }
        }
        &__content {
            padding: 33px 40px 20px;
        }
        &__close {
            width: 20px;
            height: 20px;
            position: absolute;
            top: 20px;
            right: 20px;
            background: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjEiIGhlaWdodD0iMjAiIHZpZXdCb3g9IjAgMCAyMSAyMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0yMC45NzA2IDMuMzMzMzRMMTQuMzAzOSAxMEwyMC45NzA2IDE2LjY2NjdMMTcuNjM3MiAyMEwxMC45NzA2IDEzLjMzMzNMNC4zMDM5MSAyMEwwLjk3MDU4MSAxNi42NjY3TDcuNjM3MjUgMTBMMC45NzA1ODEgMy4zMzMzM0w0LjMwMzkxIDBMMTAuOTcwNiA2LjY2NjY3TDE3LjYzNzIgMy45NDYyN2UtMDZMMjAuOTcwNiAzLjMzMzM0WiIgZmlsbD0iIzdCOTVBNyIvPgo8L3N2Zz4K) center no-repeat;
            -webkit-transition: opacity 0.3s;
            -moz-transition: opacity 0.3s;
            -ms-transition: opacity 0.3s;
            -o-transition: opacity 0.3s;
            transition: opacity 0.3s;
            &:hover {
                opacity: 0.7;
            }
        }
        &__address {
            margin: 16px 0 0;
            line-height: 20px;
            &-link {
                display: inline-block;
                margin: 0 0 0 20px;
                color:#5B6067;
                -webkit-transition: opacity 0.3s;
                -moz-transition: opacity 0.3s;
                -ms-transition: opacity 0.3s;
                -o-transition: opacity 0.3s;
                transition: opacity 0.3s;
                &:hover {
                    opacity: 0.7;
                }
            }
        }
        &__title {
            font-size: 32px;
            line-height: 40px;
            margin: 28px 0 16px;
        }
        &__top {
            position: relative;
            padding: 30px 40px 26px;
        }
        &__tab {
            &-link {
                &-b {
                    position: relative;
                    font-size: 0;
                    &:after {
                        position: absolute;
                        display: block;
                        content: '';
                        height: 1px;
                        left: 0;
                        right: 0;
                        bottom: 0;
                        background: #7B95A7;
                    }
                }
                display: inline-block;
                vertical-align: top;
                font-size: 16px;
                line-height: 20px;
                padding: 0 0 16px;
                position: relative;
                color: #333;
                margin: 0 0 0 40px;
                &:after {
                    content: '';
                    background: transparent;
                    height: 3px;
                    position: absolute;
                    display: block;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    z-index: 1;
                    -webkit-transition: background 0.3s;
                    -moz-transition: background 0.3s;
                    -ms-transition: background 0.3s;
                    -o-transition: background 0.3s;
                    transition: background 0.3s;
                }
                &:first-child {
                    margin: 0;
                }
                &.active, &:hover {
                    font-weight: 700;
                    &:after {
                        background: $blue;
                    }
                }
            }
            &-content {
                display: none;
                &-b {
                    padding: 20px 0 0;
                }
                &.active {
                    display: block;
                }
                .text {
                    font-size: 16px;
                    line-height: 30px;
                    &__verification {
                        font-size: 14px;
                        line-height: 20px;
                        margin: 20px 0 0;
                        color: #5B6067;
                    }
                }
            }
            &-num {
                display: block;
                padding: 0 0 0 2px;
                font-size: 10px;
                line-height: 10px;
                position: absolute;
                left: 100%;
                top: 0;
                color: #333;
            }
        }
        &__breadcrumb {
            display: inline-block;
            font-size: 16px;
            line-height: 20px;
            vertical-align: middle;
            -webkit-transition: opacity 0.3s;
            -moz-transition: opacity 0.3s;
            -ms-transition: opacity 0.3s;
            -o-transition: opacity 0.3s;
            transition: opacity 0.3s;
            color: #5B6067;
            &:hover {
                opacity: 0.7;
            }
            &:before {
                content: '>';
                display: inline-block;
                vertical-align: middle;
                margin: 0 9px;
            }
            &:first-child {
                &:before {
                    display: none;
                }
            }
            &-list {
                padding: 0 0 0 9px;
            }
            &-b {
                display: flex;
                align-items: center;
                margin: 0 0 28px;
            }
            &-icon {
                width: 30px;
                height: 30px;
                background-color: #FF5F5F;
                background-position: center;
                background-repeat: no-repeat;
                &.--drink {
                    background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAxNiAxNiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTUuMzAxOTIgOC45MjkzOEM1LjA1Mzk3IDguOTI5MzggNC44NTI5NyA5LjEzMDM4IDQuODUyOTcgOS4zNzgzNFYxMi45MDI0QzQuODUyOTcgMTMuMTUwNCA1LjA1Mzk3IDEzLjM1MTQgNS4zMDE5MiAxMy4zNTE0QzUuNTQ5ODggMTMuMzUxNCA1Ljc1MDg4IDEzLjE1MDQgNS43NTA4OCAxMi45MDI0VjkuMzc4MzRDNS43NTA4OCA5LjEzMDM4IDUuNTQ5ODggOC45MjkzOCA1LjMwMTkyIDguOTI5MzhaIiBmaWxsPSJ3aGl0ZSIvPgo8cGF0aCBkPSJNOC42OTg2NSA4LjkyOTM4QzguNDUwNjkgOC45MjkzOCA4LjI0OTY5IDkuMTMwMzggOC4yNDk2OSA5LjM3ODM0VjEyLjkwMjRDOC4yNDk2OSAxMy4xNTA0IDguNDUwNjkgMTMuMzUxNCA4LjY5ODY1IDEzLjM1MTRDOC45NDY2MiAxMy4zNTE0IDkuMTQ3NjEgMTMuMTUwNCA5LjE0NzYxIDEyLjkwMjRWOS4zNzgzNEM5LjE0NzYxIDkuMTMwMzggOC45NDY2MiA4LjkyOTM4IDguNjk4NjUgOC45MjkzOFoiIGZpbGw9IndoaXRlIi8+CjxwYXRoIGQ9Ik0xMi41OTMgNS41NjExNEgxMi4wNzMyVjUuMDUwMTNDMTIuMjcyNyA0LjcyMDU1IDEyLjM4NzcgNC4zMzQ0IDEyLjM4NzcgMy45MjE4QzEyLjM4NzcgMi44MDk4MiAxMS41NTI5IDEuODg5MTggMTAuNDc3MSAxLjc1MzY0QzEwLjI3NjEgMC43NTQ2NTcgOS4zOTE4MiAwIDguMzM0NjEgMEM3LjcyMDEyIDAgNy4xNDQ2NCAwLjI1NTE0NCA2LjczNDc4IDAuNjk2Njk3QzYuNTI0ODEgMC42MzEzNzMgNi4zMDQ5IDAuNTk3NTIxIDYuMDg0NjkgMC41OTc1MjFDNS4yNjcyMiAwLjU5NzUyMSA0LjUyNDA2IDEuMDYwODUgNC4xNTEzOCAxLjc2NTA0QzQuMDM1MSAxLjc0NjAxIDMuOTE3MTEgMS43MzY0NCAzLjc5ODA1IDEuNzM2NDRDMi41OTMwNCAxLjczNjQ0IDEuNjEyNzMgMi43MTY3OSAxLjYxMjczIDMuOTIxOEMxLjYxMjczIDQuMzM0NCAxLjcyNzc2IDQuNzIwNTUgMS45MjcyNyA1LjA1MDEzVjEzLjMwNjJDMS45MjcyNyAxNC43OTE2IDMuMTM1NjkgMTYgNC42MjEwMyAxNkg5LjM3OTQ4QzEwLjc1MDkgMTYgMTEuODg1NCAxNC45Njk2IDEyLjA1MTUgMTMuNjQyNEgxMi41OTNDMTMuNTgyMyAxMy42NDI0IDE0LjM4NzEgMTIuODM3NiAxNC4zODcxIDExLjg0ODJWNy4zNTUzNkMxNC4zODcyIDYuMzY2MDMgMTMuNTgyMyA1LjU2MTE0IDEyLjU5MyA1LjU2MTE0Wk0zLjc5ODA1IDIuNjM0MzZDMy45NTU2MyAyLjYzNDM2IDQuMTEwMDMgMi42NjI3OCA0LjI1Njk3IDIuNzE4ODZDNC4zNzQyNCAyLjc2MzYyIDQuNTA0ODkgMi43NTcyIDQuNjE3MjYgMi43MDEyMUM0LjcyOTU5IDIuNjQ1MjMgNC44MTM0MSAyLjU0NDc1IDQuODQ4MyAyLjQyNDIxQzUuMDA2NTEgMS44NzczNyA1LjUxNDk2IDEuNDk1NDQgNi4wODQ2OSAxLjQ5NTQ0QzYuMjkxNzUgMS40OTU0NCA2LjQ4OTc5IDEuNTQzNDQgNi42NzMzNyAxLjYzODA4QzYuODc4MTQgMS43NDM1OCA3LjEyOTU2IDEuNjc3MDkgNy4yNTUyNiAxLjQ4NDA0QzcuNDk0MzQgMS4xMTcwMSA3Ljg5NzgyIDAuODk3OTIgOC4zMzQ2MSAwLjg5NzkyQzkuMDQyODkgMC44OTc5MiA5LjYxOTQgMS40NzI5IDkuNjIyIDIuMTgwNkM5LjYyMTkxIDIuMTg0MjggOS42MjE4NyAyLjE4ODAxIDkuNjIxODcgMi4xOTA4OEM5LjYyMTg3IDIuMzE1ODMgOS42NzM5NSAyLjQzNTEyIDkuNzY1NTggMi41MjAxQzkuODU3MjEgMi42MDUwNSA5Ljk3OTk2IDIuNjQ4MDEgMTAuMTA0NyAyLjYzODU4QzEwLjE0MjEgMi42MzU3NiAxMC4xNzQgMi42MzQzNiAxMC4yMDI0IDIuNjM0MzZDMTAuOTEyMyAyLjYzNDM2IDExLjQ4OTggMy4yMTE5MSAxMS40ODk4IDMuOTIxOEMxMS40ODk4IDQuNjMxNyAxMC45MTIzIDUuMjA5MjQgMTAuMjAyNCA1LjIwOTI0SDYuMzkwNDhDNi4xNDI1MiA1LjIwOTI0IDUuOTQxNTIgNS40MTAyNCA1Ljk0MTUyIDUuNjU4MlY3LjMwNTIxQzUuOTQxNTIgNy41NTE2NSA1Ljc0MTA2IDcuNzUyMTEgNS40OTQ2NyA3Ljc1MjExQzUuMjQ4MjMgNy43NTIxMSA1LjA0NzczIDcuNTUxNjUgNS4wNDc3MyA3LjMwNTIxVjUuNjU4MkM1LjA0NzczIDUuNDEwMjQgNC44NDY3MyA1LjIwOTI0IDQuNTk4NzcgNS4yMDkyNEgzLjc5ODA1QzMuMDg4MTUgNS4yMDkyNCAyLjUxMDY1IDQuNjMxNyAyLjUxMDY1IDMuOTIxOEMyLjUxMDY1IDMuMjExOTEgMy4wODgxNSAyLjYzNDM2IDMuNzk4MDUgMi42MzQzNlpNMTEuMTc1MyAxMy4zMDYyQzExLjE3NTMgMTQuMjk2NSAxMC4zNjk3IDE1LjEwMjEgOS4zNzk0OCAxNS4xMDIxSDQuNjIwOTlDMy42MzA3NiAxNS4xMDIxIDIuODI1MTUgMTQuMjk2NSAyLjgyNTE1IDEzLjMwNjJWNS44Nzc4M0MzLjExODM3IDYuMDI0MjggMy40NDg2MiA2LjEwNzEyIDMuNzk4IDYuMTA3MTJINC4xNDk4MVY3LjMwNTE3QzQuMTQ5ODEgOC4wNDY3MSA0Ljc1MzEyIDguNjQ5OTggNS40OTQ2NyA4LjY0OTk4QzYuMjM2MTcgOC42NDk5OCA2LjgzOTQ0IDguMDQ2NjcgNi44Mzk0NCA3LjMwNTE3VjYuMTA3MTJIMTAuMjAyNEMxMC41NTE4IDYuMTA3MTIgMTAuODgyMSA2LjAyNDI0IDExLjE3NTMgNS44Nzc4M1YxMy4zMDYySDExLjE3NTNaTTEzLjQ4OTMgMTEuODQ4MkMxMy40ODkzIDEyLjM0MjUgMTMuMDg3MiAxMi43NDQ1IDEyLjU5MyAxMi43NDQ1SDEyLjA3MzJWNi40NTkwNkgxMi41OTNDMTMuMDg3MiA2LjQ1OTA2IDEzLjQ4OTMgNi44NjExNSAxMy40ODkzIDcuMzU1MzZWMTEuODQ4MloiIGZpbGw9IndoaXRlIi8+Cjwvc3ZnPgo=);
                }
            }
        }
        &__review {
            &-list {
                padding: 0;
                list-style: none;
            }
            &-item {
                margin: 34px 0 0;
                &:first-child {
                    margin: 14px 0 0;
                }
            }
            &-top {
                margin: 0 0 9px;
                font-size: 0;
            }
            &-title {
                font-size: 16px;
                line-height: 20px;
                font-weight: 700;
                display: inline-block;
                vertical-align: top;
            }
            &-date {
                color: #5B6067;
                display: inline-block;
                vertical-align: top;
                font-size: 14px;
                line-height: 20px;
                margin:  0 0 0 9px;
            }
            &-text {
                font-size: 16px;
                line-height: 30px;
                margin: 9px 0 0;
            }
        }
        &__history {
            &-list {
                padding: 0;
                list-style: none;
            }
            &-item {
                margin: 30px 0 0;
                padding: 0 0 0 100px;
                position: relative;
                &:first-child {
                    margin: 4px 0 0;
                }
            }
            &-text {
                font-size: 16px;
                line-height: 20px;
            }
            &-date {
                width: 100px;
                display: block;
                font-size: 14px;
                line-height: 20px;
                color: #5B6067;
                position: absolute;
                left: 0;
                top: 0;
            }
        }
        &__photo {
            margin: 17px 0 0;
            &:first-child {
                margin: 4px 0 0;
            }
            &-title {
                font-size: 16px;
                line-height: 20px;
                margin: 0 0 16px;
            }
        }
    }
</style>