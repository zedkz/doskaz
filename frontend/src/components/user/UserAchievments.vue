<template>
  <div class="user-achievments">
    <div class="user-achievments__achievments">
      <UserAchievment text="Первый вход" />
      <UserAchievment text="Регистрация" />
      <UserAchievment text="Добавлено 3 объекта" />
      <UserAchievment text="Добавлено 5 объектов" />
      <UserAchievment text="Добавлено 18 объектов" />
      <UserAchievment text="Награда от администрации" />
      <UserAchievment text="За активное участие в развитии портала" />
      <UserAchievment text="Добавить награду" addNew />
    </div>
    <div class="user-achievments__events">
      <div class="title">
        <span>Лента событий</span>
      </div>
      <div class="list">
        <div class="list__item">
          <div class="list__date">
            <span>12 августа</span>
          </div>
          <div class="list__icon"></div>
          <div class="list__text">
            <a href="#">Арай Молдахметова</a> прокомментировала ваш объект
            <a href="#">Суши-бар Saya Sushi</a>
          </div>
        </div>

        <div class="list__item">
          <div class="list__date">
            <span>10 августа</span>
          </div>
          <div class="list__icon"></div>
          <div class="list__text">
            <a href="#">Илья Давыдов</a> дополнил ваш объект
            <a href="#">Суши-бар Saya Sushi</a>
          </div>
        </div>

        <div class="list__item">
          <div class="list__date">
            <span>6 августа</span>
          </div>
          <div class="list__icon"></div>
          <div class="list__text">
            <a href="#">Ирина Ахметова</a> ответила на ваш комментарий к объекту
            <a href="#">Ветеринарная клиника «Мурзик»</a>
          </div>
        </div>

        <div class="list__item">
          <div class="list__date">
            <span>1 августа</span>
          </div>
          <div class="list__icon"></div>
          <div class="list__text">
            Ваш объект
            <a href="#">Суши-бар Saya Sushi</a> проверен и верифицирован модератором
            <a href="#">Volkorn</a>
          </div>
        </div>

        <div class="list__item">
          <div class="list__date">
            <span>26 июля</span>
          </div>
          <div class="list__icon list__icon_level">
            <span>7</span>
          </div>
          <div
            class="list__text"
          >Поздравляем, вы достигли 7 уровня! Теперь вы можете сменить аватар. До 8 уровня вам нужно набрать 60 баллов.</div>
        </div>

        <div class="list__item">
          <div class="list__date">
            <span>23 июля</span>
          </div>
          <div class="list__icon list__icon_achievment"></div>
          <div class="list__text">Вам выдана награда за активное участие в развитии портала</div>
        </div>

        <div class="list__item">
          <div class="list__date">
            <span>10 июля</span>
          </div>
          <div class="list__icon"></div>
          <div class="list__text">
            Ваш объект
            <a href="#">Аптека №234</a> проверен и верифицирован модератором
            <a href="#">Валерия Осинская</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import UserAchievment from "./UserAchievment";
export default {
  components: {
    UserAchievment
  }
};
</script>

<style lang='scss'>
.user-achievments {
  padding-top: 40px;

  &__achievments {
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    justify-content: flex-start;
    flex-wrap: wrap;

    & > * {
      width: 33.33%;
      padding-right: 40px;
      margin-bottom: 40px;
    }
  }

  &__events {
    padding-top: 15px;

    .title {
      font-weight: bold;
      font-size: 22px;
      line-height: 30px;
      color: #333333;
      margin-bottom: 49px;
    }

    .list {
      &__item {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: flex-start;
        margin-top: 49px;

        &:first-child {
          margin-top: 0;
        }
      }

      &__date {
        width: 90px;
        font-size: 14px;
        line-height: 20px;
        color: #5b6067;
      }

      &__icon {
        width: 30px;
        height: 30px;
        margin-left: 10px;
        margin-right: 20px;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;

        &.list__icon_level {
          border-radius: 50%;
          background: #0f6bf5;
          font-weight: bold;
          display: flex;
          justify-content: center;
          align-items: center;
          span {
            color: #ffffff;
          }
        }

        &.list__icon_achievment {
          background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='15' cy='15' r='14.5' fill='white' stroke='%237B95A7'/%3E%3Cpath d='M15.5 9.61803L16.7083 13.3369L16.8206 13.6824H17.1839H21.0941L17.9306 15.9807L17.6367 16.1943L17.749 16.5398L18.9573 20.2586L15.7939 17.9602L15.5 17.7467L15.2061 17.9602L12.0427 20.2586L13.251 16.5398L13.3633 16.1943L13.0694 15.9807L9.90592 13.6824H13.8161H14.1794L14.2917 13.3369L15.5 9.61803Z' fill='%237B95A7' stroke='%237B95A7'/%3E%3C/svg%3E%0A");
        }
      }

      &__text {
        display: block;
        max-width: calc(100% - 150px);
        font-weight: normal;
        font-size: 16px;
        line-height: 20px;
        color: #333333;

        a {
          font-weight: bold;
          color: #333;
          transition: opacity 0.3s;

          &:hover {
            opacity: 0.7;
          }
        }
      }
    }
  }
}
</style>