<template>
    <div class="pdf">
        <div class="pdf__top">
            <div class="pdf__fixed-logo">
                <img :src="require('@/assets/logo-black.svg')"/>
            </div>
            <div class="pdf__qr">
                <span class="pdf__qr-text">
                    <span class="pdf__qr-item">Saya Sushi, суши-бар</span>
                    <span class="pdf__qr-item">www.doskaz.kz</span>
                </span>
                <img :src="require('@/assets/img/qr-doskaz.svg')"/>
            </div>
        </div>
        <div class="pdf__info">
            <h2>Общая информация</h2>
            <div class="pdf__info-line">
                <div class="pdf__info-item">
                    <span class="pdf__info-title">Наименование</span>
                    <span class="pdf__info-text">Saya Sushi, суши-бар</span>
                </div>
                <div class="pdf__info-item">
                    <span class="pdf__info-title">Адрес</span>
                    <span class="pdf__info-text">Локомотивная, 7</span>
                </div>
            </div>
            <div class="pdf__info-line">
                <div class="pdf__info-item">
                    <span class="pdf__info-title">Категория</span>
                    <span class="pdf__info-text">Питание</span>
                </div>
                <div class="pdf__info-item">
                    <span class="pdf__info-title">Подкатегория</span>
                    <span class="pdf__info-text">Бары</span>
                </div>
            </div>
        </div>
        <div class="pdf__item">
            <h2>1. Парковка</h2>
            <div class="pdf__item-line">
                <img :src="require('@/assets/icons/pdf-check.svg')"/>
                <span>Количество парковочных мест (Не менее одного на 25 мест)</span>
            </div>
            <div class="pdf__item-line">
                <img :src="require('@/assets/icons/pdf-no-check.svg')"/>
                <span>Размер парковки (Не менее 3,66 х 5,38 м)</span>
            </div>
            <h3>Обозначение автостоянки для инвалидов</h3>
            <div class="pdf__item-line">
                <img :src="require('@/assets/icons/pdf-no-check.svg')"/>
                <span>Знак на плоскости стоянки</span>
            </div>
            <div class="pdf__item-line">
                <img :src="require('@/assets/icons/pdf-no-check.svg')"/>
                <span>Знак на вертикальной поверхности (стене, столбе, стойке)</span>
            </div>
            <div class="pdf__item-line">
                <img :src="require('@/assets/icons/pdf-check.svg')"/>
                <span>Знак 5.15 «Место стоянки»</span>
            </div>
            <div class="pdf__item-line">
                <img :src="require('@/assets/icons/pdf-no-check.svg')"/>
                <span>Знак 7.15 «Инвалиды»</span>
            </div>
            <div class="pdf__item-line">
                <img :src="require('@/assets/icons/pdf-check.svg')"/>
                <span>Стрелка и расстояние</span>
            </div>
            <div class="pdf__item-line">
                <img :src="require('@/assets/icons/pdf-no-check.svg')"/>
                <span>Разметка на плоскости</span>
            </div>
            <div class="pdf__item-line">
                <img :src="require('@/assets/icons/pdf-not-prov.svg')"/>
                <span>Съезд с тротуара на парковку (Рекомендуется ширина 1,5 м)</span>
            </div>
            <div class="pdf__item-line">
                <img :src="require('@/assets/icons/pdf-check.svg')"/>
                <span>Расстояние до входа в здание (Для общественных зданий менее 50 м)</span>
            </div>
            <h3>Путь движения снаружи здания (дорожки, тротуары, пандусы и пр.)</h3>
            <div class="pdf__item-line">
                <img :src="require('@/assets/icons/pdf-check.svg')"/>
                <span>Если из-за условий застройки ширина пути движения в пределах прямой видимости снижена до 1,2 м, то не более чем через каждые 25 м присутствуют горизонтальные площадки (карманы) размером не менее 2 х 1,8 м для обеспечения возможного разъезда людей на креслах-колясках.</span>
            </div>
            <div class="pdf__item-line">
                <img :src="require('@/assets/icons/pdf-check.svg')"/>
                <span>Пандусы на тротуарных дорожках в случае перепада уровней поверхностей более 2 см</span>

            </div>
            <div class="pdf__item-line">
                <img :src="require('@/assets/icons/pdf-check.svg')"/>
                <span>Все безопасные пешеходные дорожки обозначены окрашиванием линий в желтый цвет либо отличительной текстурой поверхности</span>
            </div>
        </div>
        <div class="pdf__item">
            <h2>3. Входная группа</h2>
            <div class="pdf__item-list">
                <span class="pdf__item-list__title">Количество входов для маломобильных групп населения</span>
                <div class="pdf__item-line">
                    <img :src="require('@/assets/icons/pdf-check.svg')"/>
                    <span>1-3 входа: не менее одного входа для маломобильных групп населения</span>
                </div>
                <div class="pdf__item-line">
                    <img :src="require('@/assets/icons/pdf-no-check.svg')"/>
                    <span>3-5 входов: не менее двух входов для маломобильных групп населения</span>
                </div>
                <div class="pdf__item-line">
                    <img :src="require('@/assets/icons/pdf-not-prov.svg')"/>
                    <span>Более 5 входов: не менее 50% входов для маломобильных групп населения</span>
                </div>
            </div>
            <div class="pdf__item-line">
                <img :src="require('@/assets/icons/pdf-check.svg')"/>
                <span>Вход на уровне земли</span>
            </div>
        </div>
        <div class="pdf__fixed-left">
            <div class="pdf__fixed-item"><img :src="require('@/assets/icons/pdf-check.svg')"/><span>Да</span></div>
            <div class="pdf__fixed-item"><img :src="require('@/assets/icons/pdf-no-check.svg')"/><span>Нет</span></div>
            <div class="pdf__fixed-item"><img :src="require('@/assets/icons/pdf-not-prov.svg')"/><span>Не предусмотрено</span></div>
        </div>
    </div>
</template>


<style lang="scss">
    @import "@/styles/mixins.scss";

    .pdf__fixed {
        &-left {
            position: fixed;
            left: 50%;
            margin: 0 0 0 -275px;
            bottom: 22px;
            z-index: 10;
            display: flex;
            transform: rotate(-90deg);
            transform-origin: 0 0 0;
        }
        &-item {
            margin: 0;
            display: flex;
            img {
                width: 10px;
                height: 10px;
                display: block;
            }
            span {
                font-size: 8px;
                line-height: 10px;
                display: block;
                margin: 0 0 0 5px;
            }
            & + .pdf__fixed-item {
                margin: 0 0 0 14px;
            }
        }
    }

    .pdf {
        width: 450px;
        color: #000000;
        margin: 0 auto;
        h2, h3 {
            page-break-after: avoid;
            page-break-before: avoid;
            page-break-inside: avoid;
        }
        h2 {
            margin: 0;
            font-size: 14px;
            line-height: 20px;
        }
        &__top {
            padding: 25px 0 11px;
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #000000;
            align-items: top;
        }
        &__logo {
            padding: 3px 0 0;
            img {
                width: 100px;
                height: auto;
                display: block;
            }
        }
        &__qr {
            display: flex;
            &-text {
                text-align: right;
                padding: 2px 0 0;
            }
            &-item {
                font-size: 8px;
                line-height: 10px;
                display: block;
                & + .pdf__qr-item {
                    margin: 5px 0 0;
                }
            }
            img {
                width: 30px;
                margin: 0 0 0 20px;
                display: block;
            }
        }
        &__item {
            margin: 0;
            h2 {
                margin: 0 0 10px;
            }
            h3 {
                font-size: 12px;
                line-height: 15px;
                margin: 22px 0 12px;
            }
            & + .pdf__item {
                margin: 34px 0;
            }
            &-list {
                padding: 0 0 0 25px;
                margin: 11px 0 14px;
                &__title {
                    font-size: 10px;
                    line-height: 15px;
                    margin: 0 0 11px;
                    display: block;
                }
            }
            &-line {
                margin: 0;
                position: relative;
                display: flex;
                img {
                    display: block;
                    width: 15px;
                    height: 15px;
                    margin: 0 10px 0 0;
                }
                span {
                    font-size: 10px;
                    line-height: 15px;
                    padding: 0 0 6px;
                    flex: 1 1 auto;
                    border-bottom: 1px solid #000000;
                }
                & + .pdf__item-line {
                    margin: 14px 0 0;
                }
            }
        }
        &__info {
            margin: 24px 0 20px;
            &-title {
                font-size: 8px;
                line-height: 10px;
                opacity: 0.5;
                margin: 0 0 2px;
                display: block;
            }
            &-text {
                font-size: 10px;
                line-height: 15px;
                 display: block;
            }
            &-item {
                width: 210px;
                border-bottom: 1px solid #000000;
                padding: 0 0 6px;
            }
            &-line {
                display: flex;
                justify-content: space-between;
                margin: 12px 0 0;
                & + .pdf__info-line {
                    margin: 16px 0 0;
                }
            }
        }
    }

    @media print {
        @page {
            margin: 30px 0;
        }
        .pdf {
            h2, h3 {
                page-break-after: avoid;
                page-break-before: avoid;
                page-break-inside: avoid;
            }
            &__item {
                &-line {
                    page-break-inside: avoid;
                }
            }
        }
    }
</style>