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
                    <UserComments />
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
    import UserComments from "./../components/user/UserComments";

    export default {
        components: {
            MainHeader,
            UserPageHeader,
            UserProfile,
            UserLevel,
            UserTask,
            UserComments
        }
    };
</script>