<template>
  <div class="user-achievment">
    <template v-if="addNew===undefined">
      <div class="user-achievment__icon"></div>
      <div class="user-achievment__text">
        <span>{{text}}</span>
      </div>
    </template>
    <template v-else>
      <a href="#">
        <div class="user-achievment__icon user-achievment__icon_add"></div>
        <div class="user-achievment__text">
          <span>Добавить награду</span>
        </div>
      </a>
    </template>
  </div>
</template>

<script>
export default {
  props: ["text", "addNew"]
};
</script>

<style lang="scss">
@import "./../../styles/mixins.scss";
.user-achievment {
  display: flex;
  justify-content: flex-start;
  align-items: center;

  &__icon {
    background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='30' cy='30' r='28.5' fill='white' stroke='%237B95A7' stroke-width='3'/%3E%3Cpath d='M30 16.618L32.8922 25.5193L33.0044 25.8647H33.3677H42.727L35.1552 31.366L34.8613 31.5795L34.9735 31.925L37.8657 40.8262L30.2939 35.325L30 35.1115L29.7061 35.325L22.1343 40.8262L25.0265 31.925L25.1387 31.5795L24.8448 31.366L17.273 25.8647H26.6323H26.9956L27.1078 25.5193L30 16.618Z' fill='%237B95A7' stroke='%237B95A7'/%3E%3C/svg%3E%0A");
    display: block;
    width: 60px;
    height: 60px;
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;

    &.user-achievment__icon_add {
      background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle opacity='0.3' cx='30' cy='30' r='29' fill='white' stroke='%237B95A7' stroke-width='2'/%3E%3Cpath opacity='0.3' fill-rule='evenodd' clip-rule='evenodd' d='M32 18H28V28H18V32H28V42H32V32H42V28H32V18Z' fill='%237B95A7'/%3E%3C/svg%3E%0A");
    }
  }

  &__text {
    display: block;
    max-width: calc(100% - 70px);
    margin-left: 10px;
    font-size: 14px;
    line-height: 20px;
    color: #333333;
  }

  a {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    width: 100%;
  }
}
</style>