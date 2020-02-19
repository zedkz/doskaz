<template>
    <div style="max-width: 800px">
        <div class="row pb-3" v-for="category in categories" :key="category.key">
            <div class="col-md-8">{{category.title}}</div>
            <div class="col-md-4">
                <b-badge variant="success" v-if="score[category.key] === 'full_accessible'">Доступно</b-badge>
                <b-badge variant="warning" v-if="score[category.key] === 'partial_accessible'">Частично доступно</b-badge>
                <b-badge variant="danger" v-if="score[category.key] === 'not_accessible'">Недоступно</b-badge>
                <b-badge variant="secondary" v-if="score[category.key] === 'not_provided'">Не предусмотрено</b-badge>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AccessibilityScore",
        props: [
            'attributes',
            'type'
        ],
        data() {
            return {
                score: {}
            }
        },
        watch: {
            attributes: {
                async handler(v) {
                    const {data} = await this.$axios.post('/api/objects/calculateZoneScore', v)
                    this.score = data
                },
                immediate: true,
                deep: true
            }
        },
        computed: {
            categories() {
                return [
                    {key: 'movement', title: 'Люди, передвигающиеся на кресло-коляске'},
                    {key: 'limb', title: 'Люди с нарушением опорно-двигательного аппарата'},
                    {key: 'vision', title: 'Люди с нарушениями зрения'},
                    {key: 'hearing', title: 'Люди с нарушениями слуха'},
                    {key: 'intellectual', title: 'Люди с интелектуальной инвалидностью'},
                ]
            }
        }
    }
</script>

<style scoped>

</style>
