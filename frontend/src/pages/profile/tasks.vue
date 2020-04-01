<template>
    <div>
        <UserTasks :pages="pages" :items="items"/>
        <div class="popup__wrapper" v-if="addTaskPopup">
            <div class="popup__in">
                <span class="popup__close" v-on:click="addTaskPopup = false"></span>
                <h5 class="popup__title">Первое задание</h5>
                <p class="popup__text">Заполните свой профиль и получите 50 баллов!</p>
                <button type="button" class="user-page__button">Начать задание</button>
            </div>
        </div>
    </div>
</template>

<script>
    import UserTasks from "@/components/user/UserTasks";

    export default {
        data() {
            return {
                addTaskPopup: false
            }
        },
        components: {
            UserTasks
        },
        async asyncData({$axios}) {
            const {data} = await $axios.get('/api/profile/tasks')
            return data;
        }
    };
</script>

<style lang="scss">
    @import "@/styles/mixins.scss";
</style>