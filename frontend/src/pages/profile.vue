<template>
    <div class="user-page">
        <MainHeader />
        <user-page-header />
        <div class="container">
            <div class="user-page__row">
                <div class="user-page__profile">
                    <UserProfile />
                    <UserLevel />
                    <UserTask />
                </div>
                <div class="user-page__tabs">
                    <nuxt-child/>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import MainHeader from "~/components/MainHeader";
    import UserPageHeader from "~/components/user/UserPageHeader.vue"
    import UserProfile from "~/components/user/UserProfile";
    import UserLevel from "~/components/user/UserLevel";
    import UserTask from "~/components/user/UserTask";
    import UserObjects from "~/components/user/UserObjects";

    export default {
        middleware: ['authenticated'],
        components: {
            MainHeader,
            UserPageHeader,
            UserProfile,
            UserLevel,
            UserTask,
            UserObjects
        },
        async fetch({store}) {
           await store.dispatch('authentication/loadUser')
        }
    }
</script>

<style lang="scss">
    @import "@/styles/mixins.scss";

    .user-page {
        .main-header__content {
            border: none;
        }
    }
</style>