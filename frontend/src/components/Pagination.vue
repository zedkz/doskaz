<template>
  <div class="pagination">
    <button class="pagination__prev">
      <span>← Ctrl</span>
    </button>
    <button class="pagination__btn">
      <span>1</span>
    </button>
    <button class="pagination__btn pagination__btn_active">
      <span>2</span>
    </button>
    <button class="pagination__btn">
      <span>3</span>
    </button>
    <button class="pagination__btn">
      <span>4</span>
    </button>
    <button class="pagination__btn">
      <span>...</span>
    </button>
    <button class="pagination__btn">
      <span>16</span>
    </button>
    <button class="pagination__next">
      <span>Ctrl →</span>
    </button>
  </div>
</template>

<script>
export default {};
</script>

<style lang="scss">
@import "./../styles/mixins.scss";

.pagination {
  display: flex;
  width: 100%;
  justify-content: center;
  align-items: center;

  & > * {
    margin-left: 10px;

    &:first-child {
      margin-left: 0;
    }
  }

  &__btn,
  &__prev,
  &__next {
    border: none;
    flex: none;
    min-width: 40px;
    height: 40px;
    background: #f1f8fc;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 16px;
    line-height: 20px;
    color: #5b6067;
    padding: 0 15px;
    cursor: pointer;
    transition: background 0.3s, color 0.3s;

    &.pagination__btn_active {
      background: #0f6bf5;
      font-weight: 500;
      span {
        color: #fff;
      }
    }

    &:hover {
      background: #0f6bf5;
      span {
        color: #fff;
      }
    }
  }
}
</style>