<template>
    <UserTickets/>
</template>

<script>
    import UserTickets from "@/components/user/UserTickets";

    export default {
        components: {
            UserTickets
        }
    };
</script>

<style lang="scss">
    @import "@/styles/mixins.scss";

    .user-page {
        .main-header__content {
            border: none;
        }
    }
</style>