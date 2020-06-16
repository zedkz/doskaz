<template>
    <div class="blog">
        <ViTop/>
        <MainHeader/>

        <div class="container">
            <nuxt/>
        </div>
    </div>

</template>
<script>
    import MainHeader from "@/components/MainHeader";
    import ViTop from "@/components/ViTop";
    export default {
        components: {MainHeader, ViTop}
    }
</script>

<style lang="scss">
    @import "../styles/mixins.scss";
</style>