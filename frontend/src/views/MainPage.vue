<template>
  <div class="main-page">
    <IntroForm />

    <LoginForm />

    <StartCategoryForm />

    <ObjectModal></ObjectModal>

    <div class="main-page__map">
      <MainMap />
    </div>

    <Sidebar></Sidebar>

    <div class="main-page__options">
      <button class="button button_blue" type="button" name="add_object">
        <svg
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M12 0C7.34756 0 3.5625 3.78506 3.5625 8.4375V17.4375C3.5625 21.0561 6.50644 24 10.125 24C13.7436 24 16.6875 21.0561 16.6875 17.4375V16.9209L19.1903 12.8538C20.0062 11.5278 20.4375 10.0007 20.4375 8.4375C20.4375 3.78506 16.6524 0 12 0ZM17.9926 12.1167L15.2812 16.5229V17.4375C15.2812 20.2807 12.9682 22.5938 10.125 22.5938C7.28184 22.5938 4.96875 20.2807 4.96875 17.4375V8.4375C4.96875 4.56047 8.12297 1.40625 12 1.40625C15.877 1.40625 19.0312 4.56047 19.0312 8.4375C19.0312 9.74034 18.6721 11.0126 17.9926 12.1167Z"
            fill="white"
          />
          <path
            d="M12 2.8125C8.89838 2.8125 6.375 5.33588 6.375 8.4375V12.5156H7.07812C7.85353 12.5156 8.48438 13.1465 8.48438 13.9219C8.48438 14.6973 7.85353 15.3281 7.07812 15.3281H6.375V17.4375C6.375 19.5052 8.05725 21.1875 10.125 21.1875C12.1927 21.1875 13.875 19.5052 13.875 17.4375V16.1249L16.795 11.3797C17.338 10.4973 17.625 9.47995 17.625 8.4375C17.625 5.33588 15.1016 2.8125 12 2.8125ZM12.4688 17.4375C12.4688 18.7298 11.4173 19.7812 10.125 19.7812C8.83266 19.7812 7.78125 18.7298 7.78125 17.4375V16.6454C8.99297 16.3324 9.89062 15.23 9.89062 13.9219C9.89062 12.6137 8.99297 11.5113 7.78125 11.1983V9.18614C10.4226 9.52936 12.4688 11.7789 12.4688 14.4943V17.4375ZM15.5973 10.6427L13.8085 13.5497C13.6048 12.105 12.9354 10.7683 11.8725 9.71428C10.7663 8.61731 9.35344 7.94428 7.83314 7.77637C8.15147 5.76309 9.89869 4.21875 12 4.21875C14.3262 4.21875 16.2188 6.11128 16.2188 8.4375C16.2188 9.21956 16.0039 9.98208 15.5973 10.6427Z"
            fill="white"
          />
        </svg>
      </button>
      <button class="button button_blue" type="button" name="add_object">
        <svg
          width="23"
          height="27"
          viewBox="0 0 23 27"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M15.3966 3.14371H10.5734C10.1619 3.14371 9.82812 3.4775 9.82812 3.88933V22.9635C9.82812 23.3753 10.1619 23.7091 10.5734 23.7091H15.3966C15.8085 23.7091 16.1423 23.3753 16.1423 22.9635C16.1423 22.5517 15.8085 22.2179 15.3966 22.2179H11.3194V4.63465H15.3966C15.8085 4.63465 16.1423 4.30085 16.1423 3.88903C16.1423 3.47721 15.8085 3.14371 15.3966 3.14371Z"
            fill="white"
          />
          <path
            d="M7.40638 8.68995H1.01509C0.603566 8.68995 0.269775 9.02374 0.269775 9.43556V17.3492C0.269775 17.7611 0.603566 18.0948 1.01509 18.0948H7.40638C7.8179 18.0948 8.1517 17.7611 8.1517 17.3492V9.43556C8.1517 9.02374 7.8179 8.68995 7.40638 8.68995ZM1.76101 10.1809H6.66076V16.6036H1.76101V10.1809Z"
            fill="white"
          />
          <path
            d="M18.501 0.0389519C16.378 0.0389519 14.6506 1.76547 14.6506 3.88808C14.6506 6.011 16.3777 7.7384 18.501 7.7384C20.6242 7.7384 22.3516 6.01129 22.3516 3.88808C22.3513 1.76547 20.6242 0.0389519 18.501 0.0389519ZM18.501 6.24717C17.1999 6.24717 16.1419 5.18913 16.1419 3.88808C16.1419 2.58793 17.1999 1.53018 18.501 1.53018C19.802 1.53018 20.8603 2.58793 20.8603 3.88808C20.8603 5.18883 19.8017 6.24717 18.501 6.24717Z"
            fill="white"
          />
          <path
            d="M18.501 9.54289C16.378 9.54289 14.6506 11.2691 14.6506 13.3911C14.6506 15.514 16.3777 17.2415 18.501 17.2415C20.6242 17.2415 22.3516 15.5143 22.3516 13.3911C22.3513 11.2691 20.6242 9.54289 18.501 9.54289ZM18.501 15.7502C17.1999 15.7502 16.1419 14.6922 16.1419 13.3911C16.1419 12.0913 17.1999 11.0341 18.501 11.0341C19.802 11.0341 20.8603 12.0913 20.8603 13.3911C20.8603 14.6922 19.8017 15.7502 18.501 15.7502Z"
            fill="white"
          />
          <path
            d="M18.501 19.1137C16.378 19.1137 14.6506 20.8402 14.6506 22.9626C14.6506 25.0858 16.3777 26.8135 18.501 26.8135C20.6242 26.8135 22.3516 25.0861 22.3516 22.9626C22.3513 20.8402 20.6242 19.1137 18.501 19.1137ZM18.501 25.3222C17.1999 25.3222 16.1419 24.2639 16.1419 22.9626C16.1419 21.6624 17.1999 20.605 18.501 20.605C19.802 20.605 20.8603 21.6624 20.8603 22.9626C20.8603 24.2636 19.8017 25.3222 18.501 25.3222Z"
            fill="white"
          />
          <path
            d="M15.3965 12.6806H7.40631C6.99419 12.6806 6.6604 13.0144 6.6604 13.4263C6.6604 13.8381 6.99419 14.1719 7.40631 14.1719H15.3965C15.8084 14.1719 16.1421 13.8381 16.1421 13.4263C16.1421 13.0144 15.8084 12.6806 15.3965 12.6806Z"
            fill="white"
          />
        </svg>
      </button>
    </div>

    <div class="main-page__actions">
      <button class="button button_green" type="button" name="add_object">
        <svg
          width="20"
          height="20"
          viewBox="0 0 20 20"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M12.5 0H7.5V7.5H0V12.5H7.5V20H12.5V12.5H20V7.5H12.5V0Z"
            fill="white"
          />
        </svg>
      </button>
      <router-link :to="{name: 'complaint'}" class="button button_red" >
        <svg
          width="19"
          height="21"
          viewBox="0 0 19 21"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M15.5527 5.65379C16.2218 5.65379 16.7643 5.11137 16.7643 4.44225C16.7643 3.77314 16.2218 3.23071 15.5527 3.23071C14.8836 3.23071 14.3412 3.77314 14.3412 4.44225C14.3412 5.11137 14.8836 5.65379 15.5527 5.65379Z"
            fill="white"
          />
          <path
            d="M12.322 3.23082C12.9911 3.23082 13.5335 2.68839 13.5335 2.01928C13.5335 1.35016 12.9911 0.807739 12.322 0.807739C11.6529 0.807739 11.1105 1.35016 11.1105 2.01928C11.1105 2.68839 11.6529 3.23082 12.322 3.23082Z"
            fill="white"
          />
          <path
            d="M9.09118 2.42308C9.76029 2.42308 10.3027 1.88065 10.3027 1.21154C10.3027 0.542424 9.76029 0 9.09118 0C8.42206 0 7.87964 0.542424 7.87964 1.21154C7.87964 1.88065 8.42206 2.42308 9.09118 2.42308Z"
            fill="white"
          />
          <path
            d="M5.86046 4.03843C6.52958 4.03843 7.072 3.49601 7.072 2.82689C7.072 2.15778 6.52958 1.61536 5.86046 1.61536C5.19135 1.61536 4.64893 2.15778 4.64893 2.82689C4.64893 3.49601 5.19135 4.03843 5.86046 4.03843Z"
            fill="white"
          />
          <path
            d="M14.3412 4.44232V9.69232C14.3412 9.91524 14.1603 10.0962 13.9374 10.0962C13.7145 10.0962 13.5336 9.91524 13.5336 9.69232V2.01924H11.1105V8.88462C11.1105 9.10755 10.9296 9.28847 10.7066 9.28847C10.4837 9.28847 10.3028 9.10755 10.3028 8.88462V1.21155H7.87971V8.88462C7.87971 9.10755 7.69878 9.28847 7.47586 9.28847C7.25294 9.28847 7.07201 9.10755 7.07201 8.88462V2.82693H4.64894V12.9231L3.01336 10.685C2.52874 9.93786 1.58294 9.68747 0.889937 10.1155C0.19936 10.5533 0.0281296 11.508 0.506283 12.2527C0.506283 12.2527 3.14421 16.2451 4.26851 17.9542C5.39282 19.6633 7.21417 21 10.6202 21C16.2595 21 16.7643 16.6449 16.7643 15.3462C16.7643 14.0474 16.7643 4.44232 16.7643 4.44232H14.3412Z"
            fill="white"
          />
        </svg>
      </router-link>
    </div>

    <slot/>
  </div>
</template>

<script>
import IntroForm from "./../components/IntroForm.vue";
import LoginForm from "./../components/LoginForm.vue";
import StartCategoryForm from "./../components/StartCategoryForm.vue";
import Sidebar from "./../components/Sidebar.vue";
import ObjectModal from "./../components/ObjectModal.vue";
import MainMap from "./../components/MainMap.vue";

export default {
  data() {
    return {};
  },
  name: 'mainPage',
  components: {
    IntroForm,
    LoginForm,
    StartCategoryForm,
    Sidebar,
    ObjectModal,
    MainMap
  },
  mounted() {
    if(this.$route.name === 'login') {
      this.$store.dispatch('showLoginForm')
    }
  },
  watch: {
    '$store.state.authentication.user'(value) {
      if(value) {
        if(this.$route.name === 'login' && this.$route.query.next) {
          this.$router.push(this.$route.query.next)
        }
      }
    }
  },
};
</script>

<style lang="scss">
@import "./../styles/mixins.scss";

.main-page {
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  background: #e5e5e5;
  overflow: hidden;

  &__map {
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    z-index: 1;
  }

  &__options {
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    align-items: center;
    position: absolute;
    top: 20px;
    right: 20px;
    background: $white;
    padding: 20px;
    z-index: 10;

    .button {
      border: none;
      width: 40px;
      height: 40px;
      display: flex;
      flex-direction: row;
      justify-content: center;
      align-items: center;
      cursor: pointer;
      transition: opacity 0.3s;
      margin-right: 20px;

      &:last-child {
        margin-right: 0;
      }

      &:hover {
        opacity: 0.7;
      }

      &_red {
        background: $red;
      }
      &_green {
        background: $green;
      }
      &_blue {
        background: $blue;
      }
    }
  }

  &__actions {
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    align-items: center;
    position: absolute;
    bottom: 20px;
    right: 20px;
    z-index: 10;

    .button {
      border: none;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      display: flex;
      flex-direction: row;
      justify-content: center;
      align-items: center;
      cursor: pointer;
      transition: opacity 0.3s;
      margin-right: 10px;

      &:last-child {
        margin-right: 0;
      }

      &:hover {
        opacity: 0.7;
      }

      &_red {
        background: $red;
      }
      &_green {
        background: $green;
      }
      &_blue {
        background: $blue;
      }
    }
  }
}
</style>