<template>
  <div class="lang-select">
    <div class="lang-select__selected" @click="selectLang = !selectLang">
      <span>Qaz</span>
      <svg width="8" height="4" viewBox="0 0 8 4" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M4 4L3.49691e-07 2.54292e-07L8 9.53674e-07L4 4Z" fill="#333333" />
      </svg>
    </div>
    <div class="lang-select__list" v-if="selectLang">
      <div class="lang-select__item selected">
        <span>Qaz</span>
      </div>
      <div class="lang-select__item">
        <span>Русский</span>
      </div>
      <div class="lang-select__item">
        <span>English</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      selectLang: false
    };
  }
};
</script>

<style lang="scss">
@import "./../styles/mixins.scss";

.lang-select {
  position: relative;
  cursor: pointer;

  &__selected {
    display: flex;
    align-items: center;
    justify-content: flex-end;

    span {
      font-size: 14px;
      line-height: 20px;
      color: #333333;
    }

    svg {
      display: block;
      margin-left: 4px;
    }
  }

  &__list {
     display: block;
     position: absolute;
     top: 100%;
     left: -15px;
     background: #ffffff;
     z-index: 3;
     border: 1px solid $stroke;
     padding: 10px 0;
  }

  &__item {
    font-size: 14px;
    line-height: 30px;
    color: #333333;
    padding: 0 14px;
    transition: background 0.3s;
    text-align: left;
    width: 98px;

    &:hover, &.selected {
      background: $light-gray;
      font-weight: 700;
    }
  }
}
</style>