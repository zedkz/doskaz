<template>
    <nuxt/>
</template>

<style lang="scss">
    @import "../styles/mixins.scss";

    //main styles
    * {
        outline: none;
        color: $black;
        -webkit-appearance: none;
        font-family: "Lato", sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        box-sizing: border-box;
    }

    @font-face {
        font-family: 'Lato';
        src: url('../styles/fonts/Lato-Regular.eot');
        src: url('../styles/fonts/Lato-Regular.eot?#iefix') format('embedded-opentype'),
        url('../styles/fonts/Lato-Regular.woff2') format('woff2'),
        url('../styles/fonts/Lato-Regular.woff') format('woff'),
        url('../styles/fonts/Lato-Regular.ttf') format('truetype');
        font-weight: 400;
        font-style: normal;
    }


    @font-face {
        font-family: 'Lato';
        src: url('../styles/fonts/Lato-Bold.eot');
        src: url('../styles/fonts/Lato-Bold.eot?#iefix') format('embedded-opentype'),
        url('../styles/fonts/Lato-Bold.woff2') format('woff2'),
        url('../styles/fonts/Lato-Bold.woff') format('woff'),
        url('../styles/fonts/Lato-Bold.ttf') format('truetype');
        font-weight: 700;
        font-style: normal;
    }

    @font-face {
        font-family: 'Lato';
        src: url('../styles/fonts/Lato-Semibold.eot');
        src: url('../styles/fonts/Lato-Semibold.eot?#iefix') format('embedded-opentype'),
        url('../styles/fonts/Lato-Semibold.woff2') format('woff2'),
        url('../styles/fonts/Lato-Semibold.woff') format('woff'),
        url('../styles/fonts/Lato-Semibold.ttf') format('truetype');
        font-weight: 600;
        font-style: normal;
    }

    @font-face {
        font-family: 'Lato';
        src: url('../styles/fonts/Lato-Black.eot');
        src: url('../styles/fonts/Lato-Black.eot?#iefix') format('embedded-opentype'),
        url('../styles/fonts/Lato-Black.woff2') format('woff2'),
        url('../styles/fonts/Lato-Black.woff') format('woff'),
        url('../styles/fonts/Lato-Black.ttf') format('truetype');
        font-weight: 900;
        font-style: normal;
    }

    @font-face {
        font-family: 'Lato';
        src: url('../styles/fonts/Lato-Light.eot');
        src: url('../styles/fonts/Lato-Light.eot?#iefix') format('embedded-opentype'),
        url('../styles/fonts/Lato-Light.woff2') format('woff2'),
        url('../styles/fonts/Lato-Light.woff') format('woff'),
        url('../styles/fonts/Lato-Light.ttf') format('truetype');
        font-weight: 300;
        font-style: normal;
    }

    @font-face {
        font-family: 'Lato';
        src: url('../styles/fonts/Lato-Thin.eot');
        src: url('../styles/fonts/Lato-Thin.eot?#iefix') format('embedded-opentype'),
        url('../styles/fonts/Lato-Thin.woff2') format('woff2'),
        url('../styles/fonts/Lato-Thin.woff') format('woff'),
        url('../styles/fonts/Lato-Thin.ttf') format('truetype');
        font-weight: 100;
        font-style: normal;
    }

    @font-face {
        font-family: 'Lato';
        src: url('../styles/fonts/Lato-Medium.eot');
        src: url('../styles/fonts/Lato-Medium.eot?#iefix') format('embedded-opentype'),
        url('../styles/fonts/Lato-Medium.woff2') format('woff2'),
        url('../styles/fonts/Lato-Medium.woff') format('woff');
        font-weight: 500;
        font-style: normal;
    }

    h3 {
        font-weight: bold;
        font-size: 22px;
        line-height: 30px;
        color: $black;
        margin: 0;
    }

    h1 {
        font-weight: bold;
        font-size: 32px;
        line-height: 40px;
        color: $black;
        margin: 0;
    }

    p {
        font-size: 16px;
        line-height: 30px;
        color: $black;
        margin: 0;
    }

    a {
        text-decoration: none;
    }

    .spacer {
        flex: 1 0 auto;
    }

    .button {
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
        &[disabled] {
            background: $text;
            cursor: default;
            &:hover {
                opacity: 1;
            }
        }
    }

    .select {
        height: 50px;
        position: relative;

        &:after {
            content: '';
            position: absolute;
            width: 0;
            height: 0;
            top: 23px;
            right: 20px;
            border-top: 5px solid #7B95A7;
            border-right: 5px solid transparent;
            border-left: 5px solid transparent;
        }

        select {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #5B6067;
            padding: 0 40px 0 20px;
            font-size: 18px;
            line-height: 20px;
            height: 100%;
            display: block;
            border: 1px solid #7b95a7;
            width: 100%;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            -ms-appearance: none;

            option {
                width: 100%;
            }
        }
    }

    .input {
        border: 1px solid #7b95a7;
        height: 50px;
        display: flex;
        flex: 1 0 auto;
        justify-content: space-between;
        align-items: center;
        padding: 0 10px 0 20px;
        background: #FFFFFF;
        @media all and (max-width: 1200px) {
            height: 40px;
        }

        &.--date {
            input {
                background: transparent;
            }

            background: url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAxNiAxNiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGcgY2xpcC1wYXRoPSJ1cmwoI2NsaXAwKSI+CjxwYXRoIGQ9Ik0xMy40NDQ0IDNIMi41NTU1NkMxLjY5NjQ1IDMgMSAzLjU5Njk1IDEgNC4zMzMzM1YxMy42NjY3QzEgMTQuNDAzIDEuNjk2NDUgMTUgMi41NTU1NiAxNUgxMy40NDQ0QzE0LjMwMzYgMTUgMTUgMTQuNDAzIDE1IDEzLjY2NjdWNC4zMzMzM0MxNSAzLjU5Njk1IDE0LjMwMzYgMyAxMy40NDQ0IDNaIiBzdHJva2U9IiM3Qjk1QTciIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+CjxwYXRoIGQ9Ik0xMSAxVjQiIHN0cm9rZT0iIzdCOTVBNyIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiLz4KPHBhdGggZD0iTTUgMVY0IiBzdHJva2U9IiM3Qjk1QTciIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+CjxwYXRoIGQ9Ik0wLjc5OTgwNSA3LjJIMTUuMTk5OCIgc3Ryb2tlPSIjN0I5NUE3IiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIvPgo8L2c+CjxkZWZzPgo8Y2xpcFBhdGggaWQ9ImNsaXAwIj4KPHJlY3Qgd2lkdGg9IjE2IiBoZWlnaHQ9IjE2IiBmaWxsPSJ3aGl0ZSIvPgo8L2NsaXBQYXRoPgo8L2RlZnM+Cjwvc3ZnPgo=") right 10px center no-repeat;
        }
        &.--search {
            padding: 0 54px 0 20px;
            position: relative;
            background: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTIzLjMzOTcgMjAuMTUxOUwxOS4zNjE3IDE2LjE3NDZDMjAuNDEwMSAxNC41Mzg1IDIxLjAzNiAxMi42MDUzIDIxLjAzNiAxMC41MTc5QzIxLjAzNiA0LjcwODc0IDE2LjMyNzIgMCAxMC41MTggMEM0LjcwOTQ0IDAgMCA0LjcwODc0IDAgMTAuNTE4QzAgMTYuMzI3MyA0LjcwOTQ0IDIxLjAzNiAxMC41MTggMjEuMDM2QzEyLjYwNTMgMjEuMDM2IDE0LjUzODUgMjAuNDEwMSAxNi4xNzM5IDE5LjM2MTdMMjAuMTUxOCAyMy4zMzk3QzIxLjAzMjIgMjQuMjIwMSAyMi40NTkzIDI0LjIyMDEgMjMuMzM5NyAyMy4zMzk3QzI0LjIyMDEgMjIuNDU5MyAyNC4yMjAxIDIxLjAzMjMgMjMuMzM5NyAyMC4xNTE5Wk0xMC41MTggMTguMDMwOUM2LjM2OSAxOC4wMzA5IDMuMDA1MTEgMTQuNjY3NyAzLjAwNTExIDEwLjUxOEMzLjAwNTExIDYuMzY5MDUgNi4zNjkwNSAzLjAwNTE2IDEwLjUxOCAzLjAwNTE2QzE0LjY2NzYgMy4wMDUxNiAxOC4wMzA4IDYuMzY5MDUgMTguMDMwOCAxMC41MThDMTguMDMwOCAxNC42Njc3IDE0LjY2NzYgMTguMDMwOSAxMC41MTggMTguMDMwOVoiIGZpbGw9IiM1QjYwNjciLz4KPC9zdmc+Cg==') right 20px center no-repeat;
        }

        input {
            border: none;
            font-size: 18px;
            line-height: 20px;
            color: #333333;
            height: 100%;
            display: block;
            width: 100%;
        }

        button {
            background: $tr;
            border: none;
            cursor: pointer;
        }
    }

    .select-text {
        display: inline-block;
        position: relative;
        padding: 0 20px 0 0;
        &:after {
            position: absolute;
            right: 0;
            top: 18px;
            content: '';
            border-top: 5px solid $black;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
        }
        select {
            display: block;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            -ms-appearance: none;
            border: none;
            font-weight: 700;
            font-size: 32px;
            line-height: 40px;
            border-bottom: 1px dashed;
            background: transparent;
        }
    }

    .textarea {
        height: auto;
        min-height: 80px;
        border: 1px solid #7b95a7;
        padding: 14px 20px;
        font-size: 16px;
        line-height: 20px;
        color: #5B6067;
        width: 100%;
        font-family: "Lato", Helvetica, Arial, sans-serif;
    }

    .label {
        font-weight: bold;
        font-size: 16px;
        line-height: 20px;
        display: block;
    }

    .checkbox {
        input[type=checkbox] {
            display: none;

            & + label {
                cursor: pointer;
                display: block;
                font-size: 16px;
                line-height: 25px;
                padding: 0 0 0 26px;
                position: relative;
                background: url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAxNiAxNiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3QgeD0iMC41IiB5PSIwLjUiIHdpZHRoPSIxNSIgaGVpZ2h0PSIxNSIgZmlsbD0id2hpdGUiIHN0cm9rZT0iIzdCOTVBNyIvPgo8L3N2Zz4K") left top 4px no-repeat;
                background-size: 16px;
            }

            &:checked + label {
                background: url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAxNiAxNiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjE2IiBoZWlnaHQ9IjE2IiBmaWxsPSIjMEY2QkY1Ii8+CjxwYXRoIGQ9Ik0xMS41MTQ2IDRMNi43MDI5MyA4Ljk1Mjg5TDQuNDg1MzYgNi42NTk0OUwzIDguMTg4NDNMNi43MDI5MyAxMkwxMyA1LjUyODk0TDExLjUxNDYgNFoiIGZpbGw9IndoaXRlIi8+Cjwvc3ZnPgo=") left top 4px no-repeat;
            }
        }
    }

    .add-link {
        font-size: 14px;
        line-height: 20px;
        border: none;
        outline: none;
        background: transparent;
        cursor: pointer;
        color: #5B6067;
        padding: 0;
        border-bottom: 1px dashed #5B6067;
    }

    .title {
        font-weight: 600;
        font-size: 48px;
        line-height: 50px;
        margin: 0;
        color: $black;
        @media all and (max-width: 1023px) {
            font-size: 32px;
            line-height: 40px;
        }
        @media all and (max-width: 768px) {
            font-size: 18px;
            line-height: 20px;
        }
        &.--md {
            font-size: 32px;
            line-height: 40px;
        }

        &.--small {
            font-size: 22px;
            line-height: 30px;
            font-weight: 700;
        }
    }

    .photo-input {
        width: 80px;
        height: 80px;
        border: 1px solid #7b95a7;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        position: relative;
        background: url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjUiIGhlaWdodD0iMjUiIHZpZXdCb3g9IjAgMCAyNSAyNSIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTI0LjU1NTcgMTAuMDQ5N0gxNS4wNjE1VjAuNTU1NTQySDEwLjA0OThWMTAuMDQ5N0gwLjU1NTY2NFYxNS4wNjE0SDEwLjA0OThWMjQuNTU1NUgxNS4wNjE1VjE1LjA2MTRIMjQuNTU1N1YxMC4wNDk3WiIgZmlsbD0iIzdCOTVBNyIvPgo8L3N2Zz4K") center no-repeat;
        background-size: 24px;
        margin: 0 30px 30px 0;
        display: inline-block;

        &__wrapper {
            font-size: 0;
            margin: 0 0 -30px;
        }

        span {
            display: block;
            width: 100%;
            height: 100%;
            position: relative;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0 auto;
            z-index: 1;
        }

        input {
            cursor: pointer;
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            z-index: 2;
        }
    }

    .popup {
        &__wrapper {
            position: fixed;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            .select {
                margin: 34px 0 40px;
                select {
                    font-size: 16px;
                }
            }
        }
        &__in {
            text-align: center;
            background: #ffffff;
            width: 540px;
            padding: 46px 60px 60px;
            position: relative;
            &.--md {
                width: 580px;
            }
            &.--sm {
                padding: 46px 40px 40px;
            }
        }
        &__title {
            font-size: 22px;
            line-height: 30px;
            margin: 0 0 28px;
        }
        &__text {
            text-align: center;
            font-size: 16px;
            line-height: 20px;
            padding: 0 5px;
            & + .user-page__button {
                margin-top: 36px;
            }
        }
        &__close {
            position: absolute;
            top: -10px;
            cursor: pointer;
            width: 40px;
            height: 40px;
            right: -50px;
            background: url('data:image/svg+xml;base64, PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHZpZXdCb3g9IjAgMCAyMCAyMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xNi42NjY3IDQuMDA4ZS0wNkwyMCAzLjMzMzM0TDEzLjMzMzMgMTBMMjAgMTYuNjY2N0wxNi42NjY3IDIwTDEwIDEzLjMzMzNMMy4zMzMzMyAyMEwwIDE2LjY2NjdMNi42NjY2NyAxMEwwIDMuMzMzMzNMMy4zMzMzMyAwTDEwIDYuNjY2NjdMMTYuNjY2NyA0LjAwOGUtMDZaIiBmaWxsPSJ3aGl0ZSIvPgo8L3N2Zz4K') no-repeat center;
            background-size: 20px;
            -webkit-transition: opacity 0.3s;
            -moz-transition: opacity 0.3s;
            -ms-transition: opacity 0.3s;
            -o-transition: opacity 0.3s;
            transition: opacity 0.3s;
            &:hover {
             opacity: 0.7;
         }
        }
        &__new-level {
             height: 300px;
             width: 294px;
             margin: 36px auto 0;
         }
        &__new-points {
             width: 200px;
             height: 200px;
             border-radius: 50%;
             font-weight: bold;
             font-size: 96px;
             text-align: center;
             line-height: 200px;
             background: $light-blue;
             margin: 36px auto 0;
        }
        &__award {
            &-b {

             }
            &-wrapper {
                 margin: 34px 0;
             }
            &-icon {
                 width: 80px;
                 height: 80px;
                 margin: 0 auto 5px;
             }
            &-list {
                 padding: 0 8px;
                 display: flex;
                 justify-content: space-between;
             }
        }
        &__buttons {
            margin: 36px 0 0;
            font-size: 0;
            text-align: center;
            display: flex;
            justify-content: space-between;
        }
        &__button {
            cursor: pointer;
            width: 210px;
            padding: 14px 0 16px 66px;
            border: none;
            outline: none;
            font-size: 0;
            text-align: left;
            transition: opacity 0.4s;
            &:hover {
                opacity: 0.7
            }
            svg {
                display: inline-block;
                vertical-align: middle;
            }
            span {
                display: inline-block;
                color: #FFFFFF;
                font-size: 16px;
                line-height: 20px;
                vertical-align: middle;
                margin: 0 0 0 10px;
            }
            &.--no {
                background: $red;
            }
            &.--yes {
                background: $green;
            }
            &:first-child {
                margin: 0;
            }
        }
        &__textarea {
            min-height: 200px;
            display: block;
            &-text {
                text-align: left;
                color: #7B95A7;
                margin: 15px 0 35px;
                display: block;
                font-size: 14px;
                line-height: 20px;
            }
        }
    }

    .container {
        width: 100%;
        max-width: 1200px;
        padding: 0 20px;
        margin: 0 auto;
    }
</style>
