<template>
    <div class="vi-header">
        <div class="vi-header__top --bcolor">
            <div class="vi-set-b">
                <div class="vi-set">
                    <span class="vi-set__title --fcolor">Размер шрифта</span>
                    <div class="vi-set__link-wrapper">
                        <span class="vi-set__link --fs --sm  --bcolor --fcolor" :class="{'--active': fontSize == 'sm'}" @click="setFontSize('sm')">A</span>
                        <span class="vi-set__link --fs --md  --bcolor --fcolor" :class="{'--active': fontSize == 'md'}" @click="setFontSize('md')">A</span>
                        <span class="vi-set__link --fs --lrg --bcolor --fcolor" :class="{'--active': fontSize == 'lrg'}" @click="setFontSize('lrg')">A</span>
                    </div>
                </div>
                <div class="vi-set">
                    <span class="vi-set__title --fcolor">Цветовая схема</span>
                    <div class="vi-set__link-wrapper">
                        <span class="vi-set__link --ctheme --white --fcolor" :class="{'--active': colorTheme == 'white'}" @click="setColorTheme('white')">Ц</span>
                        <span class="vi-set__link --ctheme --black --bcolor --fcolor" :class="{'--active': colorTheme == 'black'}" @click="setColorTheme('black')">Ц</span>
                    </div>
                </div>
                <div class="vi-set">
                    <span class="vi-set__title --fcolor">Шрифт</span>
                    <div class="vi-set__link-wrapper">
                        <span class="vi-set__link --ff --btn --bcolor --fcolor" :class="{'--active': fontFamily == 'Lato'}" @click="setFontFamily('Lato')">Обычный</span>
                        <span class="vi-set__link --ff --noto --btn --bcolor --fcolor" :class="{'--active': fontFamily == 'Noto'}" @click="setFontFamily('Noto')">С засечками</span>
                    </div>
                </div>
            </div>
            <button class="vi-switch">
                <img :src="require('@/assets/visually-black.svg')" alt="" v-if="colorTheme == 'white'" />
                <img :src="require('@/assets/visually-white.svg')" alt="" v-if="colorTheme == 'black'" />
                <span class="--fcolor">Обычная версия сайта</span>
            </button>
        </div>
        <div class="vi-header__bottom --bcolor --fcolor">
            <a href="" class="vi__logo">
                <img :src="require('@/assets/logo-black.svg')" alt="" v-if="colorTheme == 'white'" />
                <img :src="require('@/assets/logo-white.svg')" alt="" v-if="colorTheme == 'black'" />
            </a>
            <div class="vi__auth-b">
                <a href="" class="vi__auth-link">Войти</a>
                <span class="vi__auth-or">или</span>
                <a href="" class="vi__auth-link">Зарегистрироваться</a>
                <span class="vi__auth-text"><b>Язык сайта</b></span>
                <div class="select">
                    <select>
                        <option>Казахский</option>
                        <option>Руский</option>
                        <option>English</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {eventBus} from "./../store/bus";

    export default {
        data() {
            return{
                fontSize: 'lrg',
                colorTheme: 'white',
                fontFamily: 'Lato'
            }
        },
        methods: {
            setFontSize(fsize) {
                this.fontSize = '' + fsize + '';
                eventBus.$emit('setFontSize',this.fontSize);
            },
            setColorTheme(ctheme) {
                this.colorTheme = '' + ctheme + '';
                eventBus.$emit('setColorTheme',this.colorTheme);
            },
            setFontFamily(ff) {
                this.fontFamily = '' + ff + '';
                eventBus.$emit('setFontFamily',this.fontFamily);
            }
        }
    }
</script>

<style lang="scss">

    .vi {
        .--fcolor {
            * {
                color: #000000;
            }
        }
        .--bcolor {
            border-color: #000000;
        }

        &.--lrg {
            * {
                font-size: 24px;
            }
            .vi {
                &-set {
                    &__title {
                        font-size: 22px
                    }
                    &__link {
                        &.--ctheme, &.--ff {
                            font-size: 22px;
                            &.--noto {
                                font-size: 21px;
                            }
                        }
                    }
                }
                &-switch {
                    span {
                        font-size: 22px;
                    }
                }
                &__title {
                    font-size: 40px;
                    line-height: 42px;
                }
            }
            .select {
                select {
                    font-size: 24px;
                    line-height: 26px;
                }
            }
        }
        &.--md {
            * {
                font-size: 21px;
            }
            .vi {
                &-set {
                    &__title {
                        font-size: 19px
                    }
                    &__link {
                        &.--ctheme, &.--ff {
                            font-size: 19px;
                            &.--noto {
                                font-size: 18px;
                            }
                        }
                    }
                }
                &-switch {
                    span {
                        font-size: 19px;
                    }
                }
                &__title {
                    font-size: 38px;
                    line-height: 42px;
                }
                &-object {
                    &__history-date {
                        font-size: 19px !important;
                    }
                    &__title {
                        font-size: 36px !important;
                    }
                    &__available {
                        &-title {
                            font-size: 36px !important;
                        }
                    }
                }
            }
            .select {
                select {
                    font-size: 21px;
                    line-height: 23px;
                }
            }
        }
        &.--sm {
            * {
                font-size: 18px;
            }
            .vi {
                &-set {
                    &__title {
                        font-size: 16px
                    }
                    &__link {
                        &.--ctheme, &.--ff {
                            font-size: 16px;
                            &.--noto {
                                font-size: 15px;
                            }
                        }
                    }
                }
                &-switch {
                    span {
                        font-size: 16px;
                    }
                }
                &__title {
                    font-size: 36px;
                    line-height: 42px;
                }
                &-object {
                    &__history-date {
                        font-size: 16px !important;
                    }
                    &__title {
                        font-size: 32px !important;
                    }
                    &__available {
                        &-title {
                            font-size: 32px !important;
                        }
                    }
                }
            }
            .select {
                select {
                    font-size: 18px;
                }
            }
        }
        &.--black {
             background: #000000;
            input[type=checkbox].vi__input {
                & + label {
                    &:before {
                        border: 1px solid #FFFFFF;
                    }
                }
                &:checked + label {
                    &:before {
                        background: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjIiIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAyMiAxNiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTIwIDJMNy42MjUgMTRMMiA4LjU0NTQ1IiBzdHJva2U9IndoaXRlIiBzdHJva2Utd2lkdGg9IjMiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIvPgo8L3N2Zz4K') center no-repeat;
                    }
                }
            }
            * {
                color: #FFFFFF;
            }
            .--fcolor {
                color: #FFFFFF;
            }
            .--bcolor {
                border-color: #FFFFFF;
            }
            .vi {
                &-set {
                    &__link {
                        &:hover, &.--active {
                            &:before {
                                border-top-color: #FFFFFF;
                            }
                            &:after {
                                border-top-color: #000000;
                            }
                        }
                        &.--ctheme.--white {
                            background: #FFFFFF;
                            color: #000000;
                        }
                    }
                }
                &__button {
                    background: #000000;
                    color: #FFFFFF;
                    border-color: #FFFFFF;
                    &:hover {
                        background: #FFFFFF;
                        color: #000000;
                        border-color: #000000;
                    }
                }
                &-object {
                    &__tab-link {
                        &-b {
                            &:after {
                                background: #FFFFFF;
                            }
                        }
                        &.--active {
                            border-color: #FFFFFF;
                            &:after {
                                background: #000000;
                            }
                        }
                    }
                }
            }
            .select {
                height: 60px;
                select {
                    color: #FFFFFF;
                    background: #000000;
                    height: 60px;
                }
                &:after {
                    border-top-color: #FFFFFF;
                }
            }
            .input {
                background: #000000;
                input {
                    color: #FFFFFF;
                    background: #000000;
                }
            }
            .vi-search-button {
                color: #FFFFFF;
                background: #000000;
            }
        }

        &.--noto {
            * {
                font-family: 'Noto Serif', serif;
            }
            .select {
                select {
                    line-height: 30px;
                }
            }
            &.--lrg {
                * {
                    font-size: 22px;
                }
                .vi {
                    &-set {
                        &__title {
                            font-size: 21px
                        }
                        &__link {
                            &.--ctheme, &.--ff {
                                font-size: 21px;
                            }
                        }
                    }
                    &-switch {
                        span {
                            font-size: 21px;
                        }
                    }
                    &__title {
                        font-size: 39px;
                        line-height: 42px;
                    }
                    &-object {
                        &__history-date {
                            font-size: 21px !important;
                        }
                        &__title {
                            font-size: 39px !important;
                        }
                        &__available {
                            &-title {
                                font-size: 39px !important;
                            }
                        }
                    }
                }
                .select {
                    select {
                        font-size: 23px;
                    }
                }
            }
            &.--md {
                * {
                    font-size: 20px;
                }
                .vi {
                    &-set {
                        &__title {
                            font-size: 18px
                        }
                        &__link {
                            &.--ctheme, &.--ff {
                                font-size: 18px;
                            }
                        }
                    }
                    &-switch {
                        span {
                            font-size: 18px;
                        }
                    }
                    &__title {
                        font-size: 37px;
                    }
                    &-object {
                        &__history-date {
                            font-size: 18px !important;
                        }
                        &__title {
                            font-size: 35px !important;
                        }
                        &__available {
                            &-title {
                                font-size: 35px !important;
                            }
                        }
                    }
                }
                .select {
                    select {
                        font-size: 20px;
                    }
                }
            }
            &.--sm {
                * {
                    font-size: 17px;
                }
                .vi {
                    &-set {
                        &__title {
                            font-size: 15px
                        }
                        &__link {
                            &.--ctheme, &.--ff {
                               font-size: 15px;
                            }
                        }
                    }
                    &-switch {
                        span {
                            font-size: 15px;
                        }
                    }
                    &__title {
                        font-size: 35px;
                    }
                    &-object {
                        &__history-date {
                            font-size: 15px !important;
                        }
                        &__title {
                            font-size: 31px !important;
                        }
                        &__available {
                            &-title {
                                font-size: 31px !important;
                            }
                        }
                    }
                }
                .select {
                    select {
                        font-size: 17px;
                    }
                }
            }
        }
        &-container {
            max-width: 1200px;
            padding: 0 20px;
            margin: 0 auto;
        }
        &-header {
            padding: 0;
            &__top {
                display: flex;
                justify-content: space-between;
                align-items: flex-end;
                padding: 20px 0 40px;
                border-bottom: 3px solid;
            }
            &__bottom {
                padding: 30px 0 34px;
                border-bottom: 2px solid;
                display: flex;
                justify-content: space-between;
            }
        }
        &-switch {
            border: none;
            display: flex;
            background: transparent;
            outline: none;
            align-items: center;
            margin: 0 0 16px;
            cursor: pointer;
            img {
                width: 30px;
            }
            span {
                line-height: 20px;
                margin: 0 0 0 10px;
            }
        }

        &__logo {
            width: 227px;
            display: block;
            img {
                display: block;
                width: 100%;
                height: auto;
            }
        }
        &__auth {
            &-b {
                display: flex;
                align-items: center;
                white-space: nowrap;
                .select {
                    max-width: 220px;
                    min-width: 220px;
                }
            }
            &-link {
                font-weight: 700;
            }
            &-text {
                margin: 0 20px 0 60px;
            }
            &-or {
                margin: 0 6px;
            }
        }
        &-set {
             text-align: left;
            &:first-child {
                width: 230px;
            }
            &:nth-child(2){
                width: 220px;
            }
            &-b {
                display: flex;
            }
            &__title {
                font-size: 22px;
                line-height: 20px;
                font-weight: 400;
                display: block;
                margin: 0 0 20px;
                color: inherit;
            }
            &__link {
                width: 50px;
                height: 50px;
                position: relative;
                margin: 0 0 0 10px;
                border: 1px solid;
                text-align: center;
                line-height: 48px;
                cursor: pointer;
                &-wrapper {
                    display: flex;
                }
                &.--active, &:hover {
                    border-width: 3px;
                    line-height: 44px;
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
                &.--btn {
                    width: 150px;
                    margin:  0 0 0 20px;
                    font-size: 22px;
                    font-family: 'Lato', sans-serif;
                    &.--noto {
                        width: 180px;
                        font-size: 21px;
                        font-family: 'Noto Serif', serif;
                    }
                }
                &.--fs {
                    &.--sm {
                        font-size: 16px;
                    }
                    &.--md {
                        font-size: 20px;
                    }
                    &.--lrg {
                        font-size: 26px;
                    }
                }
                &.--ctheme {
                    &.--black {
                        background: #000000;
                        color: #FFFFFF;
                    }
                }
                &:first-child {
                     margin: 0;
                }
                &-wrapper {
                    display: flex;
                }
            }
        }
        &__button {
            cursor: pointer;
            height: 60px;
            font-size: 24px;
            line-height: 60px;
            color: #000000;
            padding: 0 28px;
            border: 1px solid #000000;
            text-transform: uppercase;
            background: transparent;
            &:hover {
                background: #000000;
                color: #FFFFFF;
                border-color: #FFFFFF;
            }
        }
        .input {
            height: 60px;
            background: #ffffff;
            border: 1px solid;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 10px 0 20px;
            flex: 1 0 auto;
            input {
                color: #000000;
                background: #ffffff;
                height: 100%;
                display: block;
                width: 100%;
                outline: none;
                -webkit-box-shadow: none;
                -moz-box-shadow: none;
                box-shadow: none;
            }
        }
        .select {
            height: 60px;
            position: relative;
            width: 100%;
            select {
                border: 1px solid;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                padding: 0 40px 0 20px;
                line-height: 26px;
                height: 100%;
                display: block;
                width: 100%;
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                -ms-appearance: none;
                color: #000000;
                background: #FFFFFF;
            }
            &:after {
                content: '';
                position: absolute;
                width: 0;
                height: 0;
                top: 28px;
                right: 20px;
                border-top: 5px solid #000000;
                border-right: 5px solid transparent;
                border-left: 5px solid transparent;
            }
        }
    }

</style>
</style>