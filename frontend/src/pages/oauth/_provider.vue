<template>
    <client-only>
        <oauth/>
    </client-only>
</template>

<script>
    import Oauth from "../../components/Oauth";
    export default {
        name: "_provider",
        components: {Oauth}
    }
</script>

<style scoped>

</style>