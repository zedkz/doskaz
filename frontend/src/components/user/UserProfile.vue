<template>
  <div class="user-profile">
    <div class="user-profile__content" v-bind:class="{ '--verified': isVerified }">

      <div class="user-profile__favorites" v-if="isAchievement">
        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="30" cy="30" r="30" fill="white" />
          <path d="M30 15L33.3677 25.3647H44.2658L35.4491 31.7705L38.8168 42.1353L30 35.7295L21.1832 42.1353L24.5509 31.7705L15.7342 25.3647H26.6323L30 15Z" fill="#7B95A7"/>
        </svg>
      </div>

      <div class="user-profile__icon" v-if="avatarLoadedCheck == 1" v-bind:style="{'background-image': 'url(' + require('./../../assets/img/user/av' + defaultAvatarType + '.svg') + ')'}">
        <div class="user-profile__icon-edit">
          <span class="user-profile__icon-link" v-on:click="popupAvatarDefault">Обновить фотографию</span>
          <span class="user-profile__icon-link" v-on:click="avatarDelete">Удалить</span>
        </div>
      </div>

      <div class="user-profile__icon" v-if="avatarLoadedCheck == 2" v-bind:style="{'background-image': 'url(' + require('./../../assets/img/user/default.svg') + ')'}">
        <div class="user-profile__icon-edit">
          <span class="user-profile__icon-link" v-on:click="popupAvatarDefault">Обновить фотографию</span>
        </div>
      </div>

      <div class="user-profile__icon --hl" v-if="avatarLoadedCheck == 3" v-bind:style="{'background-image': 'url(' + require('./../../assets/user.png') + ')'}"> <!-- загруженная аватарка -->
        <div class="user-profile__icon-edit">
          <span class="user-profile__icon-link">Обновить фотографию</span>
          <span class="user-profile__icon-link" v-on:click="avatarDelete">Удалить</span>
        </div>
      </div>

      <div class="user-profile__icon" v-if="avatarLoadedCheck == 4" v-bind:style="{'background-image': 'url(' + require('./../../assets/img/user/default.svg') + ')'}">
        <div class="user-profile__icon-edit">
          <span class="user-profile__icon-link">Обновить фотографию</span>
        </div>
      </div>

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
      <div class="user-profile__edit" v-if="currentPage != '/user/profile/edit'">
        <a href="#">
          <span>Редактировать анкету</span>
        </a>
      </div>

      <div class="popup__wrapper" v-show="popupAvatar">
        <div class="popup__in">
          <span class="popup__close" v-on:click="popupAvatar = false"></span>
          <p class="popup__text">Выберите себе аватар. Учтите, что сменить его вы сможете только на 7 уровне :)</p>
          <div class="user-profile__avatar-list">
            <span v-bind:style="{'background-image': 'url(' + require('./../../assets/img/user/av1.svg') + ')'}" v-on:click="setDefaultAvatar('1')" class="user-profile__avatar"></span>
            <span v-bind:style="{'background-image': 'url(' + require('./../../assets/img/user/av2.svg') + ')'}" v-on:click="setDefaultAvatar('2')" class="user-profile__avatar"></span>
            <span v-bind:style="{'background-image': 'url(' + require('./../../assets/img/user/av3.svg') + ')'}" v-on:click="setDefaultAvatar('3')" class="user-profile__avatar"></span>
            <span v-bind:style="{'background-image': 'url(' + require('./../../assets/img/user/av4.svg') + ')'}" v-on:click="setDefaultAvatar('4')" class="user-profile__avatar"></span>
            <span v-bind:style="{'background-image': 'url(' + require('./../../assets/img/user/av5.svg') + ')'}" v-on:click="setDefaultAvatar('5')" class="user-profile__avatar"></span>
            <span v-bind:style="{'background-image': 'url(' + require('./../../assets/img/user/av6.svg') + ')'}" v-on:click="setDefaultAvatar('6')" class="user-profile__avatar"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isAchievement: false,
      isVerified: true,
      userLevel: 6,
      isAvatarLoaded: false,
      defaultAvatarType: 0,
      popupAvatar: false
    }
  },
  computed: {
    currentPage(){
      return this.$route.path;
    },
    avatarLoadedCheck(){
      var avatarType = 0;

      if ( this.userLevel < 7 ) {
        this.isAvatarLoaded ? (avatarType =  1) : (avatarType = 2);
      }
      else {
        this.isAvatarLoaded ? (avatarType =  3) : (avatarType = 4);
      }

      return avatarType;
    }
  },
  methods: {
    setDefaultAvatar: function (av) { // здесь еще надо сохранить эти значения
      this.isAvatarLoaded = true;
      this.defaultAvatarType = av;
    },
    popupAvatarDefault: function() { //
      this.popupAvatar = true;
    },
    avatarDelete: function () {  // здесь еще надо сохранить эти значения
      this.isAvatarLoaded = false;
      this.defaultAvatarType = 0;
    }
  }
};
</script>

<style lang="scss">
@import "./../../styles/mixins.scss";

.user-profile {
  background: #f1f8fc;
  padding: 40px 40px 35px;
  width: 100%;
  position: relative;

  &__avatar {
    width: 120px;
    height: 120px;
    background-position: center;
    background-size: 100%;
    margin: 30px 0 0;
    cursor: pointer;
    &-list {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
    }
  }

  &__content {
    &.--verified:before {
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
    font-size: 0;

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
    position: relative;
    display: block;
    width: 250px;
    height: 250px;
    border-radius: 50%;
    margin: 0 auto;
    background-color: #ffffff;
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    overflow: hidden;
    text-align: center;
    font-size: 0;
    &-link {
      display: block;
      font-size: 14px;
      line-height: 20px;
      color: #ffffff;
      cursor: pointer;
      transition: opacity 0.3s;
      &:hover {
        opacity: 0.7;
      }
      & + .user-profile__icon-link {
        margin: 10px 0 0;
      }
    }
    &-edit {
      padding: 15px 0 0;
      position: absolute;
      width: 250px;
      height: 90px;
      background: rgba(0,0,0,0.8);
      bottom: 0;
      left: 0;
      display: none;
    }
    &.--hl {
       border: 4px solid #9348f2;
    }
    &:hover {
      .user-profile__icon-edit {
        display: block;
      }
    }
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