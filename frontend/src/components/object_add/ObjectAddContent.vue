<template>
    <div class="container">
        <loading is-full-page :active="isLoading"></loading>
        <div class="add-object__form">
            <div class="add-object__step-wrapper">
                <div class="add-object__step">
                    <div class="step" v-for="(step, index) in stepsShow"
                         :class="{ checked: step.checked, current: step.isCurrent}"
                         :key="index">
                        <div class="step-progress"></div>
                    </div>
                </div>
                <div class="add-object__step-info">
                    <div
                            class="step"
                            v-for="(step, index) in stepsShow"
                            :class="{ active: false }"
                            :key="index">
                        {{ step.title }}
                    </div>
                </div>
            </div>
            <div class="add-object__top">
                <span class="add-object__top-step">Шаг {{ currentStepNumber }} из {{ stepsShow.length }}</span> <h4
                    class="add-object__top-title">{{ activeStep.title }}</h4>
            </div>

            <keep-alive>
                <component
                        :is="stepComponent"
                        :categories="categories"
                        :value="form[currentStepKey]"
                        :key="`${currentStepKey}${form.form}`"
                        :errors="violations[currentStepKey]"
                        @is-photos-uploading="photosUploading = $event"
                />
            </keep-alive>
            <div class="add-object__button-b">
                <nuxt-link
                        :to="{name: 'index'}"
                        type="button"
                        class="add-object__button --cancel"
                        v-show="activeStepIndex === 0"
                >
                    <span>Отмена</span>
                </nuxt-link>
                <button type="button" class="add-object__button --prev" v-show="activeStepIndex > 0" @click="prevStep">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="5" viewBox="0 0 20 5" fill="none">
                        <g clip-path="url(#clip0)">
                            <path d="M7.5 0.680096L7.5 4.3199L1.67631 2.5L7.5 0.680096Z" fill="white" stroke="white"/>
                            <path d="M8.0002 2.5L19.2002 2.5" stroke="white" stroke-width="1.5" stroke-miterlimit="10"
                                  stroke-linecap="round"/>
                        </g>
                        <defs>
                            <clipPath id="clip0">
                                <path d="M20 5L0 5L-4.37114e-07 1.74846e-06L20 0L20 5Z" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                    <span>Назад</span>
                </button>
                <button type="button" class="add-object__button --dub" v-if="showDuplicateEntranceStepButton"
                        @click="duplicateEntranceStep">
                    <span>Дублировать шаг</span></button>
                <button type="button" class="add-object__button --next"
                        v-if="activeStepIndex + 1 < availableSteps.length"
                        @click="nextStep">
                    <span>Далее </span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="5" viewBox="0 0 20 5" fill="none">
                        <g clip-path="url(#clip0)">
                            <path d="M12.5 4.3199V0.680095L18.3237 2.5L12.5 4.3199Z" fill="white" stroke="white"/>
                            <path d="M11.9998 2.5H0.799805" stroke="white" stroke-width="1.5" stroke-miterlimit="10"
                                  stroke-linecap="round"/>
                        </g>
                        <defs>
                            <clipPath id="clip0">
                                <path d="M0 0H20V5H0V0Z" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                </button>
                <button type="button" class="add-object__button --submit"
                        v-if="activeStepIndex + 1 === availableSteps.length"
                        @click.prevent="submit">
                    <span>Готово!</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import First from "./FirstStep";
    import zonesMiddle from './zones/middle';
    import zonesFull from './zones/full';
    import set from 'lodash/set'
    import uniqBy from 'lodash/uniqBy'
    import Loading from "vue-loading-overlay";
    import "vue-loading-overlay/dist/vue-loading.css";
    import {call} from 'vuex-pathify'

    const zones = {
        middle: zonesMiddle,
        full: zonesFull
    };

    const steps = [
        {key: 'first', title: 'Общая информация', group: 'first'},
        {key: 'parking', title: 'Парковка', group: 'parking'},
        {key: 'entrance1', title: 'Входная группа', group: 'entrance'},
        {key: 'entrance2', title: 'Входная группа', group: 'entrance'},
        {key: 'entrance3', title: 'Входная группа', group: 'entrance'},
        {key: 'movement', title: 'Пути движения по объекту', group: 'movement'},
        {key: 'service', title: 'Зона оказания услуги', group: 'service'},
        {key: 'toilet', title: 'Туалет', group: 'toilet'},
        {key: 'navigation', title: 'Навигация', group: 'navigation'},
        {key: 'serviceAccessibility', title: 'Доступность услуги', group: 'serviceAccessibility'},
    ];

    export default {
        components: {
            Loading
        },
        props: [
            'categories',
            'formVariant'
        ],
        data() {
            return {
                isLoading: false,
                photosUploading: false,
                currentStepKey: 'first',
                errors: [],
                form: {
                    form: this.formVariant,
                    first: {
                        categoryId: null,
                        videos: [''],
                        photos: []
                    },
                    parking: {
                        attributes: {}
                    },
                    entrance1: {
                        attributes: {}
                    },
                    entrance2: null,
                    entrance3: null,
                    movement: {
                        attributes: {}
                    },
                    service: {
                        attributes: {}
                    },
                    toilet: {
                        attributes: {}
                    },
                    navigation: {
                        attributes: {}
                    },
                    serviceAccessibility: {
                        attributes: {}
                    }
                }
            };
        },
        methods: {
            ...call('objectAdding', [
                'init'
            ]),
            nextStep() {
                const index = this.availableSteps.indexOf(this.activeStep);
                if (this.availableSteps[index + 1]) {
                    this.currentStepKey = this.availableSteps[index + 1].key
                }
            },
            prevStep() {
                const index = this.availableSteps.indexOf(this.activeStep);
                if (this.availableSteps[index - 1]) {
                    this.currentStepKey = this.availableSteps[index - 1].key
                }
            },
            async submit() {
                this.isLoading = true;
                const unwatch = this.$watch('photosUploading', async (v) => {
                    if (v) {
                        return;
                    }
                    try {
                        await this.$axios.post('/api/objects/add', this.form);
                        await this.$router.push({name: 'index'})
                    } catch (e) {
                        if (e.response && e.response.status === 400) {
                            this.errors = e.response.data.errors.violations;
                            this.currentStepKey = Object.keys(this.violations)[0];
                        }
                    } finally {
                        this.isLoading = false;
                        unwatch();
                    }
                }, {immediate: true});
            },
            duplicateEntranceStep() {
                if (!this.form.entrance2) {
                    this.form.entrance2 = {
                        attributes: {}
                    };
                    return;
                }
                if (!this.form.entrance3) {
                    this.form.entrance3 = {
                        attributes: {}
                    };
                }
            }
        },
        computed: {
            showDuplicateEntranceStepButton() {
                if (this.activeStep.group === 'entrance') {
                    switch (this.activeStep.key) {
                        case 'entrance1':
                            return !this.form.entrance2;
                        case 'entrance2':
                            return !this.form.entrance3
                    }
                }
                return false;
            },
            activeStep() {
                return this.steps2.find(step => step.key === this.currentStepKey);
            },
            steps2() {
                return steps
            },
            activeStepIndex() {
                return this.availableSteps.indexOf(this.activeStep)
            },
            availableSteps() {
                return this.steps2.filter(step => !!this.form[step.key]);
            },
            stepsShow() {
                const activeStep = this.activeStep;
                const activeIndex = this.steps2.indexOf(activeStep);
                const filteredSteps = this.steps2
                    .map((step, index) => ({
                        ...step,
                        isCurrent: activeStep.group === step.group,
                        checked: index < activeIndex
                    }));
                return uniqBy(filteredSteps, step => step.group)
            },
            currentStepNumber() {
                const current = this.stepsShow.find(step => step.isCurrent);
                return this.stepsShow.indexOf(current) + 1;
            },
            violations() {
                const violations = {};

                this.errors.forEach(e => {
                    set(violations, e.propertyPath, e.title)
                });
                return violations;
            },
            stepComponent() {
                if(this.currentStepKey === 'first') {
                    return First
                }
                return zones[this.form.form][this.activeStep.group]
            }
        },
        watch: {
            currentStepKey() {
                window.scrollTo({top: 0})
            },
            formVariant(v) {
                this.form.form = v
            }
        }
    }
</script>

<style lang="scss">
    @import "@/styles/mixins.scss";

    .--av-green {
        .add-object__rating {
            &:before {
                background: $green;
                right: 15px;
            }

            &:after {
                background: url('data:image/svg+xml;base64, PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSItNTM5IDEwOTEgMjAgMjAiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgLTUzOSAxMDkxIDIwIDIwOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQoJPHBhdGggZmlsbD0iIzNEQkEzQiIgZD0iTS01MjksMTA5MWMtNS41LDAtMTAsNC41LTEwLDEwczQuNSwxMCwxMCwxMHMxMC00LjUsMTAtMTBTLTUyMy41LDEwOTEtNTI5LDEwOTF6IE0tNTMwLDExMDVsLTMuNy0zLjhsMS41LTEuNWwyLjIsMi4zbDQuOC01bDEuNSwxLjVMLTUzMCwxMTA1eiIvPg0KCTxwb2x5Z29uIGZpbGw9IiNGRkZGRkYiIHBvaW50cz0iLTUzMCwxMTAyIC01MzIuMiwxMDk5LjcgLTUzMy43LDExMDEuMiAtNTMwLDExMDUgLTUyMy43LDEwOTguNiAtNTI1LjIsMTA5NyIvPg0KPC9zdmc+DQo=');
                right: 15px;
                margin: 0 -10px 0 0;
            }
        }

        .--text-green {
            display: block;
        }
    }

    .--av-yellow {
        .add-object__rating {
            &:before {
                background: $yellow;
                width: 50%;
            }

            &:after {
                background: url('data:image/svg+xml;base64, PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSItNTM5IDEwOTEgMjAgMjAiIHdpZHRoPSIyMHB4IiBoZWlnaHQ9IjIwcHgiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgLTUzOSAxMDkxIDIwIDIwOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQoJPHBhdGggZmlsbD0iI0Y4QUMxQSIgZD0iTS01MjksMTA5MWMtNS41LDAtMTAsNC41LTEwLDEwczQuNSwxMCwxMCwxMHMxMC00LjUsMTAtMTBTLTUyMy41LDEwOTEtNTI5LDEwOTF6IE0tNTIzLDExMDNoLTEydi00aDEyVjExMDN6Ii8+DQoJPHJlY3QgZmlsbD0iI0ZGRkZGRiIgeD0iLTUzNSIgeT0iMTA5OSIgY2xhc3M9InN0MSIgd2lkdGg9IjEyIiBoZWlnaHQ9IjQiLz4NCjwvc3ZnPg0K');
                left: 50%;
                margin: 0 0 0 -10px;
            }
        }

        .--text-yellow {
            display: block;
        }
    }

    .--av-red {
        .add-object__rating {
            &:before {
                background: $red;
                width: 15px;
            }

            &:after {
                background: url('data:image/svg+xml;base64, PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSItNTM5IDEwOTEgMjAgMjAiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgLTUzOSAxMDkxIDIwIDIwOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQoJPHBhdGggZmlsbD0iI0RFMTIyMCIgZD0iTS01MjksMTA5MWMtNS41LDAtMTAsNC41LTEwLDEwczQuNSwxMCwxMCwxMHMxMC00LjUsMTAtMTBTLTUyMy41LDEwOTEtNTI5LDEwOTF6IE0tNTI1LDExMDMuNmwtMS40LDEuNGwtMi42LTIuNmwtMi42LDIuNmwtMS40LTEuNGwyLjYtMi42bC0yLjYtMi42bDEuNC0xLjRsMi42LDIuNmwyLjYtMi42bDEuNCwxLjRsLTIuNiwyLjZMLTUyNSwxMTAzLjZ6Ii8+DQoJPHBvbHlnb24gZmlsbD0iI0ZGRkZGRiIgcG9pbnRzPSItNTI2LjQsMTA5NyAtNTI5LDEwOTkuNiAtNTMxLjYsMTA5NyAtNTMzLDEwOTguNCAtNTMwLjQsMTEwMSAtNTMzLDExMDMuNiAtNTMxLjYsMTEwNSAtNTI5LDExMDIuNCAtNTI2LjQsMTEwNSAtNTI1LDExMDMuNiAtNTI3LjYsMTEwMSAtNTI1LDEwOTguNCIvPg0KPC9zdmc+DQo=');
                left: 15px;
                margin: 0 0 0 -10px;
            }
        }

        .--text-red {
            display: block;
        }
    }

    .add-object {
        .step {
            -ms-flex-preferred-size: 0;
            flex-basis: 0;
            -ms-flex-positive: 1;
            flex-grow: 1;
            max-width: 100%;
        }

        &__textarea {
            width: 100%;
            display: block;
            min-height: 120px;
            border: 1px solid $stroke;
            padding: 14px 20px;
            font-size: 16px;
            line-height: 20px;
        }

        &__rating {
            width: 150px;
            height: 10px;
            position: relative;
            padding: 0 15px;
            margin: 5px 0 0;
            background: $light-gray;
            border-radius: 10px;

            span {
                display: block;
                height: 10px;
                width: 120px;
                position: relative;
                border-left: 1px solid rgba(123, 149, 167, 0.3);
                border-right: 1px solid rgba(123, 149, 167, 0.3);

                &:before {
                    content: '';
                    position: absolute;
                    width: 1px;
                    height: 100%;
                    left: 50%;
                    background: rgba(123, 149, 167, 0.3);
                }
            }

            &-text {
                position: absolute;
                font-size: 16px;
                line-height: 20px;
                left: 100%;
                top: 0;
                margin: 0 0 0 40px;
                display: none;
                white-space: nowrap;
            }

            &:before {
                content: '';
                position: absolute;
                width: auto;
                left: 0;
                top: 0;
                opacity: 0.5;
                height: 100%;
                overflow: hidden;
                -webkit-border-radius: 10px 0 0 10px;
                -moz-border-radius: 10px 0 0 10px;
                border-radius: 10px 0 0 10px;
            }

            &:after {
                content: '';
                display: block;
                width: 20px;
                height: 20px;
                position: absolute;
                top: -5px;
            }
        }

        &__text {
            font-size: 16px;
            line-height: 20px;
        }

        &__title {
            font-weight: bold;
            font-size: 22px;
            line-height: 30px;
            margin: 0 0 -5px;

            &.--lrg {
                font-size: 32px;
                line-height: 40px;
                margin: 10px 0 0;
            }

            &.--label {
                font-size: 16px;
                line-height: 20px;
                margin: 10px 0 -10px;
            }
        }

        &__button {
            &-b {
                width: 670px;
                margin: 56px 0 0;
                display: flex;
                justify-content: space-between;
            }

            transition: opacity 0.4s;
            cursor: pointer;
            width: 180px;
            height: 50px;
            line-height: 50px;
            text-align: center;
            border: none;
            outline: none;

            &:hover {
                opacity: 0.7;
            }

            span {
                display: inline-block;
                vertical-align: middle;
                font-size: 16px;
                color: #fff;
            }

            &.--cancel {
                background: $stroke;
            }

            &.--next {
                background: $blue;
                padding: 0 30px 0 0;
                text-align: right;

                svg {
                    display: inline-block;
                    vertical-align: middle;
                    margin: 0 0 0 22px;
                }
            }

            &.--prev {
                background: $stroke;
                padding: 0 0 0 30px;
                text-align: left;

                svg {
                    display: inline-block;
                    vertical-align: middle;
                    margin: 0 22px 0 0;
                }
            }

            &.--dub {
                width: 230px;
                background: $blue;
            }

            &.--submit {
                background: $green;
            }
        }

        &__error {
            display: none;
            position: absolute;
            left: 100%;
            margin: 0 0 0 40px;
            background: $red;
            padding: 15px 20px;
            color: #fff;
            line-height: 20px;
            font-size: 16px;
            white-space: nowrap;
            z-index: 2;

            &:before {
                content: '';
                position: absolute;
                left: -10px;
                top: 50%;
                margin: -10px 0 0;
                border-right: 10px solid $red;
                border-top: 10px solid transparent;
                border-bottom: 10px solid transparent;
            }
        }

        &__label {
            font-weight: bold;
            font-size: 16px;
            line-height: 20px;
            padding: 15px 50px 0 0;
            display: block;

            &.--gray {
                font-size: 16px;
                line-height: 20px;
                color: $text;
                font-weight: 400;
            }

            &-text {
                font-size: 12px;
                line-height: 20px;
                color: #5B6067;
                display: block;
                padding: 0 50px 0 0;
            }
        }

        &__step {
            background: $light-gray;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            height: 10px;
            border-radius: 10px;
            overflow: hidden;

            .step {
                position: relative;

                &-progress {
                    position: absolute;
                    background: $blue;
                    width: 0;
                    left: 0;
                    top: 0;
                    height: 100%;
                    -webkit-border-radius: 0 10px 10px 0;
                    -moz-border-radius: 0 10px 10px 0;
                    border-radius: 0 10px 10px 0;
                }

                &:before {
                    content: '';
                    position: absolute;
                    left: 0;
                    top: 0;
                    height: 100%;
                    width: 1px;
                    background: rgba(123, 149, 167, 0.3);
                }

                &:first-child {
                    &:before {
                        display: none;
                    }
                }

                &.checked {
                    .step-progress {
                        width: 100%;
                    }

                    & + .checked, & + .--progresses {
                        .step-progress {
                            &:before {
                                content: '';
                                height: 100%;
                                position: absolute;
                                background: $blue;
                                width: 10px;
                                left: -10px;
                                top: 0;
                            }
                        }
                    }
                }
            }

            &-info {
                display: -ms-flexbox;
                display: flex;
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
                margin: 7px 0 0;

                .step {
                    font-size: 12px;
                    line-height: 16px;
                    color: $text;
                    padding: 0 24px 0 0;
                    text-align: left;

                    &.active {
                        font-weight: 700;
                    }
                }
            }
        }

        &__form {
            background: #ffffff;
            padding: 60px 40px;
        }

        &__link {
            cursor: pointer;
            padding: 14px 23px 16px 19px;
            margin: 0 0 0 20px;
            border: 1px solid $light-gray;
            -webkit-transition: background 0.4s;
            -moz-transition: background 0.4s;
            -ms-transition: background 0.4s;
            -o-transition: background 0.4s;
            transition: background 0.4s;
            background: transparent;

            &:first-child {
                margin: 0;
            }

            &:hover, &.active {
                background: $light-gray;
            }

            &-b {
                margin: 34px 0 0;
                display: flex;
                justify-content: flex-start;
                align-items: baseline;
            }
        }

        &__content {
            margin: 30px 0 0;
            width: 670px;
        }

        &__top {
            margin: 46px 0 0;
            display: flex;
            color: $black;
            align-items: flex-end;

            &-step {
                font-weight: bold;
                font-size: 18px;
                line-height: 20px;
                margin: 0 0 5px 0;
                width: 110px;
            }

            &-title {
                font-weight: 600;
                font-size: 48px;
                line-height: 50px;
                margin: 0;
            }
        }

        &__line {
            display: flex;
            position: relative;
            margin: 20px 0 0;

            &.--lrg {
                margin: 40px 0 0;
            }

            &:first-child {
                margin: 0;
            }

            &.error {
                .add-object__error {
                    display: block;
                }
            }

            .col {
                position: relative;
                -ms-flex-preferred-size: 0;
                flex-basis: 0;
                -ms-flex-positive: 1;
                flex-grow: 1;
                max-width: 100%;

                input {
                    width: 100%;
                }

                &.--long {
                    min-width: 500px;
                    max-width: 500px;
                }

                &.--small {
                    min-width: 150px;
                    max-width: 150px;
                }
            }

            .input input {
                font-size: 16px;
            }

            .select select {
                font-size: 16px;
            }

            .photo-input {
                margin: 0 25px 25px 0;

                &:nth-child(5n) {
                    margin: 0 0 25px;
                }

                &__wrapper {
                    margin: 0 0 -25px;
                }
            }

            .add-link {
                margin: 15px 0 0;
            }
        }

        &__info {
            position: absolute;
            right: -80px;
            width: 40px;
            height: 40px;
            top: 5px;
            z-index: 1;

            &-icon {
                display: block;
                cursor: pointer;
                svg {
                    display: block;
                }
            }

            &-text {
                font-size: 14px;
                line-height: 20px;
                background: $light-gray;
                position: absolute;
                width: 390px;
                padding: 15px 20px;
                top: 55px;
                left: 0;
                display: none;
                &:before {
                    content: '';
                    position: absolute;
                    width: 0;
                    height: 0;
                    bottom: 100%;
                    left: 10px;
                    border-bottom: 10px solid $light-gray;
                    border-right: 10px solid transparent;
                    border-left: 10px solid transparent;
                }
            }
            &.--selected {
                z-index: 2;
                .add-object__info-text {
                    display: block;
                }
            }
        }
    }
</style>