<template>
    <div>Обработка...</div>
</template>

<script>
    export default {
        name: "Oauth",
        mounted() {
            this.authenticate()
        },
        methods: {
            async authenticate() {
                const {code} = this.$route.query;
                const {provider} = this.$route.params;
                await this.$store.dispatch('authentication/oauthAuthenticate', {code, provider});
                window.close()
            }
        }
    }
</script>

<style scoped>

</style>