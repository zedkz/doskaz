<template>
    <div :class="{loading: isLoading}">
        <loading :active="isLoading"
                 background-color="#e8e8e8"
                 :can-cancel="false"
                 :is-full-page="false"></loading>

        <div class="alert alert-danger" v-if="operationState === 'fail'">Произошла ошибка. Пожалуйста повторите позже</div>
        <div class="alert alert-success" v-if="operationState === 'success'">Данные успешно обновлены</div>
        <slot/>
    </div>
</template>

<script>

    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/vue-loading.css';

    export default {
        name: "Edit",
        components: {
            Loading
        },
        props: [
            'resourceName',
            'resourceId'
        ],
        mounted() {
            this.$store.dispatch(`${this.resourceName}/edit/load`, this.resourceId)
        },
        computed: {
            isLoading() {
                return this.$store.state[this.resourceName].edit.isLoading
            },
            operationState() {
                return this.$store.state[this.resourceName].edit.operationState
            }
        }
    }
</script>

<style scoped>
    .loading {
        min-height: 100px
    }
</style>