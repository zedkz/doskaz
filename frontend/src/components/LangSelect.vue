<template>
  <div class="lang-select">
    <div class="lang-select__selected">
      <span>Kaz</span>
      <svg width="8" height="4" viewBox="0 0 8 4" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M4 4L3.49691e-07 2.54292e-07L8 9.53674e-07L4 4Z" fill="#333333" />
      </svg>
    </div>
    <div class="lang-select__list">
      <div class="lang-select__item">
        <span>Kaz</span>
      </div>
      <div class="lang-select__item">
        <span>Рус</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
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
    display: none;
    position: absolute;
    top: 0;
    right: 0;
    background: $white;
    z-index: 1;
    border: 1px solid #7b95a7;

    &.isOpened {
      display: block;
    }
  }

  &__item {
    font-size: 14px;
    line-height: 20px;
    color: #333333;
    padding: 0 14px;
    transition: background 0.3s;
    text-align: right;

    &:hover {
      background: rgba(0, 0, 0, 0.1);
    }
  }
}
</style>