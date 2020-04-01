<template>
  <div>
    <UserAchievments :events="items"/>
    <div class="popup__wrapper" v-if="newLevelPopup">
      <div class="popup__in">
        <span class="popup__close" v-on:click="newLevelPopup = false"></span>
        <h5 class="popup__title">Новый уровень!</h5>
        <p class="popup__text">Поздравляем, вы получили 5 уровень!<br>Теперь вы можете редактировать свой статус
        </p>
        <div class="popup__new-level"
             v-bind:style="{'background-image': 'url(' + require('~/assets/img/user/newLevel.svg') + ')'}"></div>
      </div>
    </div>

    <div class="popup__wrapper" v-if="newPointsPopup">
      <div class="popup__in">
        <span class="popup__close" v-on:click="newPointsPopup = false"></span>
        <h5 class="popup__title">Вам начислено 10 баллов!</h5>
        <p class="popup__text">Вы закончили еженедельное задание<br>«Добавь 5 объектов в районе»</p>
        <div class="popup__new-points">10</div>
      </div>
    </div>

    <div class="popup__wrapper" v-if="addAwardPopup">
      <div class="popup__in">
        <span class="popup__close" v-on:click="addAwardPopup = false"></span>
        <h5 class="popup__title">Добавить награду</h5>
        <div class="popup__award-wrapper">
          <form>
            <div class="popup__award-list">
              <div class="popup__award">
                <div class="popup__award-icon"
                     v-bind:style="{'background-image': 'url(' + require('~/assets/img/user/award-gold.svg') + ')'}"></div>
                <input id="award-gold" type="radio" class="popup__award-input" name="award">
                <label for="award-gold">золотая</label>
              </div>
              <div class="popup__award">
                <div class="popup__award-icon"
                     v-bind:style="{'background-image': 'url(' + require('~/assets/img/user/award-silver.svg') + ')'}"></div>
                <input id="award-silver" type="radio" class="popup__award-input" name="award">
                <label for="award-silver">серебряная</label>
              </div>
              <div class="popup__award">
                <div class="popup__award-icon"
                     v-bind:style="{'background-image': 'url(' + require('~/assets/img/user/award-bronze.svg') + ')'}"></div>
                <input id="award-bronze" type="radio" class="popup__award-input" name="award">
                <label for="award-bronze">бронзовая</label>
              </div>
            </div>
          </form>
        </div>
        <div class="select">
          <select>
            <option disabled selected>Выберите категорию</option>
            <option>Категория1</option>
            <option>Категория2</option>
            <option>Категория3</option>
            <option>Категория4</option>
          </select>
        </div>
        <button type="button" class="user-page__button">Добавить</button>
      </div>
    </div>
  </div>
</template>

<script>
    import UserAchievments from "@/components/user/UserAchievments";

    export default {
        data() {
            return {
                newLevelPopup: false,
                newPointsPopup: false,
                addAwardPopup: false
            };
        },
        async asyncData({$axios}) {
          const {data: {items}} = await $axios.get('/api/profile/events')
          return {items}
        },
        computed: {
            currentPage() {
                return this.$route.path;
            }
        },
        components: {
            UserAchievments
        }
    };
</script>

<style lang="scss">
    @import "@/styles/mixins.scss";

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
                padding: 0 0 0 50%;

                &__content {
                    margin-left: -130px;
                    display: flex;
                    justify-content: flex-start;
                    align-items: center;
                    position: relative;
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

                    span {
                        color: #ffffff;
                    }

                    &.--logout {
                        position: absolute;
                        right: 0;
                        top: 0;
                        width: 50px;
                        height: 50px;
                        display: block;
                        padding: 15px 0 0 10px;

                        svg {
                            display: block;
                        }
                    }

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