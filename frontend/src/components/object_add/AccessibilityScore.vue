<template>
    <div style="margin-top: 40px">
        <div class="add-object__line --lrg">
            <h5 class="add-object__title --lrg">Оценка доступности зоны</h5>
        </div>

        <div class="add-object__line" v-for="(category, index) in categories" :key="category.key"
             :class="{'--lrg': index > 0, '--av-green': score[category.key] ==='full_accessible',
               '--av-yellow': score[category.key] ==='partial_accessible',
               '--av-red': score[category.key] ==='not_accessible' }">
            <div class="col">
                <p class="add-object__text">{{ category.title }}</p>
            </div>
            <div class="col --small">
                <div class="add-object__rating">
                    <span></span>
                </div>
            </div>
            <div class="add-object__rating-text --text-green">доступно</div>
            <div class="add-object__rating-text --text-yellow">частично доступно</div>
            <div class="add-object__rating-text --text-red">не доступно</div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AccessibilityScore",
        props: ['type', 'attributes'],
        data() {
            return {
                score: {}
            }
        },
        watch: {
            attributes: {
                handler() {
                    this.calculateScore()
                },
                deep: true,
                immediate: true
            }
        },
        methods: {
            async calculateScore() {
                const {data} = await this.$axios.post('/api/objects/calculateZoneScore', {
                    type: this.type,
                    attributes: this.attributes
                });
                this.score = data;
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