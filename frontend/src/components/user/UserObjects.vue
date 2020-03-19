<template>
    <div class="user-objects">
        <div class="user-objects__filter">
            <div class="filter">
                <div class="filter__text">Сортировать по</div>
                <div class="filter__dropdown">
                    <div class="dropdown">
                        <div class="dropdown__selected" @click="toggleDropdown($event)">
                            <span>дате добавления</span>
                        </div>
                        <div class="dropdown__list">
                            <div class="dropdown__item">
                                <span>дате добавления</span>
                            </div>
                            <div class="dropdown__item">
                                <span>дате добавления</span>
                            </div>
                            <div class="dropdown__item">
                                <span>дате добавления</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="filter">
                <div class="filter__text">Показать</div>
                <div class="filter__dropdown">
                    <div class="dropdown">
                        <div class="dropdown__selected" @click="toggleDropdown($event)">
                            <span>частично доступные</span>
                        </div>
                        <div class="dropdown__list">
                            <div class="dropdown__item">
                                <span>дате добавления</span>
                            </div>
                            <div class="dropdown__item">
                                <span>дате добавления</span>
                            </div>
                            <div class="dropdown__item">
                                <span>дате добавления</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="user-objects__content">
            <UserObject
                    v-for="object in objects"
                    :key="object.id"
                    :objectLink="{name: 'objects-id', params: {id: object.id}}"
                    :objectTitle="object.title"
                    :objectImg="object.image"
                    :status="object.overallScore"
                    :objectDate="object.date"
                    :objectComments="object.reviewsCount"
                    :objectReports="object.complaintsCount"
            />
        </div>
        <div class="user-objects__pagination" v-if="pages > 1">
            <pagination :pages="pages"/>
        </div>
    </div>
</template>

<script>
    import UserObject from "./UserObject";
    import Pagination from "./../Pagination";

    export default {
        components: {
            UserObject,
            Pagination,
        },
        props: [
            'pages',
            'objects'
        ],
        methods: {
            toggleDropdown (event) {
                event.currentTarget.classList.toggle('opened')
            }
        }
    };
</script>

<style lang="scss">
    @import "./../../styles/mixins.scss";

    .user-objects {
        padding: 35px 0 0;

        &__filter {
            margin-bottom: 55px;
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            align-items: flex-start;

            .object-side__button {
                margin: -15px 0 0;
            }

            &.--between {
                justify-content: space-between;
                margin-bottom: 40px;
            }

            & > * {
                margin-left: 35px;

                &:first-child {
                    margin-left: 0;
                }
            }

            .filter {
                display: flex;
                align-items: center;
                justify-content: flex-start;

                &__text {
                    font-size: 14px;
                    line-height: 20px;
                    color: #5b6067;
                    margin-right: 6px;
                }

                &__dropdown {
                    position: relative;
                    bottom: -1px;

                    .dropdown {
                        position: relative;
                        cursor: pointer;

                        &__selected {
                            font-size: 14px;
                            line-height: 20px;
                            color: #333333;
                            display: flex;
                            align-items: center;

                            &:after {
                                content: "";
                                background-image: url("data:image/svg+xml,%3Csvg width='8' height='4' viewBox='0 0 8 4' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M4 4L3.49691e-07 2.54292e-07L8 9.53674e-07L4 4Z' fill='%23333333'/%3E%3C/svg%3E%0A");
                                width: 8px;
                                height: 4px;
                                display: block;
                                margin-left: 4px;
                            }

                            span {
                                border-bottom: 1px dashed #333;
                            }
                            &.opened + .dropdown__list {
                                display: block;
                            }
                        }

                        &__list {
                            display: none;
                            position: absolute;
                            top: 100%;
                            left: -15px;
                            background: #ffffff;
                            z-index: 3;
                            border: 1px solid #7B95A7;
                            padding: 4px 0;
                            margin: 6px 0 0;
                        }
                        &__item {
                            font-size: 14px;
                            line-height: 30px;
                            color: #333333;
                            padding: 0 14px;
                            -webkit-transition: background 0.3s;
                            transition: background 0.3s;
                            text-align: left;
                            white-space: nowrap;
                            &:hover {
                                background: #F1F8FC;
                            }
                        }
                    }
                }

                .button {
                    margin: -15px 0 0;
                }
            }
        }

        &__content {
            margin-bottom: 60px;

            & > * {
                margin-top: 60px;

                &:first-child {
                    margin-top: 0;
                }
            }

            & > .--ticket {
                margin-top: 35px;

                &:first-child {
                    margin-top: 0;
                }
            }
        }

        &__pagination {
        }
    }
</style>