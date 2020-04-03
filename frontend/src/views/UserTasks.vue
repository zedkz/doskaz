<template>
    <div class="user-page">
        <MainHeader />
        <UserPageHeader />
        <div class="container">
            <div class="user-page__row">
                <div class="user-page__profile">
                    <UserProfile />
                    <UserLevel />
                    <UserTask />
                </div>
                <div class="user-page__tabs">
                    <UserTasks />
                </div>
            </div>
        </div>
        <div class="popup__wrapper" v-if="addTaskPopup">
            <div class="popup__scroll">
                <div class="popup__in">
                    <span class="popup__close" v-on:click="addTaskPopup = false"></span>
                    <h5 class="popup__title">Первое задание</h5>
                    <p class="popup__text">Заполните свой профиль и получите 50 баллов!</p>
                    <button type="button" class="user-page__button">Начать задание</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import MainHeader from "./../components/MainHeader";
    import UserPageHeader from "./../components/user/UserPageHeader"
    import UserProfile from "./../components/user/UserProfile";
    import UserLevel from "./../components/user/UserLevel";
    import UserTask from "./../components/user/UserTask";
    import UserTasks from "./../components/user/UserTasks";

    export default {
        data() {
          return {
              addTaskPopup: true
          }
        },
        components: {
            MainHeader,
            UserPageHeader,
            UserProfile,
            UserLevel,
            UserTask,
            UserTasks
        }
    };
</script>

<style lang="scss">
    @import "./../styles/mixins.scss";
</style>