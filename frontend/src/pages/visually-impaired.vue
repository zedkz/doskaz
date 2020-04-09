<template>
    <div class="vi" :class="{'--noto': fontFamily == 'Noto', '--black': colorTheme == 'black', '--sm': fontSize == 'sm', '--md': fontSize == 'md','--lrg': fontSize == 'lrg'}">
        <div class="vi-container">
            <ViHeader></ViHeader>
            <div class="vi__line">
                <div class="col">
                    <label class="vi__label --fcolor">Категория пользователя</label>
                    <div class="select">
                        <select class="--bcolor">
                            <option>Люди с нарушением опорно-двигательного аппарата</option>
                            <option>Люди с нарушением опорно-двигательного аппарата</option>
                            <option>Люди с нарушением опорно-двигательного аппарата</option>
                            <option>Люди с нарушением опорно-двигательного аппарата</option>
                        </select>
                    </div>
                </div>
                <div class="col --city">
                    <label class="vi__label --fcolor">Выберите город</label>
                    <div class="select">
                        <select class="--bcolor">
                            <option>Усть-Каменогорск</option>
                            <option>Петропавловск</option>
                            <option>Семей</option>
                            <option>Лисаковск</option>
                        </select>
                    </div>
                </div>
            </div>
            <h3 class="vi__title --fcolor">Поиск по сайту</h3>
            <div class="vi__input-b">
                <label class="vi__label">Выберите доступность объекта</label>
                <div class="vi__input-wrapper">
                    <input id="r1" type="checkbox" class="vi__input"><label for="r1">Доступно</label>

                    <input id="r2" type="checkbox" class="vi__input"><label for="r2">Частично доступно</label>

                    <input id="r3" type="checkbox" class="vi__input"><label for="r3">Недоступно</label>
                </div>
            </div>
            <div class="vi__line">
                <div class="col">
                    <label class="vi__label --fcolor">Категория объекта</label>
                    <div class="select">
                        <select class="--bcolor">
                            <option>Питание</option>
                            <option>Правильное питание</option>
                            <option>Здравоохранение</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <label class="vi__label --fcolor">подкатегория объекта</label>
                    <div class="select">
                        <select class="--bcolor">
                            <option>Усть-Каменогорск</option>
                            <option>Петропавловск</option>
                            <option>Семей</option>
                            <option>Лисаковск</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="vi__line">
                <div class="col --padding">
                    <label class="vi__label --fcolor">Для поиска объекта введите тип объекта, название или улицу и нажмите «Поиск»</label>
                    <div class="input --bcolor">
                        <input type="text">
                    </div>
                </div>
                <div class="col --padding --search">
                    <button type="button" class="vi-search-button --bcolor">Поиск</button>
                </div>
            </div>
            <div class="vi__complaint">
                <button type="button" class="vi__button">Добавить объект</button>
                <button type="button" class="vi__button">Подать жалобу</button>
            </div>
           <ViFooter></ViFooter>
        </div>
    </div>
</template>

<script>
    import ViHeader from "./../components/ViHeader";
    import ViFooter from "./../components/ViFooter";
    import {eventBus} from "./../store/bus";
    export default {
        data() {
            return{
                fontSize: 'lrg',
                colorTheme: 'white',
                fontFamily: 'Lato'
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
            setFontSize(fsize) {
                console.log(fsize);
                this.fontSize = '' + fsize + '';
            },
            setColorTheme(ctheme) {
                console.log(ctheme);
                this.colorTheme = '' + ctheme + '';
            },
            setFontFamily(ff) {
                console.log(ff);
                this.fontFamily = '' + ff + '';
            }
        }
    }
</script>

<style lang="scss">

    .vi {
        font-family: 'Lato', sans-serif;
        background: #ffffff;
        input[type=checkbox].vi__input {
            display: none;
            & + label {
                padding: 0 0 0 60px;
                line-height: 40px;
                position: relative;
                cursor: pointer;
                &:before {
                    content: '';
                    width: 40px;
                    height: 40px;
                    border: 1px solid #000000;
                    top: 0;
                    left: 0;
                    position: absolute;
                    -webkit-box-sizing: border-box;
                    -moz-box-sizing: border-box;
                    box-sizing: border-box;
                }
            }
            &:checked + label {
                &:before {
                    border-width: 3px;
                    background: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjIiIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAyMiAxNiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTIwIDJMNy42MjUgMTRMMiA4LjU0NTQ1IiBzdHJva2U9ImJsYWNrIiBzdHJva2Utd2lkdGg9IjMiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIvPgo8L3N2Zz4K') center no-repeat;
                 }
            }
        }

        &__complaint {
            margin: 120px 0 60px;
            .vi__button {
                margin: 0 40px 0 0;
                width: 290px;
                padding: 0;
            }
        }

        &__input {
            &-b {
                margin: 40px 0;
            }
            &-wrapper {
                display: flex;
                justify-content: flex-start;
                align-items: flex-start;
                input + label {
                    margin: 0 60px 0 0;
                }
            }
        }

        &__title {
            font-weight: bold;
            text-transform: uppercase;
        }

        &-search-button {
            width: 100%;
            height: 60px;
            background: #FFFFFF;
            border: 1px solid;
            text-transform: uppercase;
            display: block;
            border-left: none;
            line-height: 58px;
            cursor: pointer;
        }

        &__label {
            display: block;
            font-weight: 700;
            margin: 0 0 20px;
            line-height: 20px;
        }

        &__line {
            display: flex;
            margin: 50px 0 0;
            align-items: flex-end;
            & + .vi__title {
                margin: 72px 0 40px;
            }
            .col {
                -ms-flex-preferred-size: 0;
                flex-basis: 0;
                -ms-flex-positive: 1;
                -webkit-box-flex: 1;
                flex-grow: 1;
                &.--city {
                    max-width: 370px;
                    min-width: 370px;
                }
                &.--padding {
                    padding: 0 !important;
                }
                &.--search {
                    max-width: 150px;
                    min-width: 150px;
                }
                &:first-child {
                    padding: 0 20px 0 0;
                }
                &:last-child {
                    padding: 0 0 0 20px;
                }
            }
        }
    }

</style>