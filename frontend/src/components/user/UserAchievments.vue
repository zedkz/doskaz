<template>
    <div class="user-achievments">
        <h3 class="user-profile__mob-title">Достижения</h3>
        <div class="user-achievments__achievments">
            <UserAchievment v-for="award in awards" :key="award.id" :text="award.title" :award-type="award.type"/>

            <UserAchievment text="Первый вход" award-type="gold"/>
            <UserAchievment text="Регистрация" award-type="silver"/>
            <UserAchievment text="Добавлено 3 объекта" award-type="bronze"/>
            <UserAchievment text="Добавлено 5 объектов" award-type="silver"/>
            <UserAchievment text="Добавлено 18 объектов" award-type="gold"/>
            <UserAchievment text="Награда от администрации" award-type="silver"/>
            <UserAchievment text="За активное участие в развитии портала" award-type="bronze"/>
            <UserAchievment text="Добавить награду" addNew/>
        </div>

        <div class="user-achievments__events">
            <div class="title">
                <span>Лента событий</span>
            </div>
            <div class="list">
                <user-event v-for="event in events" :key="event.id" :event="event"/>
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
                    <div class="list__text">Поздравляем, вы достигли 7 уровня! Теперь вы можете сменить аватар. До 8 уровня вам нужно набрать
                        60 баллов.
                    </div>
                </div>

                <div class="list__item">
                    <div class="list__date">
                        <span>23 июля</span>
                    </div>
                    <div class="list__icon list__icon_achievment">
                        <img src="@/assets/img/user/award-gold.svg"/>
                        <img src="@/assets/img/user/award-gold-black.svg" class="black"/>
                        <img src="@/assets/img/user/award-gold-white.svg" class="white"/>
                    </div>
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
    import UserEvent from "../userEvents/UserEvent";

    export default {
        components: {
          UserEvent,
            UserAchievment
        },
        props: [
            'events',
            'awards'
        ]
    };
</script>

<style lang='scss'>
    .user-achievments {
        padding-top: 40px;
        @media all and (max-width: 1023px){
            padding-top: 28px;
        }
        @media all and (max-width: 768px){
            padding: 30px 0;
        }
        &__achievments {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            justify-content: flex-start;
            flex-wrap: wrap;
            @media all and (max-width: 768px){
                margin: 24px 0 0;
            }
            & > * {
                width: 33.33%;
                padding-right: 40px;
                margin-bottom: 40px;
                @media all and (max-width: 1023px){
                    width: 50%;
                    padding-right: 30px;
                    margin-bottom: 30px;
                }
                @media all and (max-width: 520px){
                    width: 100%;
                    padding-right: 0;
                }
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
                @media all and (max-width: 1023px){
                    margin-bottom: 28px;
                }
                @media all and (max-width: 1023px){
                    font-size: 18px;
                    line-height: 20px;
                }
            }

            .list {
                &__item {
                    display: flex;
                    flex-direction: row;
                    align-items: center;
                    justify-content: flex-start;
                    margin-top: 49px;
                    position: relative;
                    @media all and (max-width: 768px){
                        display: block;
                        margin: 30px 0 0;
                    }

                    &:first-child {
                        margin-top: 0;
                    }
                }

                &__date {
                    width: 90px;
                    font-size: 14px;
                    line-height: 20px;
                    color: #5b6067;
                    @media all and (max-width: 1023px){
                        font-size: 12px;
                        line-height: 20px;
                        width: 70px;
                    }
                }

                &__icon {
                    width: 30px;
                    height: 30px;
                    margin-left: 10px;
                    margin-right: 20px;
                    background-position: center;
                    background-size: cover;
                    background-repeat: no-repeat;
                    @media all and (max-width: 1023px){
                        margin-left: 6px;
                        margin-right: 6px;
                    }
                    @media all and (max-width: 768px){
                        position: absolute;
                        top: -6px;
                        left: 106px;
                        margin: 0;
                    }

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
                        img {
                            width: 100%;
                            height: auto;
                            &.black, &.white {
                                display: none;
                            }
                        }
                    }
                }

                &__text {
                    display: block;
                    max-width: calc(100% - 150px);
                    font-weight: normal;
                    font-size: 16px;
                    line-height: 20px;
                    color: #333333;
                    @media all and (max-width: 1023px){
                        max-width: calc(100% - 120px);
                        font-size: 14px;
                        line-height: 20px;
                    }
                    @media all and (max-width: 768px){
                        max-width: 100%;
                        width: 100%;
                        margin: 10px 0 0;
                    }
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