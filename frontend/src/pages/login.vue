<template>
    <client-only>
        <LoginForm/>
    </client-only>
</template>

<script>
    import LoginForm from "@/components/LoginForm";
    export default {
        layout: 'main',
        name: "login",
        components: {LoginForm},
        head: {
           title: 'Вход'
        }
    }
</script>

<style scoped>

</style>