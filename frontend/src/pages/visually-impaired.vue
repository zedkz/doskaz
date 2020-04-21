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
    }

</style>