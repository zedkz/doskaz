<template>
  <div class="login-form" :class="{'isOpened': true}">
    <div class="login-form__bg"></div>
    <div class="login-form__content">
      <div class="login-form__card">
        <div class="close" @click="loginFormClose">
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
              d="M16.6667 4.008e-06L20 3.33334L13.3333 10L20 16.6667L16.6667 20L10 13.3333L3.33333 20L0 16.6667L6.66667 10L0 3.33333L3.33333 0L10 6.66667L16.6667 4.008e-06Z"
              fill="white"
            />
          </svg>
        </div>
        <div class="header">
          <div class="header__title">
            <span>
              Доступный Казахстан —
              сделайте свой город ближе
            </span>
          </div>
          <div class="header__img">
            <img :src="require('./../assets/login-logo.svg')" alt />
          </div>
        </div>
        <div class="buttons">
          <a class="button button_google" @click.prevent="authenticate(providers.google)">
            <svg
              width="20"
              height="20"
              viewBox="0 0 20 20"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <circle cx="10" cy="10" r="10" fill="white" />
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M6.01712 10C6.01712 9.54538 6.09259 9.10941 6.22745 8.70056L3.86823 6.89905C3.40841 7.83256 3.14941 8.88453 3.14941 10C3.14941 11.1147 3.4082 12.1659 3.86724 13.0989L6.22515 11.2938C6.0916 10.8869 6.01712 10.4525 6.01712 10Z"
                fill="#FBBC05"
              />
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M10.1594 5.86366C11.1471 5.86366 12.0393 6.21366 12.7403 6.78634L14.7795 4.75C13.5369 3.66817 11.9437 3 10.1594 3C7.38912 3 5.00824 4.58419 3.86823 6.899L6.22733 8.70052C6.77093 7.05048 8.32044 5.86366 10.1594 5.86366Z"
                fill="#EA4335"
              />
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M10.1594 14.1364C8.32055 14.1364 6.77104 12.9496 6.22744 11.2996L3.86823 13.1007C5.00824 15.4159 7.38912 17.0001 10.1594 17.0001C11.8691 17.0001 13.5015 16.3929 14.7266 15.2554L12.4873 13.5242C11.8554 13.9223 11.0597 14.1364 10.1594 14.1364Z"
                fill="#34A853"
              />
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M16.8506 9.99998C16.8506 9.58633 16.7868 9.14084 16.6912 8.72729H10.1594V11.4318H13.9192C13.7312 12.354 13.2196 13.0628 12.4873 13.5242L14.7266 15.2553C16.0136 14.061 16.8506 12.2817 16.8506 9.99998Z"
                fill="#4285F4"
              />
            </svg>
            <span>Войти через Google</span>
          </a>
          <button class="button">
            <svg
              width="10"
              height="20"
              viewBox="0 0 10 20"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M6.6 6.6V4.9C6.6 4 6.7 3.5 8.1 3.5H9.9V0H7C3.5 0 2.2 1.7 2.2 4.5V6.6H0V10H2.2V20H6.6V10H9.5L10 6.6H6.6Z"
                fill="#4267B2"
              />
            </svg>
          </button>
          <button class="button">
            <svg
              width="20"
              height="20"
              viewBox="0 0 20 20"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M19.2152 4.49854H15.9697C15.8373 4.49854 15.7073 4.53446 15.5936 4.60246C15.4799 4.67047 15.3868 4.76803 15.3242 4.88475C15.3242 4.88475 14.0297 7.26863 13.614 8.07157C12.4954 10.2316 11.7711 9.55346 11.7711 8.55099V5.09445C11.7711 4.80561 11.6563 4.5286 11.4521 4.32436C11.2478 4.12012 10.9708 4.00538 10.682 4.00538H8.24183C7.90952 3.98067 7.57641 4.04133 7.27414 4.18159C6.97186 4.32185 6.71047 4.53706 6.51477 4.80677C6.51477 4.80677 7.75385 4.60643 7.75385 6.27598C7.75385 6.68998 7.77518 7.88096 7.79461 8.87988C7.79827 9.02708 7.75668 9.17186 7.67545 9.29468C7.59422 9.41749 7.47726 9.51243 7.34036 9.56666C7.20346 9.62089 7.05322 9.63181 6.90992 9.59795C6.76662 9.56409 6.63716 9.48707 6.53902 9.37729C5.54022 7.98814 4.71288 6.48342 4.07498 4.89584C4.0202 4.77708 3.9325 4.67652 3.82229 4.6061C3.71208 4.53568 3.58398 4.49835 3.45319 4.49854C2.74935 4.49854 1.3409 4.49854 0.504463 4.49854C0.423353 4.49799 0.343323 4.51714 0.271246 4.55434C0.199169 4.59154 0.137201 4.64569 0.0906655 4.71212C0.0441302 4.77855 0.0144189 4.85529 0.004084 4.93574C-0.00625086 5.01619 0.00309974 5.09795 0.0313325 5.17399C0.926709 7.63 4.7837 15.3481 9.18608 15.3481H11.039C11.2332 15.3481 11.4194 15.271 11.5567 15.1337C11.6939 14.9964 11.7711 14.8102 11.7711 14.6161V13.4972C11.7711 13.3568 11.8121 13.2196 11.8892 13.1022C11.9663 12.9849 12.076 12.8927 12.2048 12.837C12.3336 12.7813 12.4759 12.7645 12.6142 12.7886C12.7525 12.8128 12.8807 12.8769 12.9829 12.973L15.2008 15.0568C15.4 15.2439 15.663 15.3481 15.9363 15.3481H18.8488C20.2534 15.3481 20.2534 14.3734 19.4876 13.6192C18.9486 13.0883 17.0037 11.0383 17.0037 11.0383C16.8371 10.8658 16.7378 10.6393 16.7236 10.3999C16.7094 10.1605 16.7814 9.92397 16.9264 9.73297C17.555 8.90568 18.5833 7.55147 19.0194 6.97133C19.6154 6.17838 20.6942 4.49854 19.2152 4.49854Z"
                fill="#4A76A8"
              />
            </svg>
          </button>
          <button class="button">
            <svg
              width="20"
              height="18"
              viewBox="0 0 20 18"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M9.69998 4.49996C9.69998 4.69996 9.69998 4.79996 9.69998 4.89996C9.69998 4.69996 9.69998 4.59996 9.69998 4.49996ZM19.2 2.69996C18 3.19996 17.8 3.09996 18.4 2.39996C18.8 1.89996 19.4 0.999959 19.4 0.799959C19.4 0.799959 19.2 0.799959 18.9 0.999959C18.6 1.19996 18.1 1.39996 17.6 1.49996L16.8 1.79996L16.1 1.29996C15.7 0.999959 15.2 0.699959 14.9 0.599959C14.2 0.399959 13.1 0.399959 12.4 0.699959C10.7 1.29996 9.59997 2.99996 9.69998 4.99996V5.69996L8.99998 5.59996C6.39998 5.29996 4.19998 4.09996 2.19998 2.09996L1.29998 1.09996L0.999976 1.79996C0.499976 3.49996 0.799976 5.19996 1.89998 6.29996C2.49998 6.99996 2.39998 7.09996 1.39998 6.69996C0.999976 6.59996 0.699976 6.49996 0.699976 6.49996C0.599976 6.59996 0.899976 7.99996 1.19998 8.59996C1.59998 9.39996 2.29998 10.1 3.19998 10.5L3.89998 10.9H3.09998C2.29998 10.9 2.29998 10.9 2.39998 11.2C2.69998 12.2 3.79998 13.2 5.09998 13.7L5.89998 14L5.09998 14.5C3.99998 15.2 2.59998 15.6 1.29998 15.6C0.699975 15.6 0.0999756 15.7 0.0999756 15.7C0.0999756 15.9 1.79998 16.7 2.89998 17C5.99998 18 9.59998 17.6 12.3 15.9C14.2 14.7 16.2 12.3 17.1 9.99996C17.6 8.79996 18.1 6.49996 18.1 5.39996C18.1 4.69996 18.1 4.59996 18.9 3.79996C19.4 3.29996 19.8 2.79996 19.9 2.59996C20 2.39996 20 2.39996 19.2 2.69996ZM9.69998 4.19996C9.69998 4.09996 9.69998 4.09996 9.69998 4.19996V4.19996Z"
                fill="#1DA1F2"
              />
            </svg>
          </button>
        </div>
        <div class="phone-form">
          <div class="phone-form__switch">
            <span>Или войдите с помощью телефона</span>
          </div>
          <phone-auth-form/>
        </div>
        <div class="phone-form">
          <div class="phone-form__switch">
            <span>Продолжите регистрацию и заполните свой профиль</span>
            <phone-auth-form-points/>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import PhoneAuthForm from "./PhoneAuthForm";
  import PhoneAuthFormPoints from "./PhoneAuthFormPoints";
  import openPopup from '@/oauth/popup';
  import providers from '@/oauth/providers';

  export default {
    components: {PhoneAuthForm,PhoneAuthFormPoints},
    watch: {
      '$store.state.authentication.user'(value) {
        if(value) {
          this.isOpened = false
        }
      }
    },
    methods: {
      loginFormClose() {
        this.$router.push({name: 'index'})
        //this.$store.dispatch('hideLoginForm')
      },
      async authenticate(provider) {
          await openPopup(provider.url, provider.popupOptions);
          await this.$store.dispatch('loadUser')
      }
    },
    computed: {
      isOpened() {
        return this.$store.state.authentication.showLoginForm
      },
      providers() {
        return providers
      }
    }
  };
</script>

<style lang="scss" scoped>
@import "./../styles/mixins.scss";
.login-form {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 1100;
  display: none;

  &.isOpened {
    display: block;
  }

  &__bg {
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    z-index: 0;
    background: rgba(0, 0, 0, 0.7);
  }

  &__content {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  &__card {
    background: $white;
    position: relative;
    width: 550px;

    .close {
      position: absolute;
      top: 0;
      right: -40px;
      cursor: pointer;
      transition: opacity 0.3s;

      &:hover {
        opacity: 0.7;
      }
    }

    .header {
      width: 100%;
      height: 140px;
      background: #d5e9fc;
      display: flex;
      align-items: flex-end;
      justify-content: space-between;
      padding: 10px 10px 10px 40px;

      &__title {
        font-weight: bold;
        font-size: 22px;
        line-height: 30px;
        color: #333333;
        width: 300px;
        padding-bottom: 10px;
      }
    }

    .buttons {
      padding: 40px 40px 30px;
      display: flex;
      align-items: center;
      justify-content: space-between;

      .button {
        width: 50px;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #7b95a7;
        background: $tr;
        transition: opacity 0.3s;
        cursor: pointer;

        &:hover {
          opacity: 0.7;
        }

        &.button_google {
          width: 260px;
          background: #0f6bf5;
          border: none;

          svg {
            margin-right: 10px;
          }

          span {
            font-weight: bold;
            font-size: 16px;
            line-height: 20px;
            text-align: center;
            color: #ffffff;
          }
        }

        svg {
          display: block;
        }
      }
    }

    .phone-form {
      padding: 0 40px 40px;

      &__switch {
        font-weight: bold;
        font-size: 16px;
        line-height: 20px;
        text-align: center;
        color: #333333;
      }
    }
  }
}
</style>