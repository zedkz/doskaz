<template>
    <div class="container">
        <loading :is-full-page="true" :active="isLoading"/>
        <form @submit.prevent="submit">
            <div class="complaint__item">
                <h4 class="title --md">Персональная информация</h4>
                <div class="complaint__line complaint__row">
                    <div class="complaint__col required" :class="{error: violations['complainant.lastName']}">
                        <label for="11" class="label">Фамилия</label>
                        <div class="input">
                            <input id="11" type="text" v-model="complaint.complainant.lastName">
                        </div>
                    </div>
                    <div class="complaint__col required" :class="{error: violations['complainant.firstName']}">
                        <label for="12" class="label">Имя</label>
                        <div class="input">
                            <input id="12" type="text" v-model="complaint.complainant.firstName">
                        </div>
                    </div>
                </div>
                <div class="complaint__line complaint__row">
                    <div class="complaint__col required" :class="{error: violations['complainant.middleName']}">
                        <label for="21" class="label">Отчество</label>
                        <div class="input">
                            <input id="21" type="text" v-model="complaint.complainant.middleName">
                        </div>
                    </div>
                    <div class="complaint__col required" :class="{error: violations['complainant.iin']}">
                        <label for="22" class="label">ИИН</label>
                        <div class="input">
                            <input id="22" type="text" v-model="complaint.complainant.iin">
                        </div>
                    </div>
                </div>
                <div class="complaint__line complaint__row">
                    <div class="complaint__col --lg-2 required" :class="{error: violations['complainant.address']}">
                        <label for="31" class="label">Адрес проживания</label>
                        <div class="input">
                            <input id="31" type="text" v-model="complaint.complainant.address">
                        </div>
                    </div>
                    <div class="complaint__col required" :class="{error: violations['complainant.phone']}">
                        <label for="32" class="label">Телефон</label>
                        <div class="input">
                            <input id="32" type="text" v-model="complaint.complainant.phone">
                        </div>
                    </div>
                </div>
                <div class="complaint__line complaint__row">
                    <div class="complaint__col --lg-2 required" :class="{error: violations['authorityId']}">
                        <label for="41" class="label">Наименование органа обращения</label>
                        <div class="select">
                            <select v-model="complaint.authorityId" id="41">
                                <option v-for="authority in authorities" :key="authority.id" :value="authority.id">{{
                                    authority.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="complaint__col"></div>
                </div>
                <div class="complaint__line complaint__row">
                    <div class="checkbox">
                        <input type="checkbox" checked id="r1" v-model="complaint.rememberPersonalData">
                        <label for="r1">Запомнить мои данные</label>
                    </div>
                </div>
            </div>
            <div class="complaint__item">
                <h4 class="title --md">Жалоба</h4>
                <div class="complaint__line --sm complaint__row required" :class="{error: violations['content.type']}">
                    <div class="complaint__col --text">
                        <label for="s2" class="label --vertical">Вид жалобы</label>
                    </div>
                    <div class="complaint__col --lg">
                        <div class="select">
                            <select id="s2" v-model="complaint.content.type">
                                <option v-for="type in types" :value="type.type" :key="type.type">{{ type.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="complaint__line --sm complaint__row required"
                     :class="{error: violations['content.visitedAt']}">
                    <div class="complaint__col --text">
                        <label class="label --vertical">Дата посещения объекта</label>
                    </div>
                    <div class="complaint__col --sm">
                        <div class="input --date">
                            <vuejs-datepicker :format="format" :language="ru" v-model="complaint.content.visitedAt"/>
                        </div>
                    </div>
                </div>
                <div class="complaint__line --sm complaint__row required"
                     :class="{error: violations['content.objectName']}">
                    <div class="complaint__col --text">
                        <label for="i2" class="label --vertical">Название объекта</label>
                    </div>
                    <div class="complaint__col --lg">
                        <div class="input">
                            <input id="i2" type="text" v-model="complaint.content.objectName">
                        </div>
                    </div>
                </div>
                <div class="complaint__line --sm complaint__row required" :class="{error: violations['content.cityId']}">
                    <div class="complaint__col --text">
                        <label for="s3" class="label --vertical">Город</label>
                    </div>
                    <div class="complaint__col --lg">
                        <div class="select">
                            <select id="s3" v-model="complaint.content.cityId">
                                <option v-for="city in cities" :value="city.id" :key="city.id">{{ city.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="complaint__line --sm complaint__row required"
                     :class="{error: violations['content.street']}">
                    <div class="complaint__col --text">
                        <label for="i3" class="label --vertical">Улица</label>
                    </div>
                    <div class="complaint__col --lg">
                        <div class="input">
                            <input type="text" id="i3" v-model="complaint.content.street">
                        </div>
                    </div>
                </div>
                <div class="complaint__line --sm complaint__row required"
                     :class="{error: violations['content.building']}">
                    <div class="complaint__col --text">
                        <label for="i4" class="label --vertical">Номер дома</label>
                    </div>
                    <div class="complaint__col --sm">
                        <div class="input">
                            <input type="text" id="i4" v-model="complaint.content.building">
                        </div>
                    </div>
                </div>
                <div class="complaint__line --sm complaint__row">
                    <div class="complaint__col --text">
                        <label for="i5" class="label --vertical">Офис(если есть)</label>
                    </div>
                    <div class="complaint__col --sm">
                        <div class="input">
                            <input type="text" id="i5" v-model="complaint.content.office">
                        </div>
                    </div>
                </div>
                <div class="complaint__line --sm complaint__row required"
                     :class="{error: violations['content.visitPurpose']}">
                    <div class="complaint__col --text">
                        <label for="i6" class="label --vertical">Цель посещения объекта</label>
                    </div>
                    <div class="complaint__col --lg">
                        <div class="input">
                            <input type="text" id="i6" v-model="complaint.content.visitPurpose">
                        </div>
                    </div>
                </div>
                <div class="complaint__accordion" v-if="complaint.content.type === 'complaint2'">
                    <h3 class="title --small">Выберите из списка, что именно вас не устроило на объекте</h3>
                    <div class="complaint__accordion-item">
                        <div class="complaint__row">
                            <div class="complaint__accordion-head complaint__col --text" v-on:click="toggleClass">
                                Паркова
                            </div>
                            <div class="complaint__accordion-content complaint__col --lg">
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch1">
                                    <label for="ch1">Отсутствие специального парковочного места</label>
                                </div>
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch2">
                                    <label for="ch2">Специальное парковочное место находится далеко от входа</label>
                                </div>
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch3">
                                    <label for="ch3">Отсутствие на асфальте специальной разметки со знаком
                                        «Инвалид» </label>
                                </div>
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch4">
                                    <label for="ch4">Отсутствие специального знака «Инвалид» рядом с парковочным
                                        местом</label>
                                </div>
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch5">
                                    <label for="ch5">Отсутствие бордюрного пандуса</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="complaint__accordion-item">
                        <div class="complaint__row">
                            <div class="complaint__accordion-head complaint__col --text" v-on:click="toggleClass">
                                Входная группа
                            </div>
                            <div class="complaint__accordion-content complaint__col --lg">
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch11">
                                    <label for="ch11">Отсутствие специального парковочного места</label>
                                </div>
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch21">
                                    <label for="ch21">Специальное парковочное место находится далеко от входа</label>
                                </div>
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch31">
                                    <label for="ch31">Отсутствие на асфальте специальной разметки со знаком
                                        «Инвалид» </label>
                                </div>
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch41">
                                    <label for="ch41">Отсутствие специального знака «Инвалид» рядом с парковочным
                                        местом</label>
                                </div>
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch51">
                                    <label for="ch51">Отсутствие бордюрного пандуса</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="complaint__accordion-item">
                        <div class="complaint__row">
                            <div class="complaint__accordion-head complaint__col --text" v-on:click="toggleClass">Пути
                                движения по объекту
                            </div>
                            <div class="complaint__accordion-content complaint__col --lg">
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch12">
                                    <label for="ch12">Отсутствие специального парковочного места</label>
                                </div>
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch22">
                                    <label for="ch22">Специальное парковочное место находится далеко от входа</label>
                                </div>
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch32">
                                    <label for="ch32">Отсутствие на асфальте специальной разметки со знаком
                                        «Инвалид» </label>
                                </div>
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch42">
                                    <label for="ch42">Отсутствие специального знака «Инвалид» рядом с парковочным
                                        местом</label>
                                </div>
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch52">
                                    <label for="ch52">Отсутствие бордюрного пандуса</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="complaint__accordion-item">
                        <div class="complaint__row">
                            <div class="complaint__accordion-head complaint__col --text" v-on:click="toggleClass">Зона
                                оказания услуг
                            </div>
                            <div class="complaint__accordion-content complaint__col --lg">
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch13">
                                    <label for="ch13">Отсутствие специального парковочного места</label>
                                </div>
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch23">
                                    <label for="ch23">Специальное парковочное место находится далеко от входа</label>
                                </div>
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch33">
                                    <label for="ch33">Отсутствие на асфальте специальной разметки со знаком
                                        «Инвалид» </label>
                                </div>
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch43">
                                    <label for="ch43">Отсутствие специального знака «Инвалид» рядом с парковочным
                                        местом</label>
                                </div>
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch53">
                                    <label for="ch53">Отсутствие бордюрного пандуса</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="complaint__accordion-item">
                        <div class="complaint__row">
                            <div class="complaint__accordion-head complaint__col --text" v-on:click="toggleClass">
                                Туалет
                            </div>
                            <div class="complaint__accordion-content complaint__col --lg">
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch14">
                                    <label for="ch14">Отсутствие специального парковочного места</label>
                                </div>
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch24">
                                    <label for="ch24">Специальное парковочное место находится далеко от входа</label>
                                </div>
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch34">
                                    <label for="ch34">Отсутствие на асфальте специальной разметки со знаком
                                        «Инвалид» </label>
                                </div>
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch44">
                                    <label for="ch44">Отсутствие специального знака «Инвалид» рядом с парковочным
                                        местом</label>
                                </div>
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch54">
                                    <label for="ch54">Отсутствие бордюрного пандуса</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="complaint__accordion-item">
                        <div class="complaint__row">
                            <div class="complaint__accordion-head complaint__col --text" v-on:click="toggleClass">
                                Навигация
                            </div>
                            <div class="complaint__accordion-content complaint__col --lg">
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch15">
                                    <label for="ch15">Отсутствие специального парковочного места</label>
                                </div>
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch25">
                                    <label for="ch25">Специальное парковочное место находится далеко от входа</label>
                                </div>
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch35">
                                    <label for="ch35">Отсутствие на асфальте специальной разметки со знаком
                                        «Инвалид» </label>
                                </div>
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch45">
                                    <label for="ch45">Отсутствие специального знака «Инвалид» рядом с парковочным
                                        местом</label>
                                </div>
                                <div class="checkbox complaint__line --sm">
                                    <input type="checkbox" id="ch55">
                                    <label for="ch55">Отсутствие бордюрного пандуса</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="complaint__line complaint__row" v-if="complaint.content.type === 'complaint2'">
                    <div class="complaint__col --text">
                        <label for="t1" class="label">Другое</label>
                    </div>
                    <div class="complaint__col --lg">
                        <textarea placeholder="Текст сообщения" class="textarea" id="t1"
                                  v-model="complaint.content.comment"/>
                    </div>
                </div>
                <div class="complaint__line complaint__row" v-if="complaint.content.type === 'complaint2'">
                    <div class="checkbox">
                        <input type="checkbox" id="d1" v-model="complaint.content.threatToLife">
                        <label for="d1">Данными условиями создана угроза причинения вреда моей жизни и здоровью
                            (отметить, если это так)</label>
                    </div>
                </div>
            </div>
            <div class="complaint__item">
                <div class="complaint__line complaint__row">
                    <div class="complaint__col --text">
                        <label class="label" for="video0">Ссылка на видео</label>
                        <span class="label-text">не обязательно</span>
                    </div>
                    <div class="complaint__col --lg">
                        <div class="complaint__line --sm" v-for="(input, index) in complaint.content.videos"
                             v-bind:key="index">
                            <div class="input">
                                <input type="text" :id="`video${index}`" v-model="complaint.content.videos[index]" placeholder="http://">
                            </div>
                        </div>

                        <button type="button" @click.prevent="addVideoLink" class="add-link">Добавить еще видео</button>
                    </div>
                </div>
                <div class="complaint__line complaint__row required" id="file_required_class">
                    <div class="complaint__col --text">
                        <label for="v1" class="label">Загрузить фото</label>
                    </div>
                    <div class="complaint__col --lg">
                        <div class="photo-input__wrapper">
                            <div class="photo-input">
                                <input type="file" accept="image/*" @change="imageFileChanged" id="file"/>
                                <span v-if="url" v-bind:style="{ 'background-image': 'url(' + url + ')' }"></span>
                            </div>
                        </div>

                        <button type="button" @click="addPhotoInput" class="add-link">Добавить еще фото</button>
                        <div class="complaint__line">
                            <button type="submit" class="button">
                                Отправить
                            </button>
                            <p class="complaint__hide-text" v-if="hasViolations">Заполните, пожалуйста, все
                                обязательные поля</p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import {required} from "vuelidate/lib/validators"
    import api from '@/api'
    import get from 'lodash/get'
    import Loading from 'vue-loading-overlay'
    import 'vue-loading-overlay/dist/vue-loading.css'

    const types = [
        {type: 'complaint1', name: 'Жалоба на отсутствие пандуса / подъемника на входе в объект'},
        {
            type: 'complaint2',
            name: 'Жалоба на отсутствие доступа на объект или несоответствии функциональных зон объекта требованиям нормативного законодательства'
        }
    ];

    export default {
        data() {
            return {
                isLoading: false,
                authorities: [],
                cities: [],
                complaint: {
                    complainant: {
                        firstName: '',
                        lastName: '',
                        middleName: '',
                        iin: '',
                        address: '',
                        phone: ''
                    },
                    authorityId: null,
                    rememberPersonalData: true,
                    content: {
                        type: types[0].type,
                        videos: ['']
                    }
                },
                violations: {},


                form: {
                    name: "",
                    surname: "",
                    patronymic: "",
                    iin: "",
                    address: "",
                    phone: "",
                    agency: "",
                    type: "",
                    date: "",
                    objectName: "",
                    city: "",
                    street: "",
                    houseNumber: "",
                    purpose: ""
                },
                imageFile: "",
                format: "dd.MM.yyyy",
                isOpen: true,
                ru: vdp_translation_ru.js,
                inputs: [],
                photos: [],
                url: null
            };
        },
        components: {
            vuejsDatepicker,
            Loading
        },
        mounted() {
            this.initialize()
        },
        methods: {
            async initialize() {
                this.isLoading = true;
                await Promise.all([
                    this.loadAuthorities(),
                    this.loadCities()
                ]);
                this.isLoading = false;
            },
            async loadAuthorities() {
                const {data: authorities} = await api.get('complaints/authorities');
                this.authorities = authorities;
                this.complaint.authorityId = authorities[0].id
            },
            async loadCities() {
                const {data: cities} = await api.get('complaints/cities');
                this.cities = cities;
                this.complaint.content.cityId = cities[0].id
            },
            async submit() {
                this.isLoading = true;
                this.violations = {};
                try {
                    await api.post('complaints', this.complaint)
                } catch (e) {
                    this.violations = get(e, 'response.data.errors.violations').reduce((violations, violation) => {
                        violations[violation.propertyPath] = violation.title;
                        return violations
                    }, {})
                } finally {
                    this.isLoading = false;
                }
            },
            toggleClass: function (event) {
                //Чтобы закрывались остальные пункты при открытии текущего
                //var matches = document.querySelectorAll('.complaint__accordion-head');
                //for(var i = 0; i < matches.length; i++) {
                //  matches[i].classList.remove('isActive');
                //}
                event.target.classList.toggle('isActive');
            },
            addVideoLink() {
                this.complaint.content.videos.push('')
            },
            addPhotoInput(e) {
                e.stopPropagation();
                this.photos.push({
                    photoInput: ''
                });
                e.preventDefault();
            },
            imageFileChanged(event) {
                var input = event.target;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = (e) => {
                        this.url = e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        },
        computed: {
            types() {
                return types
            },
            hasViolations() {
                return Object.values(this.violations).length > 0
            }
        }
    }


</script>

<style lang="scss">

    .required {
        label {
            &:after {
                content: '*';
                color: #E0202E;
                margin: 0 0 0 5px;
            }
        }

        &.error {
            .input, .select select, .photo-input {
                border-color: #E0202E;
            }
        }
    }

    .complaint {
        &__hide {
            &-text {
                display: inline-block;
                margin: 0 0 0 20px;
            }
        }

        &__row {
            display: flex;
        }

        &__col {
            flex-basis: 0;
            flex-grow: 1;
            max-width: 100%;
            padding: 0 20px;

            &.--sm {
                flex: 0 0 (170/1080)*100%;
                max-width: (170/1080)*100%;
            }

            &.--text {
                flex: 0 0 (240/1080)*100%;
                max-width: (240/1080)*100%;
            }

            &.--lg {
                flex: 0 0 (840/1080)*100%;
                max-width: (840/1080)*100%;
            }

            &.--lg-2 {
                flex: 0 0 (690/1080)*100%;
                max-width: (690/1080)*100%;
            }

            &:first-child {
                padding: 0 20px 0 0;
            }

            &:last-child {
                padding: 0 0 0 20px;
            }
        }

        &__line {
            margin: 38px 0 0;

            &.--sm {
                margin: 20px 0 0;
            }

            &:first-child {
                margin: 0;
            }
        }

        &__item {
            background: #ffffff;
            margin: 20px 0;
            padding: 30px 40px 40px;

            .label {
                font-size: 16px;
                line-height: 20px;
                margin: 0 0 6px;
                display: block;
                font-weight: 700;

                &-text {
                    font-size: 12px;
                    line-height: 20px;
                    color: #5B6067;
                    display: block;
                }

                &.--vertical {
                    padding: 15px 0 0;
                    font-size: 16px;
                    line-height: 20px;
                    font-weight: 400;
                    color: #5B6067;
                }
            }

            .add-link {
                margin: 15px 0 0;
                display: inline-block;
            }

            .photo-input {
                width: 80px;
                height: 80px;
                border: 1px solid #7B95A7;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                position: relative;
                background: url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjUiIGhlaWdodD0iMjUiIHZpZXdCb3g9IjAgMCAyNSAyNSIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTI0LjU1NTcgMTAuMDQ5N0gxNS4wNjE1VjAuNTU1NTQySDEwLjA0OThWMTAuMDQ5N0gwLjU1NTY2NFYxNS4wNjE0SDEwLjA0OThWMjQuNTU1NUgxNS4wNjE1VjE1LjA2MTRIMjQuNTU1N1YxMC4wNDk3WiIgZmlsbD0iIzdCOTVBNyIvPgo8L3N2Zz4K") center no-repeat;
                background-size: 24px;
                margin: 0 30px 30px 0;
                display: inline-block;

                &__wrapper {
                    font-size: 0;
                    margin: 0 0 -30px;
                }

                span {
                    display: block;
                    width: 100%;
                    height: 100%;
                    position: relative;
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;
                    margin: 0 auto;
                    z-index: 1;
                }

                input {
                    cursor: pointer;
                    position: absolute;
                    opacity: 0;
                    width: 100%;
                    height: 100%;
                    z-index: 2;
                }
            }

            &:first-child {
                margin: 0;
            }
        }

        &__accordion {
            margin: 60px 0 0;

            .title {
                margin: 0 0 10px;
            }

            &-item {
                border-bottom: 1px dashed #7B95A7;
                padding: 20px 0;
            }

            &-content {
                display: none;

                .complaint__line:first-child {
                    margin: 4px 0 0;
                }
            }

            &-head {
                font-weight: 700;
                cursor: pointer;
                flex: 0 0 100% !important;
                max-width: 100% !important;
                position: relative;
                line-height: 30px;
                height: 30px;

                &:after {
                    position: absolute;
                    top: 50%;
                    margin: -2px 0 0;
                    right: 5px;
                    content: '';
                    border-top: 5px solid #333333;
                    border-right: 5px solid transparent;
                    border-left: 5px solid transparent;
                }

                &.isActive {
                    flex: 0 0 (240/1080)*100% !important;
                    max-width: (240/1080)*100% !important;

                    &:after {
                        margin: -2px 0 0 10px;
                        right: auto;
                        border-top: none;
                        border-bottom: 5px solid #333333;

                    }

                    & + .complaint__accordion-content {
                        display: block;
                    }
                }
            }
        }
    }
</style>