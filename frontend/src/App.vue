<template>
  <div id="app">
    <router-view />
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  components: {}
};
</script>


<style lang="scss">
@import "./styles/mixins.scss";

//main styles
* {
  outline: none;
  -webkit-appearance: none;
  font-family: "Roboto", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  box-sizing: border-box;
}

h3 {
  font-weight: bold;
  font-size: 22px;
  line-height: 30px;
  color: $black;
  margin: 0;
}

h1 {
  font-weight: bold;
  font-size: 32px;
  line-height: 40px;
  color: $black;
  margin: 0;
}

p {
  font-size: 16px;
  line-height: 30px;
  color: $black;
  margin: 0;
}

a {
  text-decoration: none;
}

.spacer {
  flex: 1 0 auto;
}
</style>
