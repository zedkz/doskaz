<template>
    <div class="vi-top hidden" id="vi-top">
        <div class="vi-top__in">
            <div class="vi-top__item-b">
                <div class="vi-top__item">
                    <h5 class="vi-top__title">Размер шрифта</h5>
                    <div class="vi-top__link-wrapper">
                        <span class="vi-top__link --sm" :class="{'--active': fontSize === 'sm', '--ct-black' : colorTheme === 'black'}" @click="setFontSize('sm')">A</span>
                        <span class="vi-top__link --md" :class="{'--active': fontSize === 'md', '--ct-black' : colorTheme === 'black'}" @click="setFontSize('md')">A</span>
                        <span class="vi-top__link --lrg" :class="{'--active': fontSize === 'lrg', '--ct-black' : colorTheme === 'black'}" @click="setFontSize('lrg')">A</span>
                    </div>
                </div>
                <div class="vi-top__item">
                    <h5 class="vi-top__title">Цветовая схема</h5>
                    <div class="vi-top__link-wrapper">
                        <span class="vi-top__link --white" :class="{'--active': colorTheme === 'white', '--ct-black' : colorTheme === 'black'}" @click="setColorTheme('white')">Ц</span>
                        <span class="vi-top__link --black" :class="{'--active': colorTheme === 'black'}" @click="setColorTheme('black')">Ц</span>
                    </div>
                </div>
                <div class="vi-top__item">
                    <h5 class="vi-top__title">Шрифт</h5>
                    <div class="vi-top__link-wrapper">
                        <span class="vi-top__link --btn" :class="{'--active': fontFamily === 'lato', '--ct-black' : colorTheme === 'black'}" @click="setFontFamily('lato')">Обычный</span>
                        <span class="vi-top__link --noto --btn" :class="{'--active': fontFamily === 'noto', '--ct-black' : colorTheme === 'black'}" @click="setFontFamily('noto')">С засечками</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return{
                fontSize: '',
                colorTheme: '',
                fontFamily: ''
            }
        },
        methods: {
            setFontSize(fsize) {
                this.fontSize = '' + fsize + '';
                document.body.classList.remove('sm','md','lrg');
                document.body.classList.add('' + fsize + '')
            },
            setColorTheme(ctheme) {
                this.colorTheme = '' + ctheme + '';
                document.body.classList.remove("white","black");
                document.body.classList.add('' + ctheme + '');
            },
            setFontFamily(ff) {
                this.fontFamily = '' + ff + '';
                document.body.classList.remove("lato","noto");
                document.body.classList.add('' + ff + '');
            }
        }
    }
</script>

<style lang="scss">
    .vi-top {
        background: #E7E7E7;
        padding: 20px 0 40px;
        @media all and (max-width: 1200px) {
            padding: 20px 10px;
        }
        &.hidden {
            display: none;
        }
        &__in {
            max-width: 1160px;
            margin: 0 auto;
        }
        &__title {
            font-weight: 400;
            margin: 0 0 18px;
            font-size: 22px;
            line-height: 22px;
            &-link {
                font-size: 22px !important;
                line-height: 24px;
            }
            &-flex {
                margin: 34px 0 24px;
                align-items: center;
                display: flex;
                justify-content: space-between;
                & + .vi__line {
                    margin: 25px 0 0;
                }
            }
        }
        &__item {
            text-align: left;
            &:first-child {
                width: 230px;
            }
            &:nth-child(2){
                width: 220px;
                @media all and (max-width: 480px) {
                    width: 100%;
                    margin: 30px 0 0;
                }
                        }
            &:nth-child(3) {
                @media all and (max-width: 768px) {
                    width: 100%;
                    margin: 30px 0 0;
                }
            }
            &-b {
                display: flex;
                @media all and (max-width: 768px) {
                    flex-wrap: wrap;
                }
            }
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
            background: #ffffff;
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
            &.--sm {
                font-size: 16px;
            }
            &.--md {
                font-size: 20px;
            }
            &.--lrg {
                font-size: 26px;
            }
            &.--white {
                &.--ct-black {
                    background: #FFFFFF;
                    color: #000000;
                }
            }
            &.--black {
                background: #000000;
                color: #FFFFFF;
                border: none;
                &.--active, &:hover {
                    border: 3px solid #FFFFFF;
                    &:before {
                        border-top-color: #ffffff;
                    }
                    &:after {
                        border-top-color: #000000;
                    }
                }
            }
            &.--ct-black {
                &.--active, &:hover {
                    border: 3px solid #FFFFFF;
                    &:before {
                         border-top-color: #ffffff;
                     }
                    &:after {
                         border-top-color: #000000;
                     }
                }
            }
            &:first-child {
                margin: 0;
            }
        }
    }

    body {
        &.black {
            * { color: #FFFFFF }
            background: #000000;
            border-color: #FFFFFF;
            .vi-top {
                background: #000000;
                border-bottom: 1px solid #ffffff;
                &__title {
                    color: #FFFFFF;
                }
                &__link {
                    background: #000000;
                    border-color: #FFFFFF;
                    color: #FFFFFF;
                }
            }
            .title {
                color: #FFFFFF;
                span {
                    color: #FFFFFF;
                }
            }
            .button {
                border: 1px solid #FFFFFF;
                background-color: #000000;
            }
            .burger {
                &-line {
                    background: #FFFFFF;
                    &:before, &:after {
                        background: #FFFFFF;
                    }
                }
                &-close {
                    &__wrapper {
                        border-bottom-color: #FFFFFF;
                    }
                }
            }
            .select {
                select {
                    background: #000000;
                    border-color: #FFFFFF;
                }
                &-text {
                    select {
                        option {
                            background: #000000;
                            color: #FFFFFF;
                        }
                    }
                    &:after {
                        border-top-color: #FFFFFF;
                    }
                }
            }
            .input {
                border-color: #FFFFFF;
                background: #000000;
                input {
                    background: #000000;
                    color: #FFFFFF;
                }
                button {
                    svg {
                        path {
                            fill: #fff;
                        }
                    }
                }
            }
            .comment-form {
                textarea {
                    border-color: #FFFFFF;
                    background: #000000;
                    color: #FFFFFF;
                }
            }
            .textarea {
                border-color: #FFFFFF;
                background: #000000;
                color: #FFFFFF;
            }
            .represent {
                &__title {
                    color: #FFFFFF;
                }
                &__text {
                    color: #FFFFFF;
                }
            }
            .checkbox {
                input[type=checkbox] {
                    display: none;
                    & + label {
                        background: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNiIgaGVpZ2h0PSIxNiIgdmlld0JveD0iMCAwIDE2IDE2IiBmaWxsPSJub25lIj4NCgk8cmVjdCB4PSIwLjUiIHk9IjAuNSIgd2lkdGg9IjE1IiBoZWlnaHQ9IjE1IiBmaWxsPSJibGFjayIgc3Ryb2tlPSJ3aGl0ZSIvPg0KPC9zdmc+") left top 4px no-repeat;
                        background-size: 16px;
                    }

                    &:checked + label {
                        background: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNiIgaGVpZ2h0PSIxNiIgdmlld0JveD0iMCAwIDE2IDE2IiBmaWxsPSJub25lIj4NCgk8cmVjdCB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIGZpbGw9ImJsYWNrIiBzdHJva2U9IndoaXRlIi8+DQoJPHBhdGggZD0iTTExLjUxNDYgNEw2LjcwMjkzIDguOTUyODlMNC40ODUzNiA2LjY1OTQ5TDMgOC4xODg0M0w2LjcwMjkzIDEyTDEzIDUuNTI4OTRMMTEuNTE0NiA0WiIgZmlsbD0id2hpdGUiLz4NCjwvc3ZnPg==") left top 4px no-repeat;
                        @media all and (max-width: 768px) {
                            background-position: left top 2px;
                        }
                    }
                }
            }
            .main-header {
                border-bottom: 1px solid #000;
                &__language {
                    @media all and (max-width: 768px){
                        border-top: 1px solid #FFFFFF;
                    }
                }
                &__content {
                    border-bottom: 1px solid #FFFFFF;
                    &-in {
                        @media all and (max-width: 768px){
                            background: #000000;
                            border-left: 1px solid #FFFFFF;
                        }
                    }
                }
                &__logo {
                    img {
                        height: 59px;
                        display: none;
                        &.white {
                            display: block;
                        }
                    }
                }
                &__menu {
                    a {
                        span {
                            color: #FFFFFF;
                        }
                        &.nuxt-link-active:before {
                            background: #FFFFFF;
                        }
                    }
                }
                &__visual {
                    svg {
                        path {
                            fill: #ffffff;
                        }
                    }
                }
            }
            .violations_error {
                color: #FFFFFF;
            }
            .required {
                label {
                    &:after {
                        color: #FFFFFF;
                    }
                }
                &.error {
                    &.photo-input {
                        border-color: #FFFFFF;
                    }
                    .input {
                        border-color: #FFFFFF;
                    }
                }
            }
            .complaint {
                &__pre-text {
                    &.--required {
                        span {
                            color: #FFFFFF;
                        }
                    }
                }
                &__wrapper, &__item {
                    background: #000000;
                    border-top: 1px solid #FFFFFF;
                }
                &__item {
                    background: #000000;
                    border: 1px solid #FFFFFF;
                    .label {
                        &.--vertical {
                            color: #FFFFFF;
                        }
                    }
                }
            }
            .add-link {
                border-bottom-color: #FFFFFF;
            }
            .add-object {
                &__form {
                    border: 1px solid #fff;
                }
                &__step {
                    background: #FFFFFF;
                    .step {
                        &-progress {
                            background: #000000;
                        }
                        &:before {
                            background: #000000;
                        }
                    }
                    &-info {
                        .step {
                            color: #FFFFFF;
                        }
                    }
                }
                &__error {
                    border: 1px solid #FFFFFF;
                    background-color: #000000;
                    &:before {
                        border-right-color: #FFFFFF;
                    }
                }
                &__line {
                    &.error {
                        .input, select {
                            border-color: #FFFFFF;
                        }
                    }
                }
                &__button {
                    border: 1px solid #FFFFFF;
                    background-color: #000000;
                }
                &__textarea {
                    background: #000000;
                    color: #FFFFFF;
                    border-color: #FFFFFF;
                    &::-webkit-input-placeholder {
                        color: #FFFFFF;
                    }
                    &:-ms-input-placeholder {
                        color: #FFFFFF;
                    }
                    &::placeholder {
                        color: #FFFFFF;
                    }
                }
                &__link {
                    &:hover, &.active {
                        background-color: #FFFFFF;
                        color: #000000
                    }
                }
                &__info {
                    &-text {
                        background: #000000;
                        border: 1px solid #FFFFFF;
                        &:before {
                            border-bottom-color: #FFFFFF;
                        }
                    }
                    &-icon {
                        svg {
                            display: none;
                            &.white {
                                display: block;
                            }
                        }
                    }
                }
                &__form {
                    background: #000000;
                }
            }
            .lang-select {
                &__list {
                    border-color: #ffffff;
                    background: #000000;
                }
                &__item {
                    span {
                        color: #FFFFFF;
                    }
                    &:hover {
                        background: #000000;
                    }
                    &.selected {
                        background: #000000;
                        span {
                            color: #FFFFFF;
                        }
                    }
                }
                &__selected {
                    span {
                        color: #FFFFFF;
                    }
                    svg {
                        path {
                            fill: #ffffff;
                        }
                    }
                }
            }
            .label {
                color: #FFFFFF;
            }
            .contacts {
                &__wrapper {
                    background: #000000;
                    border-bottom: 1px solid #FFFFFF;
                }
                &__link {
                    color: #FFFFFF;
                }
                &__text {
                    color: #FFFFFF;
                }
                &__line {
                    .error-msg {
                        color: #FFFFFF;
                    }
                    &.required {
                        label:after {
                            color: #FFFFFF;
                        }
                        &.error {
                            .textarea {
                                border-color: #FFFFFF;
                            }
                        }
                    }
                }
            }
            .about {
                &__item {
                    p {
                        color: #FFFFFF;
                    }
                }
                &__top {
                    &-item {
                        background: #000000;
                        border: 1px solid #FFFFFF;
                        * {
                            color: #FFFFFF;
                        }
                        img {
                            display: none;
                        }
                        &__title {
                            margin-top: 0;
                        }
                    }
                }
                &__part {
                    background: #000000;
                    &-text {
                        color: #FFFFFF;
                    }
                }
                &__text {
                    &-b {
                        background: #000000;
                    }
                }
                &__link {
                    &-text {
                        color: #FFFFFF;
                        a {
                            color: #FFFFFF;
                        }
                    }
                }
                &__title, &__text {
                    color: #FFFFFF;
                }
            }
            .blog {
                &__item {
                    &-title, h3, &-text, p, &-link, &-img, img {
                        color: #FFFFFF;
                    }
                }
                &__list {
                    &-item {
                        border-color: #FFFFFF;
                    }
                }
                &__content {
                    &-top {
                        &__text h3 {
                            color: #FFFFFF;
                        }
                    }
                }
                &__inside {
                    &-content p, &-date {
                        color: #FFFFFF;
                    }
                    &-comments {
                        h4 {
                            color: #FFFFFF;
                        }
                    }
                }
                &__material {
                    &-link {
                        span {
                            color: #FFFFFF;
                        }
                    }
                }
                &__category {
                    &-title {
                        color: #FFFFFF;
                    }
                    &-link {
                        &:hover {
                            background: transparent;
                            &:before {
                                background: transparent;
                            }
                        }
                        span {
                            color: #FFFFFF;
                        }
                        &.isActive {
                            span {
                                border-color: #FFFFFF;
                            }
                        }
                     }
                }
            }
            .user {
                &-profile, &-level, &-task {
                    background: #000000;
                    border: 1px solid #FFFFFF;
                }
                &-achievment {
                    &__text {
                        span {
                            color: #FFFFFF;
                        }
                    }
                    &__icon {
                        img {
                            display: none;
                            &.black {
                                display: none;
                            }
                            &.white {
                                display: block;
                            }
                        }
                        &.user-achievment__icon_add {
                            background-image: url('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxOS4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHZpZXdCb3g9IjE1IC0xNSA2MCA2MCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAxNSAtMTUgNjAgNjA7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+DQoJLnN0MHtmaWxsOm5vbmU7c3Ryb2tlOiNGRkZGRkY7c3Ryb2tlLXdpZHRoOjI7fQ0KCS5zdDF7ZmlsbDojRkZGRkZGO30NCjwvc3R5bGU+DQo8Y2lyY2xlIGNsYXNzPSJzdDAiIGN4PSI0NSIgY3k9IjE1IiByPSIyOSIvPg0KPHBhdGggY2xhc3M9InN0MSIgZD0iTTQ3LDNoLTR2MTBIMzN2NGgxMHYxMGg0VjE3aDEwdi00SDQ3VjN6Ii8+DQo8L3N2Zz4NCg==');
                        }
                    }
                }
                &-achievments {
                    &__events {
                        .list {
                            &__text {
                                a { color: #FFFFFF }
                                color: #FFFFFF;
                            }
                            &__icon {
                                &.list__icon_level {
                                    background: #FFFFFF;
                                    span {
                                        color: #000000;
                                    }
                                }
                                &.list__icon_achievment {
                                    img {
                                        display: none;
                                        &.white {
                                            display: block;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                &-page {
                    &__row {
                        padding: 0 0 30px;
                    }
                    &__header {
                        height: 50px;
                        min-height: 50px;
                        background-image: none !important;
                        .menu {
                            background: #FFFFFF;
                            &__item {
                                span {
                                    color: #000000;
                                }
                                &.isActive, &:hover {
                                    background: #000000;
                                    span {
                                        color: #FFFFFF;
                                    }
                                }
                            }
                        }
                    }
                    &__profile {
                        top: -52px;
                        @media all and (max-width: 768px){
                            top: 8px;
                        }
                    }
                    &__button {
                        background: #FFFFFF;
                        color: #000000;
                    }
                }
                &-level {
                     &__progress {
                        .progress {
                            background: rgba(123, 149, 167, 0.75);
                            &__bar {
                                background: #FFFFFF;
                            }
                        }
                     }
                }
                &-task {
                    &__progress {
                        .progress {
                            background: rgba(123, 149, 167, 0.75);
                            &__bar {
                                background: #FFFFFF;
                            }
                        }
                    }
                }
                &-tasks {
                    &__item-status {
                        &.--current {
                            background: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxOS4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHZpZXdCb3g9Ii00IDYgMjAgMjAiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgLTQgNiAyMCAyMDsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4NCgkuc3Qwe2ZpbGw6bm9uZTtzdHJva2U6I0ZGRkZGRjtzdHJva2Utd2lkdGg6MztzdHJva2UtbWl0ZXJsaW1pdDoxMDt9DQo8L3N0eWxlPg0KPHBhdGggY2xhc3M9InN0MCIgZD0iTTEwLjYsMTYuNkg1LjV2LTUuMSIvPg0KPHBhdGggY2xhc3M9InN0MCIgZD0iTTE0LjUsMTZjMCw0LjctMy44LDguNS04LjUsOC41Yy00LjcsMC04LjUtMy44LTguNS04LjVjMC00LjcsMy44LTguNSw4LjUtOC41QzEwLjcsNy41LDE0LjUsMTEuMywxNC41LDE2eiIvPg0KPC9zdmc+DQo=") left top no-repeat;
                            background-size: 20px;
                        }
                        &.--new {
                            background: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxOS4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHZpZXdCb3g9IjAgMCA0IDIwIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA0IDIwOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8c3R5bGUgdHlwZT0idGV4dC9jc3MiPg0KCS5zdDB7ZmlsbDojRkZGRkZGO30NCjwvc3R5bGU+DQo8ZyBpZD0iWE1MSURfM18iPg0KCTxyZWN0IGlkPSJYTUxJRF80XyIgY2xhc3M9InN0MCIgd2lkdGg9IjQiIGhlaWdodD0iMTQiLz4NCgk8cmVjdCBpZD0iWE1MSURfNl8iIHk9IjE2LjMiIGNsYXNzPSJzdDAiIHdpZHRoPSI0IiBoZWlnaHQ9IjMuNyIvPg0KPC9nPg0KPC9zdmc+DQo=") left 8px top no-repeat;
                            background-size: 4px 20px;
                        }
                        &.--done {
                            background: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxOS4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHZpZXdCb3g9Ii01IDggMTggMTUiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgLTUgOCAxOCAxNTsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4NCgkuc3Qwe2NsaXAtcGF0aDp1cmwoI1NWR0lEXzJfKTt9DQoJLnN0MXtmaWxsOiNGRkZGRkY7fQ0KPC9zdHlsZT4NCjxnPg0KCTxkZWZzPg0KCQk8cmVjdCBpZD0iU1ZHSURfMV8iIHg9Ii01IiB5PSI4IiB3aWR0aD0iMTgiIGhlaWdodD0iMTUiLz4NCgk8L2RlZnM+DQoJPGNsaXBQYXRoIGlkPSJTVkdJRF8yXyI+DQoJCTx1c2UgeGxpbms6aHJlZj0iI1NWR0lEXzFfIiAgc3R5bGU9Im92ZXJmbG93OnZpc2libGU7Ii8+DQoJPC9jbGlwUGF0aD4NCgk8ZyBjbGFzcz0ic3QwIj4NCgkJPHBhdGggY2xhc3M9InN0MSIgZD0iTTEwLjMsOGwtOC43LDkuM2wtNC00LjNMLTUsMTUuOUwxLjcsMjNMMTMsMTAuOUwxMC4zLDh6Ii8+DQoJPC9nPg0KPC9nPg0KPC9zdmc+DQo=") left top no-repeat;
                            background-size: 18px 14px;
                        }
                    }
                }
                &-objects {
                    &__filter {
                        .filter {
                            &__text {
                                color: #FFFFFF;
                            }
                            &__dropdown {
                                .dropdown {
                                    &__item {
                                        &:hover {
                                            background: #FFFFFF;
                                            span {
                                                color: #000000;
                                            }
                                        }
                                    }
                                    &__list {
                                        background: #000000;
                                        border: 1px solid #FFFFFF;
                                    }
                                    &__selected {
                                        span {
                                            border-color: #FFFFFF;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                &-object {
                    &__download {
                        color: #FFFFFF;
                    }
                }
                &-comments {
                    &__info {
                        color: #FFFFFF;
                        strong {
                            color: #FFFFFF;
                        }
                    }
                }
                &-profile {
                    &__favorites {
                        img {
                            display: none;
                            &.white {
                                display: block;
                            }
                        }
                    }
                    &__content {
                        &.--verified {
                            &:before {
                                 background-image: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1MCIgaGVpZ2h0PSI3MCIgdmlld0JveD0iMCAwIDUwIDcwIiBmaWxsPSJub25lIj4NCgk8cGF0aCBkPSJNMCAwSDUwVjcwTDI1IDYwTDAgNzBWMFoiIGZpbGw9ImJsYWNrIiBzdHJva2U9IndoaXRlIi8+DQoJPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xMyAzMC42NzMzTDI1LjU3MTIgNDNMMzggMzAuNjM4TDM0LjU4MTIgMjdMMjUuNTcxMiAzNS45MzZMMTYuNDkgMjcuMDM1M0wxMyAzMC42NzMzWiIgZmlsbD0id2hpdGUiLz4NCjwvc3ZnPg==");
                             }
                        }
                    }
                }
            }
            .custom-dropdown select {
                color: #FFFFFF;
                background: #000000;
            }
            .breadcrumbs {
                &__link {
                    color: #FFFFFF;
                }
            }
            .subscribe-link {
                color: #FFFFFF;
            }
            .pagination {
                &__prev, &__next {
                   background: #000000;
                   border: 1px solid #ffffff;
                }
                &__btn {
                    background: #000000;
                    border: 1px solid #ffffff;
                    &_active {
                         border: 3px solid #ffffff;;
                    }
                    span {
                        color: #FFFFFF;
                    }
                }
            }
        }
        &.white {
            background: #ffffff;
            color: #000000;
            .title {
                color: #000000;
                span {
                    color: #000000;
                }
            }
            .button {
                border: 1px solid #000000;
                background-color: #FFFFFF;
                color: #000000;
                &.--complaint {
                    background-image: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNiIgaGVpZ2h0PSIxNiIgdmlld0JveD0iMCAwIDE2IDE2IiBmaWxsPSJub25lIj4NCgk8cGF0aCBkPSJNMTMuMzczNiA0LjMwNzdDMTMuODgzNCA0LjMwNzcgMTQuMjk2NyAzLjg5NDQzIDE0LjI5NjcgMy4zODQ2MkMxNC4yOTY3IDIuODc0ODIgMTMuODgzNCAyLjQ2MTU1IDEzLjM3MzYgMi40NjE1NUMxMi44NjM4IDIuNDYxNTUgMTIuNDUwNSAyLjg3NDgyIDEyLjQ1MDUgMy4zODQ2MkMxMi40NTA1IDMuODk0NDMgMTIuODYzOCA0LjMwNzcgMTMuMzczNiA0LjMwNzdaIiBmaWxsPSJibGFjayIvPg0KCTxwYXRoIGQ9Ik0xMC45MTIgMi40NjE1MUMxMS40MjE4IDIuNDYxNTEgMTEuODM1MSAyLjA0ODIzIDExLjgzNTEgMS41Mzg0M0MxMS44MzUxIDEuMDI4NjMgMTEuNDIxOCAwLjYxNTM1NiAxMC45MTIgMC42MTUzNTZDMTAuNDAyMiAwLjYxNTM1NiA5Ljk4ODk1IDEuMDI4NjMgOS45ODg5NSAxLjUzODQzQzkuOTg4OTUgMi4wNDgyMyAxMC40MDIyIDIuNDYxNTEgMTAuOTEyIDIuNDYxNTFaIiBmaWxsPSJibGFjayIvPg0KCTxwYXRoIGQ9Ik04LjQ1MDQ4IDEuODQ2MTVDOC45NjAyOCAxLjg0NjE1IDkuMzczNTYgMS40MzI4OCA5LjM3MzU2IDAuOTIzMDc3QzkuMzczNTYgMC40MTMyNzYgOC45NjAyOCAwIDguNDUwNDggMEM3Ljk0MDY4IDAgNy41Mjc0IDAuNDEzMjc2IDcuNTI3NCAwLjkyMzA3N0M3LjUyNzQgMS40MzI4OCA3Ljk0MDY4IDEuODQ2MTUgOC40NTA0OCAxLjg0NjE1WiIgZmlsbD0iYmxhY2siLz4NCgk8cGF0aCBkPSJNNS45ODg5MyAzLjA3Njg3QzYuNDk4NzQgMy4wNzY4NyA2LjkxMjAxIDIuNjYzNTkgNi45MTIwMSAyLjE1Mzc5QzYuOTEyMDEgMS42NDM5OSA2LjQ5ODc0IDEuMjMwNzEgNS45ODg5MyAxLjIzMDcxQzUuNDc5MTMgMS4yMzA3MSA1LjA2NTg2IDEuNjQzOTkgNS4wNjU4NiAyLjE1Mzc5QzUuMDY1ODYgMi42NjM1OSA1LjQ3OTEzIDMuMDc2ODcgNS45ODg5MyAzLjA3Njg3WiIgZmlsbD0iYmxhY2siLz4NCgk8cGF0aCBkPSJNMTIuNDUwNSAzLjM4NDYzVjcuMzg0NjNDMTIuNDUwNSA3LjU1NDQ4IDEyLjMxMjYgNy42OTIzMyAxMi4xNDI4IDcuNjkyMzNDMTEuOTcyOSA3LjY5MjMzIDExLjgzNTEgNy41NTQ0OCAxMS44MzUxIDcuMzg0NjNWMS41Mzg0OEg5Ljk4ODkzVjYuNzY5MjVDOS45ODg5MyA2LjkzOTEgOS44NTEwOSA3LjA3Njk0IDkuNjgxMjQgNy4wNzY5NEM5LjUxMTM5IDcuMDc2OTQgOS4zNzM1NSA2LjkzOTEgOS4zNzM1NSA2Ljc2OTI1VjAuOTIzMDk2SDcuNTI3NFY2Ljc2OTI1QzcuNTI3NCA2LjkzOTEgNy4zODk1NSA3LjA3Njk0IDcuMjE5NyA3LjA3Njk0QzcuMDQ5ODYgNy4wNzY5NCA2LjkxMjAxIDYuOTM5MSA2LjkxMjAxIDYuNzY5MjVWMi4xNTM4Nkg1LjA2NTg2VjkuODQ2MTdMMy44MTk3IDguMTQwOTRDMy40NTA0NyA3LjU3MTcxIDIuNzI5ODYgNy4zODA5NCAyLjIwMTg2IDcuNzA3MUMxLjY3NTcgOC4wNDA2MyAxLjU0NTI0IDguNzY4MDIgMS45MDk1NSA5LjMzNTRDMS45MDk1NSA5LjMzNTQgMy45MTk0IDEyLjM3NzIgNC43NzYwMSAxMy42Nzk0QzUuNjMyNjMgMTQuOTgxNiA3LjAyMDMyIDE2IDkuNjE1MzkgMTZDMTMuOTEyIDE2IDE0LjI5NjYgMTIuNjgxOSAxNC4yOTY2IDExLjY5MjNDMTQuMjk2NiAxMC43MDI4IDE0LjI5NjYgMy4zODQ2MyAxNC4yOTY2IDMuMzg0NjNIMTIuNDUwNVoiIGZpbGw9ImJsYWNrIi8+DQo8L3N2Zz4=");
                }
            }
            .burger {
                &-line {
                    background: #000000;
                    &:before, &:after {
                        background: #000000;
                    }
                }
                &-close {
                        &__wrapper {
                            border-bottom: 1px solid #000000;
                        }
                }
            }
            .select {
                select {
                    background: #FFFFFF;
                    border-color: #000000;
                }
                &-text {
                    &:after {
                        border-top-color: #000000;
                    }
                }
            }
            .input {
                border-color: #000000;
                background: #FFFFFF;
                input {
                    background: #FFFFFF;
                    color: #000000;
                }
                button {
                    svg {
                        path {
                            fill: #000;
                        }
                    }
                }
            }
            .comment-form {
                textarea {
                    border-color: #000000;
                    background: #ffffff;
                    color: #000000;
                }
            }
            .textarea {
                border-color: #000000;
                background: #FFFFFF;
                color: #000000;
            }
            .represent {
                &__title {
                    color: #000000;
                }
                &__text {
                    color: #000000;
                }
            }
            .contacts {
                &__wrapper {
                    background: #FFFFFF;
                    border-bottom: 1px solid #000000;
                }
                &__link {
                    color: #000000;
                }
                &__text {
                    color: #000000;
                }
                &__line {
                    .error-msg {
                        color: #000000;
                    }
                    &.required {
                        label:after {
                            color: #000000;
                        }
                        &.error {
                            .textarea {
                                border-color: #000000;
                            }
                        }
                    }
                }
            }
            .about {
                &__item {
                    p {
                        color: #000000;
                    }
                }
                &__top {
                    &-item {
                        background: #FFFFFF;
                        border: 1px solid #000000;
                        * {
                            color: #000000;
                        }
                        img {
                            display: none;
                        }
                        &__title {
                            margin-top: 0;
                        }
                    }
                }
                &__part {
                    background: #FFFFFF;
                    &-text {
                        color: #000000;
                    }
                }
                &__text {
                    &-b {
                        background: #FFFFFF;
                    }
                }
                &__link {
                    &-text {
                        color: #000000;
                        a {
                            color: #000000;
                        }
                    }
                }
                &__title, &__text {
                    color: #000000;
                }
            }
            .checkbox {
                input[type=checkbox] {
                    display: none;
                    & + label {
                        background: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNiIgaGVpZ2h0PSIxNiIgdmlld0JveD0iMCAwIDE2IDE2IiBmaWxsPSJub25lIj4NCgk8cmVjdCB4PSIwLjUiIHk9IjAuNSIgd2lkdGg9IjE1IiBoZWlnaHQ9IjE1IiBmaWxsPSJ3aGl0ZSIgc3Ryb2tlPSJibGFjayIvPg0KPC9zdmc+") left top 4px no-repeat;
                        background-size: 16px;
                    }

                    &:checked + label {
                        background: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNiIgaGVpZ2h0PSIxNiIgdmlld0JveD0iMCAwIDE2IDE2IiBmaWxsPSJub25lIj4NCgk8cmVjdCB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIGZpbGw9IndoaXRlIiBzdHJva2U9ImJsYWNrIi8+DQoJPHBhdGggZD0iTTExLjUxNDYgNEw2LjcwMjkzIDguOTUyODlMNC40ODUzNiA2LjY1OTQ5TDMgOC4xODg0M0w2LjcwMjkzIDEyTDEzIDUuNTI4OTRMMTEuNTE0NiA0WiIgZmlsbD0iYmxhY2siLz4NCjwvc3ZnPg==") left top 4px no-repeat;
                        @media all and (max-width: 768px) {
                            background-position: left top 2px;
                        }
                    }
                }
            }
            .main-header {
                &__language {
                    @media all and (max-width: 768px){
                        border-top: 1px solid #000000;
                    }
                }
                &__logo {
                    img {
                        height: 59px;
                        display: none;
                        &.black {
                            display: block;
                        }
                    }
                }
                &__menu {
                    a {
                        span {
                            color: #000000;
                        }
                        &.nuxt-link-active:before {
                            background: #000000;
                        }
                    }
                }
                &__content {
                    border-bottom: 1px solid #000;
                }
            }
            .violations_error {
                color: #000000;
            }
            .required {
                label {
                    &:after {
                        color: #000000;
                     }
                }
                &.error {
                    &.photo-input {
                        border-color: #000000;
                    }
                    .input {
                        border-color: #000000;
                    }
                }
            }
            .complaint {
                &__pre-text {
                    &.--required {
                        span {
                            color: #000000;
                        }
                    }
                }
                &__wrapper {
                    border-top: 1px solid #000000;
                    background: #FFFFFF;
                }
                &__item {
                    background: #FFFFFF;
                    border: 1px solid #000000;
                    .label {
                        &.--vertical {
                            color: #000000;
                        }
                    }
                }
            }
            .add-link {
                color: #000000;
                border-bottom-color: #000000;
            }
            .add-object {
                &__step {
                    background: #000000;
                    .step {
                        &-progress {
                            background: #FFFFFF;
                        }
                        &:before {
                            background: #FFFFFF;
                        }
                    }
                    &-info {
                        .step {
                            color: #000000;
                        }
                    }
                }
                &__error {
                    border: 1px solid #000000;
                    background-color: #FFFFFF;
                    color: #000000;
                    &:before {
                        border-right-color: #000000;
                    }
                }
                &__line {
                    &.error {
                        .input, select {
                            border-color: #000000;
                        }
                    }
                }
                &__link {
                    border-color: #000000;
                    &:hover, &.active {
                        background-color: #000000;
                        color: #FFFFFF;
                    }
                }
                &__form {
                    border: 1px solid #000000;
                }
                &__textarea {
                    border-color: #000000;
                    &::-webkit-input-placeholder {
                        color: #000000;
                    }
                    &:-ms-input-placeholder {
                        color: #000000;
                    }
                    &::placeholder {
                        color: #000000;
                    }
                }
                &__button {
                    border: 1px solid #000000;
                    background-color: #FFFFFF;
                    span {
                        color: #000000;
                    }
                }
                &__info {
                    &-text {
                        background: #FFFFFF;
                        border: 1px solid #000000;
                        &:before {
                            border-bottom-color: #000000;
                        }
                    }
                    &-icon {
                        svg {
                            display: none;
                            &.white {
                                stroke: #000000;
                                display: block;
                            }
                        }
                    }
                }
            }
            .blog {
                &__item {
                    &-title, h3, &-text, p, &-link, &-img, img {
                        color: #000000;
                    }
                }
                &__list {
                    &-item {
                        border-color: #000000;
                    }
                }
                &__content {
                    &-top {
                        &__text h3 {
                            color: #000000;
                        }
                    }
                }
                &__inside {
                    &-content p, &-date {
                        color: #000000;
                    }
                    &-comments {
                        h4 {
                            color: #000000;
                        }
                    }
                }
                &__material {
                    &-link {
                        span {
                            color: #000000;
                        }
                    }
                }
                &__category {
                    &-title {
                        color: #000000;
                    }
                    &-link {
                        &:hover {
                            background: transparent;
                            &:before {
                                background: transparent;
                            }
                        }
                        span {
                            color: #000000;
                        }
                        &.isActive {
                            span {
                                border-color: #000000;
                            }
                        }
                    }
                }
            }
            .user {
                &-profile, &-level, &-task {
                    background: #FFFFFF;
                    border: 1px solid #000000;
                }
                &-achievment {
                    &__text {
                        span {
                            color: #000000;
                        }
                    }
                    &__icon {
                        img {
                            display: none;
                            &.black {
                                display: block;
                            }
                        }
                        &.user-achievment__icon_add {
                            background-image: url('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxOS4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHZpZXdCb3g9IjE1IC0xNSA2MCA2MCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAxNSAtMTUgNjAgNjA7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+DQoJLnN0MHtmaWxsOm5vbmU7c3Ryb2tlOiMwMDAwMDA7c3Ryb2tlLXdpZHRoOjI7fQ0KPC9zdHlsZT4NCjxjaXJjbGUgY2xhc3M9InN0MCIgY3g9IjQ1IiBjeT0iMTUiIHI9IjI5Ii8+DQo8cGF0aCBkPSJNNDcsM2gtNHYxMEgzM3Y0aDEwdjEwaDRWMTdoMTB2LTRINDdWM3oiLz4NCjwvc3ZnPg0K');
                        }
                    }
                }
                &-achievments {
                    &__events {
                        .list {
                            &__text {
                                a { color: #000000; }
                                color: #000000;
                            }
                            &__icon {
                                &.list__icon_level {
                                    background: #000000;
                                    span {
                                        color: #FFFFFF;
                                    }
                                }
                                &.list__icon_achievment {
                                    img {
                                        display: none;
                                        &.black {
                                            display: block;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                &-page {
                    &__row {
                        padding: 0 0 30px;
                    }
                    &__header {
                        height: 50px;
                        min-height: 50px;
                        background-image: none !important;
                        .menu {
                            background: #000000;
                            &__item {
                                span {
                                    color: #FFFFFF;
                                }
                                &.isActive, &:hover {
                                    background: #FFFFFF;
                                    span {
                                        color: #000000;
                                    }
                                }
                                &.--logout {
                                    &:hover {
                                        svg path {
                                            stroke: #000;
                                        }
                                    }
                                }
                            }
                        }
                    }
                    &__profile {
                        top: -52px;
                        @media all and (max-width: 768px){
                            top: 8px;
                        }
                    }
                    &__button {
                        background: #000000;
                        color: #FFFFFF;
                    }
                }
                &-level {
                    &__progress {
                        .progress {
                            background: rgba(123, 149, 167, 0.75);
                            &__bar {
                                background: #000000;
                            }
                        }
                    }
                }
                &-task {
                    &__progress {
                        .progress {
                            background: rgba(123, 149, 167, 0.75);
                            &__bar {
                                background: #000000;
                            }
                        }
                    }
                }
                &-tasks {
                    &__item-status {
                        &.--current {
                            background: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxOS4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHZpZXdCb3g9Ii00IDYgMjAgMjAiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgLTQgNiAyMCAyMDsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4NCgkuc3Qwe2ZpbGw6bm9uZTtzdHJva2U6IzAwMDAwMDtzdHJva2Utd2lkdGg6MztzdHJva2UtbWl0ZXJsaW1pdDoxMDt9DQo8L3N0eWxlPg0KPHBhdGggY2xhc3M9InN0MCIgZD0iTTEwLjYsMTYuNkg1LjV2LTUuMSIvPg0KPHBhdGggY2xhc3M9InN0MCIgZD0iTTE0LjUsMTZjMCw0LjctMy44LDguNS04LjUsOC41Yy00LjcsMC04LjUtMy44LTguNS04LjVjMC00LjcsMy44LTguNSw4LjUtOC41QzEwLjcsNy41LDE0LjUsMTEuMywxNC41LDE2eiIvPg0KPC9zdmc+DQo=") left top no-repeat;
                            background-size: 20px;
                        }
                        &.--new {
                            background: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxOS4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHZpZXdCb3g9IjAgMCA0IDIwIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA0IDIwOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8c3R5bGUgdHlwZT0idGV4dC9jc3MiPg0KCS5zdDB7ZmlsbDojMDAwMDAwO30NCjwvc3R5bGU+DQo8ZyBpZD0iWE1MSURfM18iPg0KCTxyZWN0IGlkPSJYTUxJRF80XyIgY2xhc3M9InN0MCIgd2lkdGg9IjQiIGhlaWdodD0iMTQiLz4NCgk8cmVjdCBpZD0iWE1MSURfNl8iIHk9IjE2LjMiIGNsYXNzPSJzdDAiIHdpZHRoPSI0IiBoZWlnaHQ9IjMuNyIvPg0KPC9nPg0KPC9zdmc+DQo=") left 8px top no-repeat;
                            background-size: 4px 20px;
                        }
                        &.--done {
                            background: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxOS4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHZpZXdCb3g9Ii01IDggMTggMTUiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgLTUgOCAxOCAxNTsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4NCgkuc3Qwe2NsaXAtcGF0aDp1cmwoI1NWR0lEXzJfKTt9DQoJLnN0MXtmaWxsOiMwMDAwMDA7fQ0KPC9zdHlsZT4NCjxnPg0KCTxkZWZzPg0KCQk8cmVjdCBpZD0iU1ZHSURfMV8iIHg9Ii01IiB5PSI4IiB3aWR0aD0iMTgiIGhlaWdodD0iMTUiLz4NCgk8L2RlZnM+DQoJPGNsaXBQYXRoIGlkPSJTVkdJRF8yXyI+DQoJCTx1c2UgeGxpbms6aHJlZj0iI1NWR0lEXzFfIiAgc3R5bGU9Im92ZXJmbG93OnZpc2libGU7Ii8+DQoJPC9jbGlwUGF0aD4NCgk8ZyBjbGFzcz0ic3QwIj4NCgkJPHBhdGggY2xhc3M9InN0MSIgZD0iTTEwLjMsOGwtOC43LDkuM2wtNC00LjNMLTUsMTUuOUwxLjcsMjNMMTMsMTAuOUwxMC4zLDh6Ii8+DQoJPC9nPg0KPC9nPg0KPC9zdmc+DQo=") left top no-repeat;
                            background-size: 18px 14px;
                        }
                    }
                }
                &-object {
                    &__download {
                        color: #000000;
                    }
                }
                &-comments {
                    &__info {
                        color: #000000;
                        strong {
                            color: #000000;
                        }
                    }
                }
                &-profile {
                    &__favorites {
                        img {
                            display: none;
                            &.black {
                                display: block;
                            }
                        }
                    }
                    &__content {
                        &.--verified {
                            &:before {
                                background-image: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1MCIgaGVpZ2h0PSI3MCIgdmlld0JveD0iMCAwIDUwIDcwIiBmaWxsPSJub25lIj4NCgk8cGF0aCBkPSJNMCAwSDUwVjcwTDI1IDYwTDAgNzBWMFoiIGZpbGw9IndoaXRlIiBzdHJva2U9ImJsYWNrIi8+DQoJPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xMyAzMC42NzMzTDI1LjU3MTIgNDNMMzggMzAuNjM4TDM0LjU4MTIgMjdMMjUuNTcxMiAzNS45MzZMMTYuNDkgMjcuMDM1M0wxMyAzMC42NzMzWiIgZmlsbD0iYmxhY2siLz4NCjwvc3ZnPg==");
                            }
                        }
                    }
                }
            }
            .pagination {
                &__prev, &__next {
                    background: #ffffff;
                    border: 1px solid #000000;
                }
                &__btn {
                    background: #ffffff;
                    border: 1px solid #000000;
                    &_active {
                         border: 3px solid #000000;
                    }
                    span {
                        color: #000000;
                    }
                }
            }
        }
        &.black, &.white {
            .add-object {
                &__step {
                    .step-progress {
                        opacity: 0.75;
                    }
                }
                &__rating {
                    &-text {
                        position: relative;
                        margin: 0;
                        left: auto;
                    }
                }
                &__line {
                    .col.--small.--rating {
                        display: none;
                    }
                }
                &__button {
                    padding: 0;
                    text-align: center;
                    svg {
                        display: none;
                    }
                }
            }
            .about {
                &__top {
                    &-item {
                         -webkit-box-shadow: none;
                         -moz-box-shadow: none;
                         box-shadow: none;
                    }
                    &-bg {
                        display: none;
                    }
                    .about__text-b:first-child {
                        margin: 0;
                    }
                }
            }
            .contacts {
                &__link {
                    padding: 0;
                    background: none;
                }
            }
        }
        &.sm {

        }
        &.md {

        }
        &.lrg {

        }
        &.noto {
            * {
                font-family: 'Noto Serif', serif;
            }
        }
    }
</style>