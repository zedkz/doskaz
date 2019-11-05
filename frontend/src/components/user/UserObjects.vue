<template>
  <div class="user-objects">
    <div class="user-objects__filter">
      <div class="filter">
        <div class="filter__text">Сортировать по</div>
        <div class="filter__dropdown">
          <div class="dropdown">
            <div class="dropdown__selected">
              <span>дате добавления</span>
            </div>
            <div class="dropdown__list">
              <div class="dropdown__item">
                <span>дате добавления</span>
              </div>
              <div class="dropdown__item">
                <span>дате добавления</span>
              </div>
              <div class="dropdown__item">
                <span>дате добавления</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="filter">
        <div class="filter__text">Показать</div>
        <div class="filter__dropdown">
          <div class="dropdown">
            <div class="dropdown__selected">
              <span>частично доступные</span>
            </div>
            <div class="dropdown__list">
              <div class="dropdown__item">
                <span>дате добавления</span>
              </div>
              <div class="dropdown__item">
                <span>дате добавления</span>
              </div>
              <div class="dropdown__item">
                <span>дате добавления</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="user-objects__content">
      <UserObject
        objectLink="#"
        objectTitle="Фонд поддержки парализованных граждан"
        :objectTypeImg="require('./../../assets/icons/green.svg')"
        :objectImg="require('./../../assets/img/objects/1.png')"
        objectTypeText="Доступно"
        objectDate="12.08.2019"
        objectComments="23"
        objectReports="2"
      />
      <UserObject
        objectLink="#"
        objectTitle="Шинторг-Центр, официальный представитель Michelin, Continental, Goodyear"
        :objectTypeImg="require('./../../assets/icons/yellow.svg')"
        :objectImg="require('./../../assets/img/objects/1.png')"
        objectTypeText="Частично доступно"
        objectDate="12.08.2019"
        objectComments="3"
        objectReports="22"
      />
      <UserObject
        objectLink="#"
        objectTitle="Гауһар, магазин электроинструментов, сантехники и автозапчастей"
        :objectTypeImg="require('./../../assets/icons/red.svg')"
        :objectImg="require('./../../assets/img/objects/1.png')"
        objectTypeText="Доступно"
        objectDate="12.08.2019"
        objectComments="23"
        objectReports="2"
      />
      <UserObject
        objectLink="#"
        objectTitle="Мартук онимдери, продуктовый магазин"
        :objectTypeImg="require('./../../assets/icons/yellow.svg')"
        :objectImg="require('./../../assets/img/objects/1.png')"
        objectTypeText="Частично доступно"
        objectDate="12.08.2019"
        objectComments="3"
        objectReports="22"
      />
    </div>
    <div class="user-objects__pagination">
      <Pagination />
    </div>
  </div>
</template>

<script>
import UserObject from "./UserObject";
import Pagination from "./../Pagination";

export default {
  components: {
    UserObject,
    Pagination
  }
};
</script>

<style lang="scss">
@import "./../../styles/mixins.scss";

.user-objects {
  padding: 35px 0 0;

  &__filter {
    margin-bottom: 55px;
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    align-items: flex-start;

    & > * {
      margin-left: 35px;

      &:first-child {
        margin-left: 0;
      }
    }

    .filter {
      display: flex;
      align-items: center;
      justify-content: flex-start;

      &__text {
        font-size: 14px;
        line-height: 20px;
        color: #5b6067;
        margin-right: 6px;
      }

      &__dropdown {
        position: relative;
        bottom: -1px;

        .dropdown {
          position: relative;
          cursor: pointer;

          &__selected {
            font-size: 14px;
            line-height: 20px;
            color: #333333;
            display: flex;
            align-items: center;

            &:after {
              content: "";
              background-image: url("data:image/svg+xml,%3Csvg width='8' height='4' viewBox='0 0 8 4' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M4 4L3.49691e-07 2.54292e-07L8 9.53674e-07L4 4Z' fill='%23333333'/%3E%3C/svg%3E%0A");
              width: 8px;
              height: 4px;
              display: block;
              margin-left: 4px;
            }

            span {
              border-bottom: 1px dashed #333;
            }
          }
          &__list {
            display: none;
          }
        }
      }
    }
  }

  &__content {
    margin-bottom: 60px;

    & > * {
      margin-top: 60px;

      &:first-child {
        margin-top: 0;
      }
    }
  }

  &__pagination {
  }
}
</style>