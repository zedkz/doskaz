<template>
  <div class="user-profile">
    <div class="user-profile__content">
      <div class="user-profile__favorites">
        <svg
          width="60"
          height="60"
          viewBox="0 0 60 60"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <circle cx="30" cy="30" r="30" fill="white" />
          <path
            d="M30 15L33.3677 25.3647H44.2658L35.4491 31.7705L38.8168 42.1353L30 35.7295L21.1832 42.1353L24.5509 31.7705L15.7342 25.3647H26.6323L30 15Z"
            fill="#7B95A7"
          />
        </svg>
      </div>
      <div
        class="user-profile__icon"
        v-bind:style="{'background-image': 'url(' + require('./../../assets/user.png') + ')'}"
      ></div>
      <div class="user-profile__name">
        <span>kudaibergenov almas</span>
      </div>
      <div class="user-profile__title">
        <span>Помогая другим, помогаешь себе</span>
      </div>
      <div class="user-profile__email">
        <span>kudaibergenov@gmail.com</span>
      </div>
      <div class="user-profile__phone">
        <span>+7 747 563-26-87</span>
      </div>
      <div class="user-profile__edit">
        <a href="#">
          <span>Редактировать анкету</span>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style lang="scss">
@import "./../../styles/mixins.scss";

.user-profile {
  background: #f1f8fc;
  padding: 40px 40px 35px;
  width: 100%;
  position: relative;

  &__content {
    &:before {
      content: "";
      background-image: url("data:image/svg+xml,%3Csvg width='50' height='70' viewBox='0 0 50 70' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0H50V70L25 60L0 70V0Z' fill='%237AB73F'/%3E%3Cpath fill-rule='evenodd' clip-rule='evenodd' d='M13 30.6733L25.5712 43L38 30.638L34.5812 27L25.5712 35.936L16.49 27.0353L13 30.6733Z' fill='white'/%3E%3C/svg%3E%0A");
      position: absolute;
      top: 0;
      left: 40px;
      width: 50px;
      height: 70px;
      z-index: 1;
    }
  }

  &__favorites {
    position: absolute;
    right: 70px;
    top: 40px;
    cursor: pointer;

    path {
      transition: fill 0.3s;
    }

    &:hover {
      path {
        fill: $yellow;
      }
    }
  }

  &__icon {
    display: block;
    width: 250px;
    height: 250px;
    border-radius: 50%;
    margin: 0 auto;
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    border: 4px solid #9348f2;
  }

  &__name {
    font-weight: bold;
    font-size: 32px;
    line-height: 40px;
    color: #333333;
    margin-top: 28px;
  }

  &__title {
    margin-top: 26px;
    font-weight: bold;
    font-size: 16px;
    line-height: 20px;
    color: #333333;
  }

  &__email,
  &__phone {
    margin-top: 20px;
    font-size: 16px;
    line-height: 20px;
    color: #333333;
  }

  &__edit {
    margin-top: 30px;
    font-size: 14px;
    line-height: 20px;
    color: #5b6067;

    a {
      color: #5b6067;
      transition: opacity 0.3s;

      &:hover {
        opacity: 0.7;
      }
    }
  }
}
</style>