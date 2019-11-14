<template>
    <div class="pagination" v-hotkey="keymap">
        <button class="pagination__prev" v-if="currentPage > 1 && pages > 1" @click="selectPage(currentPage - 1)">
            <span>← Ctrl</span>
        </button>
        <button class="pagination__btn" v-if="buttons[0] !== 1" @click="selectPage(1)">
            <span>1</span>
        </button>
        <button class="pagination__btn" v-if="currentPage > 3">
            <span>...</span>
        </button>
        <button class="pagination__btn" v-for="button in buttons" :key="button"
                :class="{pagination__btn_active: button === currentPage}" @click="selectPage(button)">
            <span>{{ button }}</span>
        </button>
        <button class="pagination__btn" v-if="lastButton < pages - 1 ">
            <span>...</span>
        </button>
        <button class="pagination__btn" v-if="lastButton !== pages" @click="selectPage(pages)">
            <span>{{ pages }}</span>
        </button>
        <button class="pagination__next" v-if="pages > 1 && currentPage !== pages" @click="selectPage(currentPage + 1)">
            <span>Ctrl →</span>
        </button>
    </div>
</template>

<script>
    import range from 'lodash/range'
    import last from 'lodash/last'
    import first from 'lodash/first'
    import Vue from 'vue'
    import VueHotkey from 'v-hotkey'

    Vue.use(VueHotkey);

    export default {
        props: [
            'pages',
            'currentPage'
        ],
        methods: {
            selectPage(page) {
                this.$emit('change', page)
            }
        },
        computed: {
            keymap() {
                const self = this;
                return {
                    'ctrl+left': {
                        keyup() {
                            if (self.currentPage !== 1) {
                                self.selectPage(self.currentPage - 1)
                            }
                        }
                    },
                    'ctrl+right': {
                        keyup() {
                            if (self.currentPage !== self.pages) {
                                self.selectPage(self.currentPage + 1)
                            }
                        }
                    }
                }
            },
            firstButton() {
                return first(this.buttons);
            },
            lastButton() {
                return last(this.buttons);
            },
            buttons() {
                return range(this.currentPage - 1, this.currentPage + 2).filter(i => i > 0 && i <= this.pages)
            }
        }
    };
</script>

<style lang="scss">
    @import "./../styles/mixins.scss";

    .pagination {
        display: flex;
        width: 100%;
        justify-content: center;
        align-items: center;

        & > * {
            margin-left: 10px;

            &:first-child {
                margin-left: 0;
            }
        }

        &__btn,
        &__prev,
        &__next {
            border: none;
            flex: none;
            min-width: 40px;
            height: 40px;
            background: #f1f8fc;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 16px;
            line-height: 20px;
            color: #5b6067;
            padding: 0 15px;
            cursor: pointer;
            transition: background 0.3s, color 0.3s;

            &.pagination__btn_active {
                background: #0f6bf5;
                font-weight: 500;

                span {
                    color: #fff;
                }
            }

            &:hover {
                background: #0f6bf5;

                span {
                    color: #fff;
                }
            }
        }
    }
</style>