<template>
    <div class="about">
        <ViTop/>
        <MainHeader/>
        <div class="about__top">
            <div class="about__top-bg" :style="{'background-image': 'url(' + require('./../assets/img/files/about-top-bg.jpg') + ')'}"></div>
            <div class="container">
                <div class="about__text-b">
                    <h3 class="about__title">Что представляет собой проект «Доступный Казахстан»</h3>
                    <p class="about__text">«Доступный Казахстан» — это онлайн-карта, на которую нанесена информация о доступности городских объектов и услуг. Открытые и бесплатные данные на карте дают возможность маломобильным группам населения (включая людей с инвалидностью, родителей с маленькими детьми на колясках, пожилых, беременных, временно-травмированных) ориентироваться в городском пространстве, а в случае отсутствия объекта на карте удобный интерфейс предоставляет возможность любому желающему поделиться со всеми информацией о доступности объекта.</p>
                </div>
                <div class="about__text-b">
                    <h3 class="about__title">Как работает карта</h3>
                    <p class="about__text">Доступность объектов для маломобильных групп населения обозначена на карте международной системой светофора:</p>
                </div>
                <div class="about__top-list">
                    <div class="about__top-item">
                        <img :src="require('@/assets/icons/green.svg')" class="about__top-item__img"/>
                        <h4 class="about__top-item__title">Доступно</h4>
                        <p class="about__top-item__text">Зеленая иконка обозначает, что объект полностью доступен, его можно посетить и воспользоваться услугами самостоятельно, без посторонней помощи.</p>
                    </div>
                    <div class="about__top-item">
                        <img :src="require('@/assets/icons/yellow.svg')" class="about__top-item__img"/>
                        <h4 class="about__top-item__title">Частично доступно</h4>
                        <p class="about__top-item__text">Желтая иконка — объект частично доступен, для посещения данного объекта нужна посторонняя помощь, либо не все его функциональные зоны доступны.</p>
                    </div>
                    <div class="about__top-item">
                        <img :src="require('@/assets/icons/red.svg')" class="about__top-item__img"/>
                        <h4 class="about__top-item__title">Недоступно</h4>
                        <p class="about__top-item__text">Красная иконка — объект недоступен, попасть на объект невозможно из-за недоступности входной группы (например, нет пандуса), либо невозможности движения по объекту.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="about__part">
            <div class="container">
                <h2 class="about__title">Стань участником проекта</h2>
                <div class="about__part-content">
                    <div class="about__part-img">
                        <img :src="require('@/assets/icons/about/about-part-bg.svg')"/>
                        <img :src="require('@/assets/icons/about/about-part.png')"/>
                    </div>
                    <p class="about__part-text">На этапе запуска карты обученные волонтеры собрали информацию о более 2000 общественных объектов, есть не только фото-, но и видеообзоры. Мы возлагаем большие надежды именно на ВАС, на тех, кто пользуется картой, кому она ежедневно помогает получать актуальную информацию о доступности городских объектов! Мы позиционируем карту как сообщество, и надеемся, что ВЫ станете ее активным членом, полноценным участником и будете сами добавлять объекты на карту, а также комментировать и дополнять информацию об уже отраженных на карте объектах.
                        При самостоятельном размещении на карте нового объекта, пожалуйста, оставляйте в комментариях как можно более подробную информацию и прикрепляйте фотографии, ведь именно эти материалы помогут другому человеку ориентироваться в городской среде.
                    </p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="about__item-b">
                <h2 class="about__title">Почему эта карта необходима</h2>
                <div class="about__item">
                    <img :src="require('@/assets/icons/about/about-map.png')"/>
                    <p>Зайдя на карту, вы сразу же увидите, что множество объектов отмечены красной иконкой. Так получилось не потому, что на карту специально заносились недоступные объекты, а потому, что доступных и частично доступных объектов в населенных пунктах намного меньше. Организации обязаны сделать вход в здание доступным для всех, но в большинстве случаев либо пандус не соответствует нормативам, либо человек, даже попав в здание, не может воспользоваться услугами, так как на его пути встречается мебель в узких коридорах, лестницы, а лифты отсутствуют и т.п.</p>
                </div>
                <div class="about__item">
                    <img :src="require('@/assets/icons/about/about-doc.png')" class="--right"/>
                    <p>Мы все — граждане своей страны с одинаковыми правами, отраженными в Конституции. Считаете ли вы, что ограничение в доступе к объектам и услугам является нарушением наших прав? Мы в этом уверены. 20 февраля 2015 года в Нур-Султане была ратифицирована Конвенция о правах людей с инвалидностью, после чего наше государство взяло на себя обязанность обеспечить благоприятную среду жизнедеятельности для людей с инвалидностью. В ближайшей перспективе Конвенция должна максимально ускорить процесс стирания барьеров, мешающих людям с инвалидностью полноценно участвовать в жизни общества наравне с другими гражданами.</p>
                </div>
                <div class="about__item">
                    <img :src="require('@/assets/icons/about/about-social.png')"/>
                    <p>Доступность открывает путь к получению образования, трудоустройству, лечению, отдыху, к возможности вести независимый образ жизни. Безбарьерная среда является общественным благом и тесно связана с социальным и экономическим развитием страны. Пусть термин «безбарьерная среда» для многих уже приобрел окрас разочарования, но мы надеемся и верим, что безбарьерная среда — это ближайшая реальность, и данная карта один из инструментов ее приближения!</p>
                </div>
            </div>
            <div class="about__text-b">
                <h3 class="about__title">Реальная польза проекта</h3>
                <p class="about__text">Информация на карте поможет не только эффективно распланировать свой день и передвижения по городу, но и будет способствовать созданию инклюзивной среды.
                    При разработке карты была создана функция сбора данных об объектах — администратор карты в любой момент может предоставить статистические данные о количестве доступных или недоступных для посещения городских объектах. Представленные данные — это актуальный инструмент, показывающий реальную ситуацию в населенном пункте, необходимый для неправительственных и государственных организаций.
                </p>
            </div>
            <div class="about__link-b">
                <div class="about__link-item">
                    <h3 class="title --md">Реализация проекта</h3>
                    <div class="about__link-logo">
                        <a href="https://www.ef-ca.kz/" target="_blank" rel="noreferrer noopener" class="about__link">
                            <img :src="require('@/assets/icons/about/efca.svg')"/>
                        </a>
                        <a href="https://www.oft.kz" target="_blank" rel="noreferrer noopener" class="about__link">
                            <img :src="require('@/assets/icons/about/tandau.svg')"/>
                        </a>
                        <a href="https://www.facebook.com/etshkz/" target="_blank" rel="noreferrer noopener" class="about__link">
                            <img :src="require('@/assets/icons/about/erekshe.svg')"/>
                        </a>
                    </div>
                    <p class="about__link-text">Проект реализуется консорциумом общественных организаций. Смотрите страницу «<nuxt-link :to="localePath({name: 'contacts'})">Контакты</nuxt-link>».</p>
                </div>
                <div class="about__link-item">
                    <h3 class="title --md">Финансирование</h3>
                    <div class="about__link-logo">
                        <a href="https://eeas.europa.eu/delegations/kazakhstan_ru" target="_blank" rel="noreferrer noopener" class="about__link">
                            <img :src="require('@/assets/icons/about/es.svg')"/>
                        </a>
                        <a href="https://kz.usembassy.gov/ru/" target="_blank" rel="noreferrer noopener" class="about__link">
                            <img :src="require('@/assets/icons/about/usembassy.svg')"/>
                        </a>
                    </div>
                    <p class="about__link-text">Проект финансируется Европейским Союзом и Дипломатической миссией США в Казахстане.</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import MainHeader from "@/components/MainHeader";
    import ViTop from "@/components/ViTop";

    export default {
        components: {MainHeader, ViTop}
    }

</script>

<style lang="scss">
    @import "@/styles/mixins.scss";

    .about {
        padding: 0 0 90px;
        @media all and (max-width: 768px) {
            padding: 0 0 40px;
        }
        .main-header__content {
            border: none;
        }
        &__link {
            &-b {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                margin: 110px 0 0;
                @media all and (max-width: 1023px) {
                    margin: 60px 0 0;
                    display: block;
                    text-align: center;
                }
                .title {
                    @media all and (max-width: 1023px) {
                        font-size: 24px;
                        line-height: 30px;
                    }
                }
            }
            &-item {
                width: 500px;
                min-width: 500px;
                text-align: left;
                @media all and (max-width: 1023px) {
                    margin: 60px auto 0;
                    display: block;
                    text-align: center;
                }
                @media all and (max-width: 768px) {
                    width: 100%;
                    min-width: 100%;
                }
            }
            &-text {
                font-size: 16px;
                line-height: 30px;
                @media all and (max-width: 768px) {
                    font-size: 14px;
                    line-height: 20px;
                }
                a {
                    text-decoration: underline;
                }
            }
            &-logo {
                min-height: 131px;
                margin: 52px 0 30px;
                align-items: top;
                display: flex;
                @media all and (max-width: 1023px) {
                    min-height: 0;
                    margin: 24px 0 20px;
                    justify-content: center;
                }
                @media all and (max-width: 768px) {
                    flex-wrap: wrap;
                    margin: 0 0 20px;
                }
                a {
                    margin: 0 0 0 80px;
                    transition: opacity 0.3s;
                    &:hover {
                        opacity: 0.7;
                    }
                    &:first-child {
                        margin: 0;
                        @media all and (max-width: 768px) {
                            margin: 24px 30px 0;
                        }
                    }
                    @media all and (max-width: 768px) {
                        margin: 24px 14px 0;
                    }
                }
            }
        }
        &__title {
            font-weight: 600;
            font-size: 48px;
            line-height: 50px;
            text-align: center;
            margin: 0;
            @media all and (max-width: 1200px) {
                font-size: 32px;
                line-height: 36px;
            }
            @media all and (max-width: 768px) {
                font-size: 20px;
                line-height: 28px;
            }
        }
        &__item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 80px 0 0;
            @media all and (max-width: 1023px) {
                align-items: flex-start;
            }
            @media all and (max-width: 768px) {
                margin: 42px 0 0;
                display: block;
            }
            p {
                font-size: 16px;
                line-height: 30px;
                text-align: left;
                width: calc(100% - 290px);
                min-width: calc(100% - 290px);
                @media all and (max-width: 1023px) {
                    width: calc(100% - 190px);
                    min-width: calc(100% - 190px);
                }
                @media all and (max-width: 768px) {
                    text-align: center;
                    width: 100%;
                    margin: 18px 0 0;
                    font-size: 14px;
                    line-height: 20px;
                }
            }
            img {
                width: 260px;
                min-width: 260px;
                &.--right {
                    order: 1;
                    @media all and (max-width: 768px) {
                        order: 0;
                    }
                }
                @media all and (max-width: 1023px) {
                    width: 160px;
                    min-width: 160px;
                }
                @media all and (max-width: 768px) {
                    margin: 0 auto;
                    display: block;
                }
            }
            &-b {
                padding: 106px 0 60px;
                @media all and (max-width: 1023px) {
                    padding: 53px 20px 50px;
                }
                @media all and (max-width: 1023px) {
                    padding: 30px 0;
                }
            }
        }
        &__part {
            padding: 106px 0 196px;
            background: $light-gray;
            .about__title {
                position: relative;
                z-index: 1;
            }
            @media all and (max-width: 1200px) {
                padding: 53px 0 50px;
            }
            @media all and (max-width: 1023px) {
                padding: 53px 20px 50px;
            }
            @media all and (max-width: 768px) {
                padding: 30px 0;
            }
            &-content {
                display: flex;
                margin: 64px 0 0;
                @media all and (max-width: 1023px) {
                    display: block;
                    margin: 0;
                }
            }
            &-img {
                width: 560px;
                min-width: 560px;
                margin: 7px 40px 0 0;
                position: relative;
                @media all and (max-width: 1200px) {
                    width: 460px;
                    min-width: 460px;
                    margin: 7px 30px 0 0;
                }
                @media all and (max-width: 1023px) {
                    width: 300px;
                    min-width: 300px;
                    margin: 37px auto 24px;
                }
                @media all and (max-width: 768px) {
                    width: 240px;
                    min-width: 240px;
                }
                img {
                    display: block;
                    width: 100%;
                    height: auto;
                    position: relative;
                    &:first-child {
                        position: absolute;
                        width: (552/560)*100%;
                        height: auto;
                        left: -11.8%;
                        top: -21%;
                    }
                }
            }
            &-text {
                font-size: 16px;
                line-height: 30px;
                z-index: 1;
                position: relative;
                @media all and (max-width: 768px) {
                    font-size: 14px;
                    line-height: 20px;
                }
            }
        }
        &__text {
            font-size: 16px;
            line-height: 30px;
            margin: 63px 0 0;
            @media all and (max-width: 1200px) {
                margin: 27px 0 0;
            }
            @media all and (max-width: 768px) {
                font-size: 14px;
                line-height: 20px;
                margin: 14px 0 0;
            }
            &-b {
                background: #FFFFFF;
                padding: 66px 150px 11px;
                @media all and (max-width: 1200px) {
                    padding: 53px 40px 11px;
                }
                @media all and (max-width: 768px) {
                    padding: 20px 20px 11px;
                }
                & + .about__top-text-b {
                    margin: 20px 0 0;
                }
            }
        }
        &__top {
            max-width: 1800px;
            padding: 0 20px 120px;
            margin: 0 auto;
            @media all and (max-width: 1800px) {
                padding: 0 0 60px;
            }
            .about__text-b {
                @media all and (max-width: 1200px) {
                    margin-left: 20px;
                    margin-right: 20px;
                }
                @media all and (max-width: 768px) {
                    margin-left: 0;
                    margin-right: 0;
                }
                &:first-child {
                    margin: -300px 0 0;
                    @media all and (max-width: 1200px) {
                        margin: -150px 20px 0;
                    }
                    @media all and (max-width: 768px) {
                        margin: -150px 0 0;
                    }
                }
            }
            &-bg {
                height: 500px;
                background-position: center;
                background-size: cover;
                @media all and (max-width: 1200px) {
                    height: 275px;
                }
            }
            &-list {
                display: flex;
                justify-content: space-between;
                margin: 20px 0 0;
                @media all and (max-width: 768px) {
                    display: block;
                }
            }
            &-item {
                padding: 40px 30px;
                background: #FFFFFF;
                box-shadow: 0 0 5px rgba(123, 149, 167, 0.15), 0 4px 40px rgba(123, 149, 167, 0.25);
                width: calc((100% - 110px)/3);
                @media all and (max-width: 1200px) {
                    padding: 29px 20px 20px;
                }
                @media all and (max-width: 1023px) {
                    width: calc((100% - 60px)/3);
                }
                @media all and (max-width: 768px) {
                    width: 100%;
                    margin: 24px 0 0;
                }
                &__img {
                    display: block;
                    width: 40px;
                    @media all and (max-width: 1023px) {
                        width: 30px;
                    }
                }
                &__title {
                    font-weight: bold;
                    font-size: 16px;
                    line-height: 20px;
                    margin: 24px 0 5px;
                    @media all and (max-width: 1023px) {
                        font-size: 14px;
                        line-height: 20px;
                        margin: 15px 0 5px;
                    }
                }
                &__text {
                    font-size: 16px;
                    line-height: 30px;
                    margin: 5px 0 0;
                    @media all and (max-width: 1023px) {
                        font-size: 14px;
                        line-height: 20px;
                    }
                }
            }
        }
    }
</style>