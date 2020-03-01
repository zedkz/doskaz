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
        components: {LoginForm}
    }
</script>

<style scoped>

</style>