<template>
  <a :href="objectLink" class="user-object">
    <div class="user-object__image">
      <div class="image" v-bind:style="{'background-image': 'url(' + objectImg + ')'}"></div>
      <div class="type" v-bind:style="{'background-image': 'url(' + objectTypeImg + ')'}"></div>
    </div>
    <div class="user-object__description">
      <div class="user-object__title">
        <span>{{objectTitle}}</span>
      </div>
      <div class="user-object__params">
        <div class="user-object__param">
          <span>{{objectTypeText}}</span>
        </div>
        <div class="user-object__param">
          <span>{{objectDate}}</span>
        </div>
        <div class="user-object__param">
          <span>комментариев {{objectComments}}</span>
        </div>
        <div class="user-object__param">
          <span>жалоб {{objectReports}}</span>
        </div>
      </div>
    </div>
  </a>
</template>

<script>
export default {
  props: [
    "objectLink",
    "objectTypeImg",
    "objectImg",
    "objectTitle",
    "objectTypeText",
    "objectDate",
    "objectComments",
    "objectReports"
  ],
  created: function() {
    console.log(this.objectTypeImg);
  }
};
</script>

<style lang="scss">
@import "./../../styles/mixins.scss";

.user-object {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;

  &__image {
    width: 110px;
    position: relative;

    .image {
      width: 100%;
      height: 80px;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      position: relative;
      z-index: 1;
    }

    .type {
      position: absolute;
      top: 0;
      left: 0;
      z-index: 2;
      width: 30px;
      height: 30px;
      background-position: center;
      background-size: cover;
      background-repeat: no-repeat;
    }
  }

  &__description {
    flex: 1 0 auto;
    max-width: calc(100% - 150px);
    margin-left: 40px;
  }

  &__title {
    font-weight: bold;
    font-size: 18px;
    line-height: 20px;
    color: #333333;
    min-height: 40px;
    margin-top: 6px;
  }

  &__params {
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    justify-content: flex-start;
    flex-wrap: wrap;
    margin-top: 12px;
  }

  &__param {
    font-size: 14px;
    line-height: 20px;
    color: #5b6067;
    margin-left: 30px;

    &:first-child {
      margin-left: 0;
      width: 140px;
    }
  }
}
</style>