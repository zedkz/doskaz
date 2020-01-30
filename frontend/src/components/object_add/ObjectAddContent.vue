<template>
<div class="container">
    <div class="add-object__form">
        <div class="add-object__step-wrapper">
            <div class="add-object__step">
                <div class="step" v-for="(step, index) in formSteps" v-bind:class="[{ checked: formStep > index + 1 }, { current: formStep == index + 1 }]" v-bind:key="index">
                    <div class="step-progress"></div>
                </div>
            </div>
            <div class="add-object__step-info">
                <div class="step" v-for="(step, index) in formSteps" v-bind:class="{ active: formStep == index + 1 }" v-bind:key="index">
                    {{ step.title }}
                </div>
            </div>
        </div>
        <div class="add-object__top">
            <span class="add-object__top-step">Шаг {{ formStep }} из {{ formSteps.length }}</span> <h4 class="add-object__top-title">{{ formSteps[formStep-1].title }}</h4>
        </div>

        <div class="add-object__content" v-show="formStep == 1">
            <div class="add-object__line --lrg error">
                <div class="col">
                    <label class="add-object__label" for="input_name">Наименование</label>
                </div>
                <div class="col --long">
                    <div class="input">
                        <input id="input_name" type="text" placeholder="Например, суши-бар Saya Sushi">
                    </div>
                </div>
                <div class="add-object__info">
                    <span class="add-object__info-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                            <path d="M20 40C31.0457 40 40 31.0457 40 20C40 8.9543 31.0457 0 20 0C8.9543 0 0 8.9543 0 20C0 31.0457 8.9543 40 20 40Z" fill="#F1F8FC"/>
                            <path d="M19.3871 15.4286C18.2074 15.4286 17.6175 15.7972 16.9908 16.6452L15 14.3594C15.8111 13.0323 17.47 12 19.6083 12C22.7419 12 24.5852 13.8433 24.5852 16.0922C24.5852 20.5161 20.3825 20.6636 20.6774 22.9493H17.5806C17.0645 19.1521 20.9355 19.4101 20.9355 16.8664C20.8986 16.0922 20.235 15.4286 19.3871 15.4286ZM19.2396 24.2396C20.3088 24.2396 21.0461 25.1613 21.0461 26.0461C21.0461 27.0415 20.3088 28 19.2396 28C18.023 28 17.2857 27.0783 17.2857 26.0461C17.3226 25.1982 18.023 24.2396 19.2396 24.2396Z" fill="#7B95A7"/>
                        </svg>
                    </span>
                    <div class="add-object__info-text">
                        Имеется ли специальное парковочное место для людей с ограниченными возможностями? Выберите статус «Доступно», если на парковке есть специальное парковочное место; «Частично доступно» — если парковка есть, но нет специального парковочного места. Если парковка отсутствует, выберите статус «Не предусмотрено».
                    </div>
                </div>
                <div class="add-object__error">
                    Укажите наименование
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Адрес</label>
                </div>
                <div class="col --long">
                    <div class="input">
                        <input type="text" placeholder="Улица и номер дома">
                    </div>
                </div>
                <div class="add-object__info">
                    <span class="add-object__info-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                            <path d="M20 40C31.0457 40 40 31.0457 40 20C40 8.9543 31.0457 0 20 0C8.9543 0 0 8.9543 0 20C0 31.0457 8.9543 40 20 40Z" fill="#F1F8FC"/>
                            <path d="M19.3871 15.4286C18.2074 15.4286 17.6175 15.7972 16.9908 16.6452L15 14.3594C15.8111 13.0323 17.47 12 19.6083 12C22.7419 12 24.5852 13.8433 24.5852 16.0922C24.5852 20.5161 20.3825 20.6636 20.6774 22.9493H17.5806C17.0645 19.1521 20.9355 19.4101 20.9355 16.8664C20.8986 16.0922 20.235 15.4286 19.3871 15.4286ZM19.2396 24.2396C20.3088 24.2396 21.0461 25.1613 21.0461 26.0461C21.0461 27.0415 20.3088 28 19.2396 28C18.023 28 17.2857 27.0783 17.2857 26.0461C17.3226 25.1982 18.023 24.2396 19.2396 24.2396Z" fill="#7B95A7"/>
                        </svg>
                    </span>
                    <div class="add-object__info-text">
                        Имеется ли специальное парковочное место для людей с ограниченными возможностями? Выберите статус «Доступно», если на парковке есть специальное парковочное место; «Частично доступно» — если парковка есть, но нет специального парковочного места. Если парковка отсутствует, выберите статус «Не предусмотрено».
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <label class="add-object__label --title">Точка на карте</label>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Категория</label>
                </div>
                <div class="col --long">
                    <div class="select">
                        <select>
                            <option disabled selected value="">Выберите категорию</option>
                            <option>Категория1</option>
                            <option>Категория2</option>
                        </select>
                    </div>
                </div>
                <div class="add-object__info">
                    <span class="add-object__info-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                            <path d="M20 40C31.0457 40 40 31.0457 40 20C40 8.9543 31.0457 0 20 0C8.9543 0 0 8.9543 0 20C0 31.0457 8.9543 40 20 40Z" fill="#F1F8FC"/>
                            <path d="M19.3871 15.4286C18.2074 15.4286 17.6175 15.7972 16.9908 16.6452L15 14.3594C15.8111 13.0323 17.47 12 19.6083 12C22.7419 12 24.5852 13.8433 24.5852 16.0922C24.5852 20.5161 20.3825 20.6636 20.6774 22.9493H17.5806C17.0645 19.1521 20.9355 19.4101 20.9355 16.8664C20.8986 16.0922 20.235 15.4286 19.3871 15.4286ZM19.2396 24.2396C20.3088 24.2396 21.0461 25.1613 21.0461 26.0461C21.0461 27.0415 20.3088 28 19.2396 28C18.023 28 17.2857 27.0783 17.2857 26.0461C17.3226 25.1982 18.023 24.2396 19.2396 24.2396Z" fill="#7B95A7"/>
                        </svg>
                    </span>
                    <div class="add-object__info-text">
                        Имеется ли специальное парковочное место для людей с ограниченными возможностями? Выберите статус «Доступно», если на парковке есть специальное парковочное место; «Частично доступно» — если парковка есть, но нет специального парковочного места. Если парковка отсутствует, выберите статус «Не предусмотрено».
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Подкатегория</label>
                </div>
                <div class="col --long">
                    <div class="select">
                        <select>
                            <option disabled selected value="">Выберите подкатегорию</option>
                            <option><br>ПодКатегория1<br></option>
                            <option>ПодКатегория2</option>
                        </select>
                    </div>
                </div>
                <div class="add-object__info">
                    <span class="add-object__info-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                            <path d="M20 40C31.0457 40 40 31.0457 40 20C40 8.9543 31.0457 0 20 0C8.9543 0 0 8.9543 0 20C0 31.0457 8.9543 40 20 40Z" fill="#F1F8FC"/>
                            <path d="M19.3871 15.4286C18.2074 15.4286 17.6175 15.7972 16.9908 16.6452L15 14.3594C15.8111 13.0323 17.47 12 19.6083 12C22.7419 12 24.5852 13.8433 24.5852 16.0922C24.5852 20.5161 20.3825 20.6636 20.6774 22.9493H17.5806C17.0645 19.1521 20.9355 19.4101 20.9355 16.8664C20.8986 16.0922 20.235 15.4286 19.3871 15.4286ZM19.2396 24.2396C20.3088 24.2396 21.0461 25.1613 21.0461 26.0461C21.0461 27.0415 20.3088 28 19.2396 28C18.023 28 17.2857 27.0783 17.2857 26.0461C17.3226 25.1982 18.023 24.2396 19.2396 24.2396Z" fill="#7B95A7"/>
                        </svg>
                    </span>
                    <div class="add-object__info-text">
                        Имеется ли специальное парковочное место для людей с ограниченными возможностями? Выберите статус «Доступно», если на парковке есть специальное парковочное место; «Частично доступно» — если парковка есть, но нет специального парковочного места. Если парковка отсутствует, выберите статус «Не предусмотрено».
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Ссылка на видео</label>
                </div>
                <div class="col --long">
                    <div class="input">
                        <input type="text" placeholder="http://">
                    </div>
                    <button type="button" class="add-link">Добавить еще фото</button>
                </div>
                <div class="add-object__info">
                    <span class="add-object__info-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                            <path d="M20 40C31.0457 40 40 31.0457 40 20C40 8.9543 31.0457 0 20 0C8.9543 0 0 8.9543 0 20C0 31.0457 8.9543 40 20 40Z" fill="#F1F8FC"/>
                            <path d="M19.3871 15.4286C18.2074 15.4286 17.6175 15.7972 16.9908 16.6452L15 14.3594C15.8111 13.0323 17.47 12 19.6083 12C22.7419 12 24.5852 13.8433 24.5852 16.0922C24.5852 20.5161 20.3825 20.6636 20.6774 22.9493H17.5806C17.0645 19.1521 20.9355 19.4101 20.9355 16.8664C20.8986 16.0922 20.235 15.4286 19.3871 15.4286ZM19.2396 24.2396C20.3088 24.2396 21.0461 25.1613 21.0461 26.0461C21.0461 27.0415 20.3088 28 19.2396 28C18.023 28 17.2857 27.0783 17.2857 26.0461C17.3226 25.1982 18.023 24.2396 19.2396 24.2396Z" fill="#7B95A7"/>
                        </svg>
                    </span>
                    <div class="add-object__info-text">
                        Имеется ли специальное парковочное место для людей с ограниченными возможностями? Выберите статус «Доступно», если на парковке есть специальное парковочное место; «Частично доступно» — если парковка есть, но нет специального парковочного места. Если парковка отсутствует, выберите статус «Не предусмотрено».
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Загрузить фото</label>
                </div>
                <div class="col --long">
                    <div class="photo-input__wrapper">
                        <div class="photo-input required">
                            <input type="file" accept="image/*"/>
                            <span></span>
                        </div>
                        <div class="photo-input required">
                            <input type="file" accept="image/*"/>
                            <span></span>
                        </div>
                        <div class="photo-input required">
                            <input type="file" accept="image/*"/>
                            <span></span>
                        </div>
                        <div class="photo-input required">
                            <input type="file" accept="image/*"/>
                            <span></span>
                        </div>
                        <div class="photo-input required">
                            <input type="file" accept="image/*"/>
                            <span></span>
                        </div>
                    </div>
                    <button type="button" class="add-link">Добавить еще фото</button>
                </div>
            </div>
        </div>

        <div class="add-object__content" v-show="formStep == 2">
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label">Количество парковочных мест</label>
                    <span class="add-object__label-text">Не менее одного на 25 мест</span>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label">Размер парковки</label>
                    <span class="add-object__label-text">Не менее 3,66 х 5,38 м</span>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <h5 class="add-object__title">Обозначение автостоянки для инвалидов</h5>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label">Знак на плоскости стоянки</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label">Знак на вертикальной поверхности (стене, столбе, стойке)</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label">Знак 5.15 «Место стоянки»</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label">Знак 7.15 «Инвалиды»</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label">Стрелка и расстояние</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label">Разметка на плоскости</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label">Съезд с тротуара на парковку</label>
                    <span class="add-object__label-text">Рекомендуется ширина 1,5 м</span>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label">Расстояние до входа в здание</label>
                    <span class="add-object__label-text">Для общественных зданий менее 50 м</span>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="add-object__line --lrg">
                <h5 class="add-object__title --lrg">Оценка доступности зоны</h5>
            </div>
            <div class="add-object__line --av-green">
                <div class="col">
                    <p class="add-object__text">Люди, передвигающиеся на кресло-коляске</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg --av-green">
                <div class="col">
                    <p class="add-object__text">Люди с нарушением опорно-двигательного аппарата</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg --av-yellow">
                <div class="col">
                    <p class="add-object__text">Люди с нарушениями зрения</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg --av-red">
                <div class="col">
                    <p class="add-object__text">Люди с нарушениями слуха</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg --av-red">
                <div class="col">
                    <p class="add-object__text">Люди с интелектуальной инвалидностью</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg">
                <h5 class="add-object__title">Комментарий к зоне парковки</h5>
            </div>
            <div class="add-object__line">
                <textarea class="add-object__textarea" placeholder="Система оценила доступность парковки. Если вы не согласны с оценкой, вы можете оставить комментарий с пояснением"></textarea>
            </div>
        </div>

        <div class="add-object__content" v-show="formStep == 3">
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label">Вход на уровне земли</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="add-object__line">
                <h5 class="add-object__title">Лестница наружная</h5>
            </div>

            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label">Предупреждающая полоса</label>
                    <span class="add-object__label-text">Тактильная за 30-40 см до первой и последней ступени марша шириной не менее 56 см, контрастная шириной 30 см</span>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Ширина проступей лестниц не менее 40 см</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Высота подъема ступеней не более 12 см</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Количество ступеней</label>
                    <span class="add-object__label-text">В одном марше от 3 до 12, одиночные ступени недопустимы</span>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Ширина марша лестниц не менее 1,35 м ?</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="add-object__line --lrg">
                <h5 class="add-object__title --label">Поручни перил при перепадах высот более 0,45 м</h5>
            </div>

            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Вдоль обеих сторон</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">На высоте 0,9 м для взрослых, 0,5 м для детей</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Горизонтальный закругленный вылет после последней опоры 30 см</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">При ширине лестничного марша более 2,5 м — разделительные поручни</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="add-object__line --lrg">
                <h5 class="add-object__title">Пандус наружный</h5>
            </div>

            <div class="add-object__line">
                <h5 class="add-object__title --label">Покрытие пандуса</h5>
            </div>

            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Твёрдые материалы  </label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Без зазоров</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Без вибрации при движении</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Предотвращающее скольжение</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Ширина марша не менее 1,2 м</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Разворотные горизонтальные площадки</label>
                    <span class="add-object__label-text">Размеры 1,2 х 1,5 м</span>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Высота марша 40-45 см</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Уклон</label>
                    <span class="add-object__label-text">При высоте подъёма выше 20 см — 1 : 20 (5% или 2,9°)</span>
                    <span class="add-object__label-text">При высоте подъёма до 20 см — 1 : 10 (10% или 5,7°)</span>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Бортики не менее 5 см ?</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="add-object__line --lrg">
                <h5 class="add-object__title --label">Поручни перил при перепадах высот более 0,45 м ?</h5>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Вдоль обеих сторон</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">На высоте 0,7-0,9 м для взрослых, 0,5 м для детей</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Горизонтальный закругленный вылет после последней опоры 30 см</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="add-object__line --lrg">
                <h5 class="add-object__title">Подъёмник наружный электрический</h5>
            </div>
            <div class="add-object__line">
                <h5 class="add-object__title --label">Стационарные подъёмники</h5>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Параметры не менее 0,9 х 1,2 м</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Жёсткое ограждение со всех сторон</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Бортики</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="add-object__line --lrg">
                <h5 class="add-object__title">Входная площадка, входная дверь, тамбур</h5>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label">Входная площадка с пандусом</label>
                    <span class="add-object__label-text">Размеры не менее 2,2 х 2,2 м</span>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="add-object__line">
                <h5 class="add-object__title --label">Глубина пространства перед дверью</h5>
            </div>

            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">При открывании «от себя» — не менее 1,2 м</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">При открывании «к себе» — не менее 1,5 м</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="add-object__line --lrg">
                <h5 class="add-object__title --label">Входная дверь</h5>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Открытие в противоположную сторону от пандуса</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Ширина в свету не менее 90 см</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Пороги не выше 1,4 см</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="add-object__line --lrg">
                <h5 class="add-object__title --label">Стеклянная дверь</h5>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Наличие предупреждения для слабовидящих на стеклянной двери</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Прямоугольник 10 х 20 см²</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Цвет яркий (контрастный)</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">На высоте не ниже 1,2 м и не выше 1,5 м</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="add-object__line --lrg">
                <h5 class="add-object__title --label">Тамбуры</h5>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">1,5-1,8 м (глубина) х 2 м (ширина)</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">2,3 м (глубина) х  1,5 м (ширина)</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="add-object__line --lrg">
                <h5 class="add-object__title">Ситуационная помощь на входе</h5>
            </div>
            <div class="add-object__line">
                <h5 class="add-object__title --label">Кнопка вызова персонала</h5>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Доступность, высота 85 см  – 1 м</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Навес от осадков</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Шрифт Брайля</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>


            <div class="add-object__line --lrg">
                <h5 class="add-object__title --lrg">Оценка доступности зоны</h5>
            </div>
            <div class="add-object__line --av-green">
                <div class="col">
                    <p class="add-object__text">Люди, передвигающиеся на кресло-коляске</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg --av-green">
                <div class="col">
                    <p class="add-object__text">Люди с нарушением опорно-двигательного аппарата</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg --av-yellow">
                <div class="col">
                    <p class="add-object__text">Люди с нарушениями зрения</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg --av-red">
                <div class="col">
                    <p class="add-object__text">Люди с нарушениями слуха</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg --av-red">
                <div class="col">
                    <p class="add-object__text">Люди с интелектуальной инвалидностью</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg">
                <h5 class="add-object__title">Комментарий к зоне парковки</h5>
            </div>
            <div class="add-object__line">
                <textarea class="add-object__textarea" placeholder="Система оценила доступность парковки. Если вы не согласны с оценкой, вы можете оставить комментарий с пояснением"></textarea>
            </div>
        </div>

        <div class="add-object__content" v-show="formStep == 4">
            <div class="add-object__line">
                <h5 class="add-object__title">Территория пути передвижения</h5>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label">Ширина коридора 1,5 м</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="add-object__line --lrg">
                <h5 class="add-object__title --label">Покрытие пола</h5>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Твёрдые материалы</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Без зазоров</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Без вибрации при движении</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Предотвращающее скольжение</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="add-object__line --lrg">
                <h5 class="add-object__title">Двери внутренние</h5>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Ширина дверей не менее 90 см</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Высота порогов не более 1,4 см</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="add-object__line --lrg">
                <h5 class="add-object__title --label">Стеклянная дверь</h5>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Наличие предупреждения для слабовидящих на стеклянной двери</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Прямоугольник 10 х 20 см²</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Цвет яркий (контрастный)</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">На высоте не ниже 1,2 м и не выше 1,5 м</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="add-object__line --lrg">
                <h5 class="add-object__title">Лестницы внутренние</h5>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label">Рифление и контрастные полосы на ступенях лестниц (верхняя и нижняя ступени в каждом марше)</label>
                </div>
                <div  class="col --small"></div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Контрастный цвет</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Тактильные указатели</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Ширина полосы 30 см</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Ширина марша лестниц не менее 1,35 м</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Ширина проступей лестниц не менее 30 см</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Высота подъема ступеней не более 15 см</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Максимальное число ступеней на пролет</label>
                    <span class="add-object__label-text">В одном марше от 3 до 12, одиночные ступени недопустимы</span>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="add-object__line --lrg">
                <h5 class="add-object__title --label">Поручни перил при перепадах высот более 0,45 м</h5>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Вдоль обеих сторон</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">На высоте 0,9 м для взрослых, 0,5 м для детей</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Горизонтальный закругленный вылет после последней опоры 30 см</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="add-object__line --lrg">
                <h5 class="add-object__title">Пандусы внутренние</h5>
            </div>
            <div class="add-object__line">
                <h5 class="add-object__title --label">Покрытие пандуса</h5>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Твёрдые материалы</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Без зазоров</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Без вибрации при движении</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Предотвращающее скольжение</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Разворотные горизонтальные площадки</label>
                    <span class="add-object__label-text">Размеры 1,2 х 1,5 м</span>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="add-object__line --lrg">
                <h5 class="add-object__title --label">Поручни перил при перепадах высот более 0,45 м</h5>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Вдоль обеих сторон</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">На высоте 0,7-0,9 м для взрослых, 0,5 м для детей</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Горизонтальный закругленный вылет после последней опоры 30 см</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Ширина марша не менее 1,2 м</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Высота марша 40-45 см</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Уклон</label>
                    <span class="add-object__label-text">При высоте подъёма выше 20 см — 1 : 20 (5% или 2,9°)</span>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Бортики не менее 5 см</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="add-object__line --lrg">
                <h5 class="add-object__title">Лифты и электрические подъемники внутренние</h5>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Габариты кабины лифта</label>
                    <span class="add-object__label-text">Не менее 1,3 х 2,1 м</span>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Ширина двери в кабину не менее 90 см</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="add-object__line --lrg">
                <h5 class="add-object__title --label">Информация для людей, имеющих проблемы со зрением</h5>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Надписи, выполненные шрифтом Брайля на кнопках</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Не сенсорные кнопки</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>


            <div class="add-object__line --lrg">
                <h5 class="add-object__title --lrg">Оценка доступности зоны</h5>
            </div>
            <div class="add-object__line --av-green">
                <div class="col">
                    <p class="add-object__text">Люди, передвигающиеся на кресло-коляске</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg --av-green">
                <div class="col">
                    <p class="add-object__text">Люди с нарушением опорно-двигательного аппарата</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg --av-yellow">
                <div class="col">
                    <p class="add-object__text">Люди с нарушениями зрения</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg --av-red">
                <div class="col">
                    <p class="add-object__text">Люди с нарушениями слуха</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg --av-red">
                <div class="col">
                    <p class="add-object__text">Люди с интелектуальной инвалидностью</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg">
                <h5 class="add-object__title">Комментарий к зоне парковки</h5>
            </div>
            <div class="add-object__line">
                <textarea class="add-object__textarea" placeholder="Система оценила доступность парковки. Если вы не согласны с оценкой, вы можете оставить комментарий с пояснением"></textarea>
            </div>
        </div>

        <div class="add-object__content" v-show="formStep == 5">
            <div class="add-object__line">
                <h5 class="add-object__title --label">Размеры рабочей поверхности стола, стойки</h5>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Высота не более 80 см от уровня пола</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Коленное пространство не менее 70 см</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Опознавательные таблички</label>
                    <span class="add-object__label-text">Высота размещения от 1,4 м до 1,6 м</span>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="add-object__line --lrg">
                <h5 class="add-object__title --label">Зона досягаемости для людей на кресло-колясках</h5>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">При расположении сбоку от посетителя — не выше 1,4 м и не ниже 0,3 от уровня пола</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">При фронтальном подходе — не выше 1,2 м и не ниже 0,4 м от уровня пола</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>


            <div class="add-object__line --lrg">
                <h5 class="add-object__title --lrg">Оценка доступности зоны</h5>
            </div>
            <div class="add-object__line --av-green">
                <div class="col">
                    <p class="add-object__text">Люди, передвигающиеся на кресло-коляске</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg --av-green">
                <div class="col">
                    <p class="add-object__text">Люди с нарушением опорно-двигательного аппарата</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg --av-yellow">
                <div class="col">
                    <p class="add-object__text">Люди с нарушениями зрения</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg --av-red">
                <div class="col">
                    <p class="add-object__text">Люди с нарушениями слуха</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg --av-red">
                <div class="col">
                    <p class="add-object__text">Люди с интелектуальной инвалидностью</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg">
                <h5 class="add-object__title">Комментарий к зоне парковки</h5>
            </div>
            <div class="add-object__line">
                <textarea class="add-object__textarea" placeholder="Система оценила доступность парковки. Если вы не согласны с оценкой, вы можете оставить комментарий с пояснением"></textarea>
            </div>
        </div>

        <div class="add-object__content" v-show="formStep == 6">
            <div class="add-object__line">
                <h5 class="add-object__title --label">Наличие уборной</h5>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Расчётная численность посетителей более 50 человек</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Продолжительности нахождения в здании более 60 минут</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="add-object__line">
                <h5 class="add-object__title --label">Дверь в уборную</h5>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Дверь открывается наружу</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Снаружи размещена криптограмма</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Ширина двери не менее 1,2 м</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Поручни на внутренней стороне двери длиной не менее 60 см</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Высота порогов не более 1,4 см</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Размеры универсальной кабины не менее 1,65 х 2,0 м</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <h5 class="add-object__title --label">Другое оборудование</h5>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Крючки для одежды</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Крючки для костылей</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Крючки для других принадлежностей</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Зеркало</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Дозатор с мылом</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Диспенсер для туалетной бумаги и салфеток  </label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Электрическая сушилка для рук</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Урна</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Открывающиеся части предметов на высоте от 1,0 до 1,2 м</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <h5 class="add-object__title --label">Кнопка вызова SOS</h5>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">На высоте от 40 см до 60 см над уровнем пола</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">На расстоянии от края унитаза от 15 см до 30 см</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Указатель «Кнопка экстренного вызова»</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>


            <div class="add-object__line --lrg">
                <h5 class="add-object__title --lrg">Оценка доступности зоны</h5>
            </div>
            <div class="add-object__line --av-green">
                <div class="col">
                    <p class="add-object__text">Люди, передвигающиеся на кресло-коляске</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg --av-green">
                <div class="col">
                    <p class="add-object__text">Люди с нарушением опорно-двигательного аппарата</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg --av-yellow">
                <div class="col">
                    <p class="add-object__text">Люди с нарушениями зрения</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg --av-red">
                <div class="col">
                    <p class="add-object__text">Люди с нарушениями слуха</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg --av-red">
                <div class="col">
                    <p class="add-object__text">Люди с интелектуальной инвалидностью</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg">
                <h5 class="add-object__title">Комментарий к зоне парковки</h5>
            </div>
            <div class="add-object__line">
                <textarea class="add-object__textarea" placeholder="Система оценила доступность парковки. Если вы не согласны с оценкой, вы можете оставить комментарий с пояснением"></textarea>
            </div>
        </div>

        <div class="add-object__content" v-show="formStep == 7">
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Указатели и информационный материал</label>
                    <span class="add-object__label-text">Контрастные крупные буквы, выделенные жирным шрифтом</span>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Форматы информации</label>
                    <span class="add-object__label-text">Шрифт Брайля, аудио-версия, радиомаяки, радиометки, радиоинформаторы</span>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Знаки и символы</label>
                    <span class="add-object__label-text">Международные знаки и символы на контрастном фоне</span>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Форматы информации</label>
                    <span class="add-object__label-text">Визуальные, тактильные, звуковые, световые указатели, табло и пиктограммы, а также контрастное цветовое решение элементов интерьера, переводчик с жестового языка</span>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="add-object__line --lrg">
               <h5 class="add-object__title --label">Тактильная информация</h5>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Рельефные тактильные обозначения путей движения</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line">
                <div class="col">
                    <label class="add-object__label --gray">Непрерывные тактильные обозначения путей движения</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Мнемосхема</label>
                    <span class="add-object__label-text">Размещение с правой стороны на расстоянии от 3 м до 5 м от входа в объект</span>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>


            <div class="add-object__line --lrg">
                <h5 class="add-object__title --lrg">Оценка доступности зоны</h5>
            </div>
            <div class="add-object__line --av-green">
                <div class="col">
                    <p class="add-object__text">Люди, передвигающиеся на кресло-коляске</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg --av-green">
                <div class="col">
                    <p class="add-object__text">Люди с нарушением опорно-двигательного аппарата</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg --av-yellow">
                <div class="col">
                    <p class="add-object__text">Люди с нарушениями зрения</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg --av-red">
                <div class="col">
                    <p class="add-object__text">Люди с нарушениями слуха</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg --av-red">
                <div class="col">
                    <p class="add-object__text">Люди с интелектуальной инвалидностью</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg">
                <h5 class="add-object__title">Комментарий к зоне парковки</h5>
            </div>
            <div class="add-object__line">
                <textarea class="add-object__textarea" placeholder="Система оценила доступность парковки. Если вы не согласны с оценкой, вы можете оставить комментарий с пояснением"></textarea>
            </div>
        </div>

        <div class="add-object__content" v-show="formStep == 8">
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Универсальный проект</label>
                    <span class="add-object__label-text">Услуга оказывается во всем здании</span>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Разумное приспособление</label>
                    <span class="add-object__label-text">Услуга оказывается на 1 этаже</span>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Есть доставка товаров или вызов специалиста на дом </label>
                    <span class="add-object__label-text">Услуга оказывается дистанционно</span>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Кнопка вызова персонала</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Оказание ситуационной помощи со стороны персонала</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Протоколы/инструкции по коммуникации и оказанию помощи маломобильным гражданам</label>
                    <span class="add-object__label-text">Был ли обучен персонал</span>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="add-object__line --lrg">
                <div class="col">
                    <label class="add-object__label">Льготы для людей с инвалидностью 1, 2, 3 групп, пожилых, детей</label>
                </div>
                <div class="col --small">
                    <div class="select">
                        <select>
                            <option selected>Неизвестно</option>
                            <option>Да</option>
                            <option>Нет</option>
                        </select>
                    </div>
                </div>
            </div>


            <div class="add-object__line --lrg">
                <h5 class="add-object__title --lrg">Оценка доступности зоны</h5>
            </div>
            <div class="add-object__line --av-green">
                <div class="col">
                    <p class="add-object__text">Люди, передвигающиеся на кресло-коляске</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg --av-green">
                <div class="col">
                    <p class="add-object__text">Люди с нарушением опорно-двигательного аппарата</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg --av-yellow">
                <div class="col">
                    <p class="add-object__text">Люди с нарушениями зрения</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg --av-red">
                <div class="col">
                    <p class="add-object__text">Люди с нарушениями слуха</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg --av-red">
                <div class="col">
                    <p class="add-object__text">Люди с интелектуальной инвалидностью</p>
                </div>
                <div class="col --small">
                    <div class="add-object__rating">
                        <span></span>
                    </div>
                </div>
                <div class="add-object__rating-text --text-green">доступно</div>
                <div class="add-object__rating-text --text-yellow">частично доступно</div>
                <div class="add-object__rating-text --text-red">не доступно</div>
            </div>
            <div class="add-object__line --lrg">
                <h5 class="add-object__title">Комментарий к зоне парковки</h5>
            </div>
            <div class="add-object__line">
                <textarea class="add-object__textarea" placeholder="Система оценила доступность парковки. Если вы не согласны с оценкой, вы можете оставить комментарий с пояснением"></textarea>
            </div>
        </div>


        <div class="add-object__button-b">
            <button type="button" class="add-object__button --cancel" v-show="formStep == 1">
                <span>Отмена</span>
            </button>
            <button type="button" class="add-object__button --prev" v-show="formStep > 1" v-on:click="formStep -= 1">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="5" viewBox="0 0 20 5" fill="none">
                    <g clip-path="url(#clip0)">
                        <path d="M7.5 0.680096L7.5 4.3199L1.67631 2.5L7.5 0.680096Z" fill="white" stroke="white"/>
                        <path d="M8.0002 2.5L19.2002 2.5" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/>
                    </g>
                    <defs>
                        <clipPath id="clip0">
                            <path d="M20 5L0 5L-4.37114e-07 1.74846e-06L20 0L20 5Z" fill="white"/>
                        </clipPath>
                    </defs>
                </svg>
                <span>Назад</span>
            </button>
            <button type="button" class="add-object__button --next" v-show="formStep < formSteps.length" v-on:click="formStep += 1">
                <span>Далее </span>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="5" viewBox="0 0 20 5" fill="none">
                    <g clip-path="url(#clip0)">
                        <path d="M12.5 4.3199V0.680095L18.3237 2.5L12.5 4.3199Z" fill="white" stroke="white"/>
                        <path d="M11.9998 2.5H0.799805" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/>
                    </g>
                    <defs>
                        <clipPath id="clip0">
                            <path d="M0 0H20V5H0V0Z" fill="white"/>
                        </clipPath>
                    </defs>
                </svg>
            </button>
            <button type="button" class="add-object__button --submit" v-show="formStep == formSteps.length">
                <span>Готово!</span>
            </button>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        data() {
            return {
                formStep: 1,
                formSteps: [
                    {title:'Общая информация'},
                    {title:'Парковка'},
                    {title:'Входная группа'},
                    {title:'Пути движения по объекту'},
                    {title:'Зона оказания услуги'},
                    {title:'Туалет'},
                    {title:'Навигация'},
                    {title:'Доступность услуги'}
                ]
            };
        },
        methods: { 
            formStepUpdate: function (step) {
                data().formStep = step;
            }
        }
    }
</script>

<style lang="scss">
    @import "./../../styles/mixins.scss";
    .--av-green {
        .add-object__rating {
            &:before {
                background: $green;
                right: 15px;
            }
            &:after {
                background: url('data:image/svg+xml;base64, PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSItNTM5IDEwOTEgMjAgMjAiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgLTUzOSAxMDkxIDIwIDIwOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQoJPHBhdGggZmlsbD0iIzNEQkEzQiIgZD0iTS01MjksMTA5MWMtNS41LDAtMTAsNC41LTEwLDEwczQuNSwxMCwxMCwxMHMxMC00LjUsMTAtMTBTLTUyMy41LDEwOTEtNTI5LDEwOTF6IE0tNTMwLDExMDVsLTMuNy0zLjhsMS41LTEuNWwyLjIsMi4zbDQuOC01bDEuNSwxLjVMLTUzMCwxMTA1eiIvPg0KCTxwb2x5Z29uIGZpbGw9IiNGRkZGRkYiIHBvaW50cz0iLTUzMCwxMTAyIC01MzIuMiwxMDk5LjcgLTUzMy43LDExMDEuMiAtNTMwLDExMDUgLTUyMy43LDEwOTguNiAtNTI1LjIsMTA5NyIvPg0KPC9zdmc+DQo=');
                right: 15px;
                margin: 0 -10px 0 0;
            }
        }
        .--text-green {
            display: block;
        }
    }
    .--av-yellow {
        .add-object__rating {
            &:before {
                background: $yellow;
                width: 50%;
            }
            &:after {
                background: url('data:image/svg+xml;base64, PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSItNTM5IDEwOTEgMjAgMjAiIHdpZHRoPSIyMHB4IiBoZWlnaHQ9IjIwcHgiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgLTUzOSAxMDkxIDIwIDIwOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQoJPHBhdGggZmlsbD0iI0Y4QUMxQSIgZD0iTS01MjksMTA5MWMtNS41LDAtMTAsNC41LTEwLDEwczQuNSwxMCwxMCwxMHMxMC00LjUsMTAtMTBTLTUyMy41LDEwOTEtNTI5LDEwOTF6IE0tNTIzLDExMDNoLTEydi00aDEyVjExMDN6Ii8+DQoJPHJlY3QgZmlsbD0iI0ZGRkZGRiIgeD0iLTUzNSIgeT0iMTA5OSIgY2xhc3M9InN0MSIgd2lkdGg9IjEyIiBoZWlnaHQ9IjQiLz4NCjwvc3ZnPg0K');
                left: 50%;
                margin: 0 0 0 -10px;
            }
        }
        .--text-yellow {
            display: block;
        }
    }
    .--av-red {
        .add-object__rating {
            &:before {
                background: $red;
                width: 15px;
            }
            &:after {
                background: url('data:image/svg+xml;base64, PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSItNTM5IDEwOTEgMjAgMjAiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgLTUzOSAxMDkxIDIwIDIwOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQoJPHBhdGggZmlsbD0iI0RFMTIyMCIgZD0iTS01MjksMTA5MWMtNS41LDAtMTAsNC41LTEwLDEwczQuNSwxMCwxMCwxMHMxMC00LjUsMTAtMTBTLTUyMy41LDEwOTEtNTI5LDEwOTF6IE0tNTI1LDExMDMuNmwtMS40LDEuNGwtMi42LTIuNmwtMi42LDIuNmwtMS40LTEuNGwyLjYtMi42bC0yLjYtMi42bDEuNC0xLjRsMi42LDIuNmwyLjYtMi42bDEuNCwxLjRsLTIuNiwyLjZMLTUyNSwxMTAzLjZ6Ii8+DQoJPHBvbHlnb24gZmlsbD0iI0ZGRkZGRiIgcG9pbnRzPSItNTI2LjQsMTA5NyAtNTI5LDEwOTkuNiAtNTMxLjYsMTA5NyAtNTMzLDEwOTguNCAtNTMwLjQsMTEwMSAtNTMzLDExMDMuNiAtNTMxLjYsMTEwNSAtNTI5LDExMDIuNCAtNTI2LjQsMTEwNSAtNTI1LDExMDMuNiAtNTI3LjYsMTEwMSAtNTI1LDEwOTguNCIvPg0KPC9zdmc+DQo=');
                left: 15px;
                margin: 0 0 0 -10px;
            }
        }
        .--text-red {
            display: block;
        }
    }
    .add-object {
        .step {
            -ms-flex-preferred-size: 0;
            flex-basis: 0;
            -ms-flex-positive: 1;
            flex-grow: 1;
            max-width: 100%;
        }
        &__textarea {
            width: 100%;
            display: block;
            min-height: 120px;
            border: 1px solid $stroke;
            padding: 14px 20px;
            font-size: 16px;
            line-height: 20px;
        }
        &__rating {
            width: 150px;
            height: 10px;
            position: relative;
            padding: 0 15px;
            margin: 5px 0 0;
            background: $light-gray;
            border-radius: 10px;
            span {
                display: block;
                height: 10px;
                width: 120px;
                position: relative;
                border-left: 1px solid rgba(123,149,167,0.3);
                border-right: 1px solid rgba(123,149,167,0.3);
                &:before {
                    content: '';
                    position: absolute;
                    width: 1px;
                    height: 100%;
                    left: 50%;
                    background: rgba(123,149,167,0.3);
                }
            }
            &-text {
                position: absolute;
                font-size: 16px;
                line-height: 20px;
                left: 100%;
                top: 0;
                margin: 0 0 0 40px;
                display: none;
                white-space: nowrap;
            }
            &:before {
                 content: '';
                 position: absolute;
                 width: auto;
                 left: 0;
                 top: 0;
                 opacity: 0.5;
                 height: 100%;
                 overflow: hidden;
                 -webkit-border-radius:10px 0 0 10px;
                 -moz-border-radius:10px 0 0 10px;
                 border-radius:10px 0 0 10px;
            }
            &:after {
                content: '';
                display: block;
                width: 20px;
                height: 20px;
                position: absolute;
                top: -5px;
            }
        }
        &__text {
             font-size: 16px;
             line-height: 20px;
        }
        &__title {
            font-weight: bold;
            font-size: 22px;
            line-height: 30px;
            margin: 0 0 -5px;
            &.--lrg {
                font-size: 32px;
                line-height: 40px;
                margin: 10px 0 0;
            }
            &.--label {
                font-size: 16px;
                line-height: 20px;
                margin: 10px 0 -10px;
             }
        }
        &__button {
            &-b {
                width: 670px;
                margin: 56px 0 0;
                display: flex;
                justify-content: space-between;
            }
            transition: opacity 0.4s;
            cursor: pointer;
            width: 180px;
            height: 50px;
            line-height: 50px;
            text-align: center;
            border: none;
            outline: none;
            &:hover {
                opacity: 0.7;
            }
            span {
                display: inline-block;
                vertical-align: middle;
                font-size: 16px;
                color: #fff;
            }
            &.--cancel {
                background: $stroke;
            }
            &.--next {
                background: $blue;
                padding: 0 30px 0 0;
                text-align: right;
                svg {
                    display: inline-block;
                    vertical-align: middle;
                    margin: 0 0 0 22px;
                }
            }
            &.--prev {
                background: $stroke;
                padding: 0  0 0 30px;
                text-align: left;
                svg {
                    display: inline-block;
                    vertical-align: middle;
                    margin: 0 22px 0 0;
                }
            }
            &.--submit {
                background: $green;
            }
        }
        &__error {
            display: none;
            position: absolute;
            left: 100%;
            margin: 0 0 0 40px;
            background: $red;
            padding: 15px 20px;
            color: #fff;
            line-height: 20px;
            font-size: 16px;
            white-space: nowrap;
            z-index: 2;
            &:before {
                content: '';
                position: absolute;
                left: -10px;
                top: 50%;
                margin: -10px 0 0;
                border-right: 10px solid $red;
                border-top: 10px solid transparent;
                border-bottom: 10px solid transparent;
            }
        }
        &__label {
             font-weight: bold;
             font-size: 16px;
             line-height: 20px;
             padding: 15px 50px 0 0;
             display: block;
             &.--gray {
                font-size: 16px;
                line-height: 20px;
                color: $text;
                font-weight: 400;
             }
             &-text {
                  font-size: 12px;
                  line-height: 20px;
                  color: #5B6067;
                  display: block;
                  padding: 0 50px 0 0;
             }
        }
        &__step {
            background: $light-gray;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            height: 10px;
            border-radius: 10px;
            overflow: hidden;
            .step {
                position: relative;
                &-progress {
                     position: absolute;
                     background: $blue;
                     width: 0;
                     left: 0;
                     top: 0;
                     height: 100%;
                     -webkit-border-radius: 0 10px 10px 0;
                     -moz-border-radius: 0 10px 10px 0;
                     border-radius: 0 10px 10px 0;
                }
                &:before {
                    content: '';
                    position: absolute;
                    left: 0;
                    top: 0;
                    height: 100%;
                    width: 1px;
                    background: rgba(123, 149, 167, 0.3);
                }
                &:first-child {
                    &:before {
                        display: none;
                    }
                }
                &.checked {
                    .step-progress {
                        width: 100%;
                    }
                    & + .checked, & + .--progresses {
                        .step-progress {
                            &:before {
                                content:'';
                                height: 100%;
                                position: absolute;
                                background: $blue;
                                width: 10px;
                                left: -10px;
                                top: 0;
                            }
                        }
                    }
                }
            }
            &-info {
                 display: -ms-flexbox;
                 display: flex;
                 -ms-flex-wrap: wrap;
                 flex-wrap: wrap;
                 margin: 7px 0 0;
                 .step {
                     font-size: 12px;
                     line-height: 16px;
                     color: $text;
                     padding: 0 24px 0 0;
                     text-align: left;
                     &.active {
                        font-weight: 700;
                     }
                 }
            }
        }
        &__form {
            background: #ffffff;
            padding: 60px 40px;
        }
        &__link {
            cursor: pointer;
            padding: 14px 23px 16px 19px;
            margin: 0 0 0 20px;
            border: 1px solid $light-gray;
             -webkit-transition: background 0.4s;
             -moz-transition: background 0.4s;
             -ms-transition: background 0.4s;
             -o-transition: background 0.4s;
             transition: background 0.4s;
            background: transparent;
            &:first-child {
                margin: 0;
            }
            &:hover, &.active {
                background: $light-gray;
            }
            &-b {
                margin: 34px 0 0;
                display: flex;
                justify-content: flex-start;
                align-items: baseline;
            }
        }
        &__content {
            margin: 30px 0 0;
            width: 670px;
        }
        &__top {
            margin: 46px 0 0;
            display: flex;
            color: $black;
            align-items: flex-end;
            &-step {
                 font-weight: bold;
                 font-size: 18px;
                 line-height: 20px;
                 margin: 0 0 5px 0;
                 width: 110px;
            }
            &-title {
                 font-weight: 600;
                 font-size: 48px;
                 line-height: 50px;
                 margin: 0;
            }
        }
        &__line {
            display: flex;
            position: relative;
            margin: 20px 0 0;
            &.--lrg {
                margin: 40px 0 0;
            }
            &:first-child {
                 margin: 0;
             }
            &.error {
                .add-object__error {
                    display: block;
                }
            }
            .col {
                position: relative;
                -ms-flex-preferred-size: 0;
                flex-basis: 0;
                -ms-flex-positive: 1;
                flex-grow: 1;
                max-width: 100%;
                input {
                    width: 100%;
                }
                &.--long {
                    min-width: 500px;
                    max-width: 500px;
                }
                &.--small {
                    min-width: 150px;
                    max-width: 150px;
                }
            }
            .input input {
                font-size: 16px;
            }
            .select select {
                font-size: 16px;
            }
            .photo-input {
                margin: 0 25px 25px 0;
                &:nth-child(5n) {
                    margin: 0 0 25px;
                }
                &__wrapper {
                    margin: 0 0 -25px;
                }
            }
            .add-link {
                margin: 15px 0 0;
            }
        }
        &__info {
            position: absolute;
            right: -80px;
            width: 40px;
            height: 40px;
            top: 5px;
            &-text {
                font-size: 14px;
                line-height: 20px;
                background: $light-gray;
                position: absolute;
                width: 390px;
                padding: 15px 20px;
                top: 55px;
                left: 0;
                display: none;
                &:before {
                    content: '';
                    position: absolute;
                    width: 0;
                    height: 0;
                    bottom: 100%;
                    left: 10px;
                    border-bottom: 10px solid $light-gray;
                    border-right: 10px solid transparent;
                    border-left: 10px solid transparent;
                }
            }
        }
    }
</style>