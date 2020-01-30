<template>
    <div class="blog">
        <MainHeader/>

        <div class="container">
            <nuxt/>
        </div>
    </div>

</template>
<script>
    import MainHeader from "@/components/MainHeader";
    export default {
        components: {MainHeader}
    }
</script>

<style lang="scss">
    @import "../styles/mixins.scss";
</style>