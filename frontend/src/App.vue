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
    .input {
        border: 1px solid #7b95a7;
        height: 50px;
        display: flex;
        flex: 1 0 auto;
        justify-content: space-between;
        align-items: center;
        padding: 0 10px 0 20px;

    input {
        border: none;
        font-size: 18px;
        line-height: 20px;
        color: #333333;
        height: 100%;
        display: block;
        width: calc(100% - 40px);
    }

    button {
        background: $tr;
        border: none;
        cursor: pointer;
    }
    }

    .title {
        font-weight: 600;
        font-size: 48px;
        line-height: 50px;
        margin: 0;
        color: $black;
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
