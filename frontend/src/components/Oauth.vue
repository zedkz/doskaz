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
                try {
                    await this.$store.dispatch('oauthAuthenticate', {code, provider});
                } finally {
                    this.$router.replace({name: 'main'})
                }
            }
        }
    }
</script>

<style scoped>

</style>