<template>
  <div class="user-page">
    <MainHeader />
    <div
      class="user-page__header"
      v-bind:style="{'background-image': 'url(' + require('./../assets/user-bg.png') + ')'}"
    >
      <div class="menu">
        <div class="container">
          <div class="menu__content">
            <a href="#" class="menu__item isActive">
              <span>Достижения</span>
            </a>
            <a href="#" class="menu__item">
              <span>Мои объекты</span>
            </a>
            <a href="#" class="menu__item">
              <span>Мои тикеты</span>
            </a>
            <a href="#" class="menu__item">
              <span>Мои задания</span>
            </a>
            <a href="#" class="menu__item">
              <span>Мои комментарии</span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="user-page__row">
        <div class="user-page__profile">
          <UserProfile />
          <UserLevel />
          <UserTask />
        </div>
        <div class="user-page__tabs">
          <UserAchievments />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import MainHeader from "./../components/MainHeader";
import UserProfile from "./../components/user/UserProfile";
import UserLevel from "./../components/user/UserLevel";
import UserTask from "./../components/user/UserTask";
import UserAchievments from "./../components/user/UserAchievments";

export default {
  components: {
    MainHeader,
    UserProfile,
    UserLevel,
    UserTask,
    UserAchievments
  }
};
</script>

<style lang="scss">
@import "./../styles/mixins.scss";

.user-page {
  overflow-x: hidden;

  &__header {
    width: 100%;
    min-height: 180px;
    background-size: cover;
    background-position: center;
    position: relative;
    display: flex;
    align-items: flex-end;

    .menu {
      height: 50px;
      width: 100%;
      background: rgba(0, 0, 0, 0.7);

      &__content {
        margin-left: 450px;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        margin-right: -450px;
      }

      &__item {
        padding: 0 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 16px;
        line-height: 20px;
        color: #ffffff;
        height: 50px;

        &.isActive, &:hover {
          background: transparentize(#0f6bf5, 0.25);
        }
      }
    }
  }

  &__row {
    display: flex;
    justify-content: flex-start;
    align-items: flex-start;
    flex-direction: row;
  }

  &__profile {
    width: 390px;
    position: relative;
    top: -110px;

    & > div {
      margin-top: 10px;

      &:first-child {
        margin-top: 0;
      }
    }
  }

  &__tabs {
    flex: 1 0 auto;
    max-width: calc(100% - 450px);
    margin-left: 60px;
  }
}
</style>