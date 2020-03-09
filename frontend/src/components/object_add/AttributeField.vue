<template>
    <div class="add-object__line" :class="{'--lrg': !!title}">
        <div class="col">
            <label class="add-object__label" v-if="title">{{ title }}</label>
            <span class="add-object__label-text" v-if="title && subTitle">{{ subTitle }}</span>
            <label class="add-object__label --gray" v-if="!title && subTitle">{{subTitle}}</label>
        </div>
        <div class="col --small">
            <div class="select">
                <select v-model="val">
                    <option v-for="option in options" :key="option.value" :value="option.value">{{ option.text }}
                    </option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AttributeField",
        props: [
            'title',
            'subTitle',
            'value'
        ],
        computed: {
            val: {
                get() {
                    return this.value
                },
                set(v) {
                    this.$emit('input', v)
                }
            },
            options() {
                return [
                    {value: 'unknown', text: 'Не знаю'},
                    {value: 'not_provided', text: 'Не предусмотрено'},
                    {value: 'no', text: 'Нет'},
                    {value: 'yes', text: 'Да'},
                ]
            }
        }
    }
</script>

<style scoped>

</style>