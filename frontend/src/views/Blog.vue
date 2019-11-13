<template>
  <div class="blog">
    <MainHeader />

    <div class="container">
        <BlogMain />
    </div>
  </div>

</template>

<script>
import MainHeader from "./../components/MainHeader";
import BlogMain from "./../components/blog/BlogMain";

export default {
  components: {
    MainHeader,
    BlogMain
  }
};
</script>

<style lang="scss">
@import "./../styles/mixins.scss";

</style>