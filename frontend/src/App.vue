<template>
    <div id="app">
        <router-view/>
    </div>
</template>

<script>
    export default {
        data() {
            return {};
        },
        mounted() {
            this.loadUser()
        },
        methods: {
            async loadUser() {
                try {
                    await this.$store.dispatch('loadUser')
                } catch (e) {
                    console.log('not authenticated')
                }
            }
        },
        components: {}
    };
</script>


<style lang="scss">
    @import "./styles/mixins.scss";

    //main styles
    * {
        outline: none;
        -webkit-appearance: none;
        font-family: "Roboto", Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        box-sizing: border-box;
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
        &.--date {
            input {
                background: transparent;
            }
            background: url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAxNiAxNiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGcgY2xpcC1wYXRoPSJ1cmwoI2NsaXAwKSI+CjxwYXRoIGQ9Ik0xMy40NDQ0IDNIMi41NTU1NkMxLjY5NjQ1IDMgMSAzLjU5Njk1IDEgNC4zMzMzM1YxMy42NjY3QzEgMTQuNDAzIDEuNjk2NDUgMTUgMi41NTU1NiAxNUgxMy40NDQ0QzE0LjMwMzYgMTUgMTUgMTQuNDAzIDE1IDEzLjY2NjdWNC4zMzMzM0MxNSAzLjU5Njk1IDE0LjMwMzYgMyAxMy40NDQ0IDNaIiBzdHJva2U9IiM3Qjk1QTciIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+CjxwYXRoIGQ9Ik0xMSAxVjQiIHN0cm9rZT0iIzdCOTVBNyIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiLz4KPHBhdGggZD0iTTUgMVY0IiBzdHJva2U9IiM3Qjk1QTciIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+CjxwYXRoIGQ9Ik0wLjc5OTgwNSA3LjJIMTUuMTk5OCIgc3Ryb2tlPSIjN0I5NUE3IiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIvPgo8L2c+CjxkZWZzPgo8Y2xpcFBhdGggaWQ9ImNsaXAwIj4KPHJlY3Qgd2lkdGg9IjE2IiBoZWlnaHQ9IjE2IiBmaWxsPSJ3aGl0ZSIvPgo8L2NsaXBQYXRoPgo8L2RlZnM+Cjwvc3ZnPgo=") right 10px center no-repeat;
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
    .button {
        padding: 14px 50px 16px;
        font-size: 16px;
        line-height: 20px;
        color: #ffffff;
        border: none;
        background: #3DBA3B;
        cursor: pointer;
        -webkit-transition: opacity 0.3s;
        -moz-transition: opacity 0.3s;
        -ms-transition: opacity 0.3s;
        -o-transition: opacity 0.3s;
        transition: opacity 0.3s;
        &:hover {
            opacity: 0.7;
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
         font-family: "Roboto", Helvetica, Arial, sans-serif;
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

    .container {
        width: 1160px;
        margin: 0 auto;
    }
</style>
