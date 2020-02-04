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

  &__download {
    line-height: 20px;
    font-size: 14px;
    color: $text;
    padding: 0 0 0 30px;
    background: url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjIiIGhlaWdodD0iMjEiIHZpZXdCb3g9IjAgMCAyMiAyMSIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEwLjk2MjkgMS4xOTYzNkMxMS4zNTg1IDEuMzkyNzIgMTEuMjU5NiAxLjY4NzI1IDExLjE2MDcgMi45NjM1OEMxMS4wNjE4IDQuMzM4MDkgMTAuNTY3NCA2LjY5NDM4IDkuNjc3MzggOS4wNTA2OEM4Ljc4NzM5IDExLjQwNyA3LjQwMjk3IDEzLjc2MzMgNi4yMTYzMiAxNS40MzIzQzUuMDI5NjcgMTcuMTk5NSA0LjA0MDc5IDE4LjI3OTUgMy4yNDk2OSAxOC45NjY4QzIuNTU3NDggMTkuNjU0IDEuOTY0MTUgMTkuODUwNCAxLjY2NzQ5IDE5Ljg1MDRDMS4zNzA4MyAxOS45NDg2IDEuMTczMDUgMTkuODUwNCAxLjA3NDE3IDE5LjY1NEMwLjk3NTI3OCAxOS40NTc3IDAuOTc1Mjc4IDE5LjE2MzEgMS4wNzQxNyAxOC44Njg2QzEuMTczMDUgMTguNDc1OSAxLjM3MDgzIDE4LjA4MzIgMS44NjUyNyAxNy41OTIzQzIuMzU5NyAxNy4xMDE0IDMuMjQ5NjkgMTYuNDE0MSA0LjUzNTIzIDE1LjgyNUM1LjcyMTg4IDE1LjIzNiA3LjMwNDA4IDE0LjY0NjkgOC41ODk2MiAxNC4zNTIzQzkuODc1MTUgMTMuOTU5NiAxMC44NjQgMTMuNzYzMyAxMS43NTQgMTMuNjY1MUMxMi42NDQgMTMuNDY4NyAxMy4zMzYyIDEzLjM3MDYgMTQuMTI3MyAxMy4zNzA2QzE0LjgxOTUgMTMuMjcyNCAxNS42MTA2IDEzLjI3MjQgMTYuMzAyOCAxMy4zNzA2QzE2Ljk5NTEgMTMuNDY4NyAxNy42ODczIDEzLjU2NjkgMTguMjgwNiAxMy42NjUxQzE4Ljg3MzkgMTMuNzYzMyAxOS4zNjg0IDEzLjk1OTYgMTkuODYyOCAxNC4yNTQyQzIwLjI1ODMgMTQuNTQ4NyAyMC42NTM5IDE0Ljk0MTQgMjAuODUxNyAxNS4zMzQxQzIxLjA0OTQgMTUuNzI2OSAyMS4wNDk0IDE2LjIxNzcgMjAuODUxNyAxNi41MTIzQzIwLjY1MzkgMTYuODA2OCAyMC4zNTcyIDE3LjAwMzIgMjAuMDYwNiAxNy4xOTk1QzE5LjY2NSAxNy4yOTc3IDE5LjI2OTUgMTcuMjk3NyAxOC43NzUgMTcuMTk5NUMxOC4yODA2IDE3LjEwMTQgMTcuNjg3MyAxNi43MDg2IDE3LjA5MzkgMTYuMzE1OUMxNi41MDA2IDE1LjkyMzIgMTUuOTA3MyAxNS40MzIzIDE1LjAxNzMgMTQuNTQ4N0MxNC4xMjczIDEzLjY2NTEgMTMuMjM3MyAxMi42ODMzIDEyLjM0NzMgMTEuNjAzM0MxMS40NTc0IDEwLjUyMzQgMTAuNzY1MSA5LjU0MTU4IDEwLjM2OTYgOC42NTc5NkM5Ljg3NTE1IDcuNjc2MTcgOS41Nzg0OSA2Ljk4ODkyIDkuMzgwNzIgNi4zMDE2N0M5LjE4Mjk0IDUuNTE2MjMgOC45ODUxNyA0LjgyODk4IDguOTg1MTcgNC4yMzk5MUM4Ljg4NjI4IDMuNTUyNjUgOC45ODUxNyAzLjA2MTc2IDguOTg1MTcgMi41NzA4NkM5LjA4NDA1IDIuMDc5OTcgOS4xODI5NCAxLjY4NzI1IDkuMjgxODMgMS40OTA5QzkuNDc5NiAxLjI5NDU0IDkuNjc3MzggMS4wOTgxOCA5Ljc3NjI3IDEuMDk4MThDOS45NzQwNCAxIDEwLjA3MjkgMSAxMC4wNzI5IDFDMTAuMTcxOCAxIDEwLjI3MDcgMSAxMC4zNjk2IDFDMTAuNjY2MyAxIDEwLjg2NCAxLjE5NjM2IDEwLjk2MjkgMS4xOTYzNloiIHN0cm9rZT0iIzdCOTVBNyIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbWl0ZXJsaW1pdD0iMTAiIHN0cm9rZS1saW5lam9pbj0icm91bmQiLz4KPC9zdmc+Cg==") no-repeat left top 1px;
    background-size: 20px;
    -webkit-transition: opacity 0.3s;
    -moz-transition: opacity 0.3s;
    -ms-transition: opacity 0.3s;
    -o-transition: opacity 0.3s;
    transition: opacity 0.3s;
    &:hover {
      opacity: 0.7;
    }
  }
  &__text {
     margin: 11px 0 0;
     font-size: 16px;
     line-height: 20px;
  }

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
    &.--ticket {
      min-height: 0;
    }
  }

  &__params {
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    justify-content: flex-start;
    flex-wrap: wrap;
    margin-top: 12px;
    position: relative;
    .user-object__download {
      position: absolute;
      right: 0;
      bottom: 0;
    }
  }

  &__param {
    font-size: 14px;
    line-height: 20px;
    color: #5b6067;
    margin-left: 30px;

    .yes {
      display: none;
      color: $green;
    }
    .no {
      display: none;
      color: $red;
    }

    &:first-child {
      margin-left: 0;
      width: 140px;
    }

    &.--ticket:first-child {
      width: 80px;
    }

    &.yes {
        .yes {
          display: block;
        }
    }
    &.no {
        .no {
           display: block;
        }
    }
  }
}
</style>