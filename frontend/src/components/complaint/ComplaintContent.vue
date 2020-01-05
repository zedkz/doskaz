<template>
    <div class="container">
        <loading :is-full-page="true" :active="isLoading"/>
        <div>
            <div class="complaint__item">
                <h4 class="title --md">Персональная информация</h4>
                <div class="complaint__line complaint__row">
                    <div class="complaint__col required" :class="{error: violations['complainant.lastName']}">
                        <label for="11" class="label">Фамилия</label>
                        <div class="input">
                            <input id="11" type="text" v-model="complaint.complainant.lastName" @click="focus.lastName = true">
                        </div>
                        <span class="violations_error" v-if="focus.lastName">{{violations['complainant.lastName']}}</span>
                    </div>
                    <div class="complaint__col required" :class="{error: violations['complainant.firstName']}">
                        <label for="12" class="label">Имя</label>
                        <div class="input">
                            <input id="12" type="text" v-model="complaint.complainant.firstName" @click="focus.firstName = true">
                        </div>
                        <span class="violations_error" v-if="focus.firstName">{{violations['complainant.firstName']}}</span>
                    </div>
                </div>
                <div class="complaint__line complaint__row">
                    <div class="complaint__col required" :class="{error: violations['complainant.middleName']}">
                        <label for="21" class="label">Отчество</label>
                        <div class="input">
                            <input id="21" type="text" v-model="complaint.complainant.middleName" @click="focus.middleName = true">
                        </div>
                        <span class="violations_error" v-if="focus.middleName">{{violations['complainant.middleName']}}</span>
                    </div>
                    <div class="complaint__col required" :class="{error: violations['complainant.iin']}">
                        <label for="22" class="label">ИИН</label>
                        <div class="input">
                            <input id="22" type="text" v-model="complaint.complainant.iin" @click="focus.iin = true">
                        </div>
                        <span class="violations_error" v-if="focus.iin">{{violations['complainant.iin']}}</span>
                    </div>
                </div>
                <div class="complaint__line complaint__row">
                    <div class="complaint__col --lg-2 required" :class="{error: violations['complainant.address']}">
                        <label for="31" class="label">Адрес проживания</label>
                        <div class="input">
                            <input id="31" type="text" v-model="complaint.complainant.address" @click="focus.address = true">
                        </div>
                        <span class="violations_error" v-if="focus.address">{{violations['complainant.address']}}</span>
                    </div>
                    <div class="complaint__col required" :class="{error: violations['complainant.phone']}">
                        <label for="32" class="label">Телефон</label>
                        <div class="input">
                            <input id="32" type="text" v-model="complaint.complainant.phone" @click="focus.phone = true">
                        </div>
                        <span class="violations_error" v-if="focus.phone">{{violations['complainant.phone']}}</span>
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
                            <vuejs-datepicker id="x3" :format="format" :language="ru" v-model="complaint.content.visitedAt"/>
                        </div>
                        <span class="violations_error" v-if="focus.visitedAt">{{violations['content.visitedAt']}}</span>
                    </div>
                </div>
                <div class="complaint__line --sm complaint__row required"
                     :class="{error: violations['content.objectName']}">
                    <div class="complaint__col --text">
                        <label for="i2" class="label --vertical">Название объекта</label>
                    </div>
                    <div class="complaint__col --lg">
                        <div class="input">
                            <input id="i2" type="text" v-model="complaint.content.objectName" @click="focus.objectName = true">
                        </div>
                        <span class="violations_error" v-if="focus.objectName">{{violations['content.objectName']}}</span>
                    </div>
                </div>
                <div class="complaint__line --sm complaint__row required"
                     :class="{error: violations['content.cityId']}">
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
                            <input type="text" id="i3" v-model="complaint.content.street" @click="focus.street = true">
                        </div>
                        <span class="violations_error" v-if="focus.street">{{violations['content.street']}}</span>
                    </div>
                </div>
                <div class="complaint__line --sm complaint__row required"
                     :class="{error: violations['content.building']}">
                    <div class="complaint__col --text">
                        <label for="i4" class="label --vertical">Номер дома</label>
                    </div>
                    <div class="complaint__col --sm">
                        <div class="input">
                            <input type="text" id="i4" v-model="complaint.content.building" @click="focus.building = true">
                        </div>
                        <span class="violations_error" v-if="focus.building">{{violations['content.building']}}</span>
                    </div>
                </div>
                <div class="complaint__line --sm complaint__row">
                    <div class="complaint__col --text">
                        <label for="i5" class="label --vertical">Офис(если есть)</label>
                    </div>
                    <div class="complaint__col --sm">
                        <div class="input">
                            <input type="text" id="i5" v-model="complaint.content.office" @click="focus.office = true">
                        </div>
                        <span class="violations_error" v-if="focus.office">{{violations['content.office']}}</span>
                    </div>
                </div>
                <div class="complaint__line --sm complaint__row required"
                     :class="{error: violations['content.visitPurpose']}">
                    <div class="complaint__col --text">
                        <label for="i6" class="label --vertical">Цель посещения объекта</label>
                    </div>
                    <div class="complaint__col --lg">
                        <div class="input">
                            <input type="text" id="i6" v-model="complaint.content.visitPurpose" @click="focus.visitPurpose = true">
                        </div>
                        <span class="violations_error" v-if="focus.visitPurpose">{{violations['content.visitPurpose']}}</span>
                    </div>
                </div>
                <div class="complaint__accordion" v-if="complaint.content.type === 'complaint2'">
                    <h3 class="title --small">Выберите из списка, что именно вас не устроило на объекте</h3>


                    <div class="complaint__accordion-item" v-for="field in fields" :key="field.key">
                        <div class="complaint__row">
                            <div class="complaint__accordion-head complaint__col --text" v-on:click="toggleClass">
                                {{ field.title }}
                            </div>
                            <div class="complaint__accordion-content complaint__col --lg">
                                <div class="checkbox complaint__line --sm" v-for="option in field.options"
                                     :key="option.key">
                                    <input type="checkbox" :id="`option-${field.key}-${option.key}`"
                                           v-model="complaint.content.options[option.key]">
                                    <label :for="`option-${field.key}-${option.key}`">{{ option.label }}</label>
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
                                <input type="text" :id="`video${index}`" v-model="complaint.content.videos[index]"
                                       placeholder="http://">
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
                            <div class="photo-input" v-for="(photo, index) in photosRaw" :key="index">
                                <input type="file" accept="image/*" @change="imageFileChanged($event, index)"/>
                                <span v-if="photosPreview[index]"
                                      v-bind:style="{ 'background-image': 'url(' + photosPreview[index] + ')' }"></span>
                            </div>
                        </div>

                        <button type="button" @click.prevent="addPhotoInput" class="add-link">Добавить еще фото</button>
                        <div class="complaint__line">
                            <button class="button" @click="submit">
                                Отправить
                            </button>
                            <p class="complaint__hide-text" v-if="hasViolations">Заполните, пожалуйста, все
                                обязательные поля</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import api from '@/api'
    import get from 'lodash/get'
    import Loading from 'vue-loading-overlay'
    import 'vue-loading-overlay/dist/vue-loading.css'

    const types = [
        {
            type: 'complaint1',
            name: 'Жалоба на отсутствие пандуса / подъемника на входе в объект'
        },
        {
            type: 'complaint2',
            name: 'Жалоба на отсутствие доступа на объект или несоответствии функциональных зон объекта требованиям нормативного законодательства'
        }
    ];

    const fields = [
        {
            key: 'parking',
            title: 'Парковка',
            options: [
                {key: 'e7dc7624-c80c-4ae8-b7bd-2c69f35e06e3', label: 'Отсутствие специального парковочного места'},
                {
                    key: '8ab4229b-c978-4493-b4c4-a346d57ec03b',
                    label: 'Специальное парковочное место находится далеко от входа'
                },
                {
                    key: '7752cb1a-365f-4d99-b536-01e3eeddeb3f',
                    label: 'Отсутствие на асфальте специальной разметки со знаком «Инвалид»'
                },
                {
                    key: 'a5a91cab-807e-4366-b9ec-420fca40a849',
                    label: 'Отсутствие специального знака «Инвалид» рядом с парковочным местом»'
                },
                {key: '052d6769-dd4f-49eb-a759-349596733089', label: 'Отсутствие бордюрного пандуса'},
                {
                    key: 'cbcba0f9-f5f9-4ee5-95fd-db9f857efdc8',
                    label: 'Наличие высокого бордюра в месте съезда с парковки на тротуар/ бордюрного пандуса'
                },
            ]
        },
        {
            key: 'inputGroup',
            title: 'Входная группа',
            options: [
                {key: 'e91a378c-eaaf-45d8-aaf0-711def5e395b', label: 'Крутой уклон пандуса'},
                {key: '154ed3ee-ed9c-45b9-a93e-f1d66151c262', label: 'Узкий пандус'},
                {key: '202e4587-b204-4148-a478-a403011da336', label: 'Скользкое покрытие пандуса'},
                {
                    key: '7946cc13-d816-4e1e-b095-21a7d4c17d41',
                    label: 'Вместо пандуса/подъемника установлен швеллер/ колейная аппарель'
                },
                {key: '9b6eea82-3aab-43f6-a5c8-f9537e1da5fd', label: 'Отсутствие поручней у пандуса с 2-х сторон'},
                {key: '347a8414-ce3d-4869-933b-73eefbf44dc4', label: 'Отсутствие бортиков у пандуса'},
                {key: 'b7985e98-a703-41c7-8cb8-2018f9297228', label: 'Подъемник в неисправном состоянии'},
                {
                    key: '0e4218b0-0e96-4ea6-816e-cc87c528fac2',
                    label: 'Отсутствие тактильной полосы на нижней и верхней ступенях лестницы'
                },
                {
                    key: '6c675929-1b9f-4b16-83c7-5959f6933da6',
                    label: 'Узкая разворотная площадка (начало, середина, конец пандуса)'
                },
                {key: '65661b0c-04dd-47d0-b1d0-7e8410268b8f', label: 'Узкая площадка перед входной дверью'},
                {key: '8b024e9b-8363-401d-8284-284c23c94df5', label: 'Узкая входная дверь'},
                {key: '5fdab5c7-2142-4805-bd81-290f43b84126', label: 'Наличие высокого порога у входной двери'},
                {key: 'fb9cb374-1148-4d8e-8fc9-71c8122fb1af', label: 'Входная дверь без фиксации'},
                {
                    key: '135ef242-5e6d-47c7-89d3-9c74ab2bd6d0',
                    label: 'Отсутствие контрастной маркировки на входной стеклянной двери'
                },
                {key: '68cbf35c-3cc4-4f40-93c7-12754fe93e65', label: 'Узкий тамбур'},
                {key: 'a3847f00-f6c1-4db7-9c3f-6419512de951', label: 'Наличие ступени (-ней) в тамбуре'},
            ]
        },
        {
            key: 'movement',
            title: 'Пути движения по объекту',
            options: [
                {key: 'a815cdab-07a0-4294-9453-0a2265f8c2d8', label: 'Отсутствие лифта/скаломобиля'},
                {key: 'e2cbadbd-cd70-4015-a1be-838beab71c39', label: 'Узкий лифт'},
                {key: 'f2d6378e-79c5-49da-abe8-6f143ad7e9c9', label: 'Отсутствие внутренних пандусов/подъемников'},
                {key: '74e8697d-6d85-409d-8867-c3bfef30370b', label: 'Крутой уклон внутреннего пандуса'},
                {key: 'f0808216-223e-413a-bb05-aa52d9e9581d', label: 'Узкий внутренний пандус'},
                {key: '78110447-d877-412d-abb3-786a6b3a7bbb', label: 'Скользкое покрытие внутреннего пандуса'},
                {
                    key: 'bb43be62-8457-4ab9-be12-27b0d1e6e092',
                    label: 'Вместо внутреннего пандуса/подъемника установлен швеллер/ колейная аппарель'
                },
                {key: 'b57ca558-dfc9-4e17-b39b-cb289aa9822c', label: 'Отсутствие поручней у пандуса с 2-х сторон'},
                {key: 'dcf1a252-d145-42a8-bae7-6749cacd323a', label: 'Отсутствие бортиков у пандуса'},
                {key: '3dbbc686-7340-46fb-8b59-e40ee6462b67', label: 'Подъемник в неисправном состоянии'},
                {key: '84eb75f9-0ea3-469e-adee-931a6ae00028', label: 'Узкий или заставленный мебелью коридор'},
                {key: 'b8b216e8-3691-4560-b468-2da1fbdb3330', label: 'Скользкое покрытие пола'},
                {key: '98a7430e-9f5c-4c7d-8346-08aee38f6539', label: 'Отсутствие тактильных дорожек'},
                {key: '7ed5fdbf-98c8-427d-8ff4-6fd2f3c57a56', label: 'Узкая ширина дверных проемов'},
                {key: 'fb558668-03f4-44ff-a15f-e08c7eb70e34', label: 'Высокие пороги в дверных проемах'},
            ]
        },
        {
            key: 'serviceZone',
            title: 'Зона оказания услуг',
            options: [
                {
                    key: 'd45aa08a-f924-4eeb-8319-6a836842daf2',
                    label: 'Слишком низкая/высокая рабочая поверхности стола, стойки'
                },
                {key: 'a642c676-a789-4ce7-ba17-3d9ffb5332e8', label: 'Отсутствие свободного пространства около мебели'},
                {
                    key: 'ec7393f7-272a-42ed-b0e0-81dc56bfdc23',
                    label: 'Отсутствие доступа к кассовым аппаратам, банкоматам и т.д.'
                },
                {
                    key: '56590b0a-d6b2-4117-9b4a-22220b441b45',
                    label: 'Отсутствие службы сопровождения (только для вокзалов, аэропортов, поликлиник)'
                },
                {
                    key: 'a38aeb4f-1c3a-48db-b9e7-9afe24077e3f',
                    label: 'Отсутствие специальных мест в концертных и спортивных залах, на смотровых площадках '
                },
            ]
        },
        {
            key: 'wc',
            title: 'Туалет',
            options: [
                {key: 'c1bdc1fd-8be2-4d14-98c0-dd83959c86fb', label: 'Отсутствие специально оборудованного туалета'},
                {key: '5ec0ae09-2aa0-4caf-aa2b-dcdd60ee24bd', label: 'Отсутствие поручней на внутренней стороне двери'},
                {key: '4716729e-1d01-46f6-b59c-8bf4586a20ad', label: 'Наличие высокого порога у двери'},
                {key: 'a3f69839-36a2-40a6-bb46-54898910ab69', label: 'Узкие размеры туалетной кабины'},
                {
                    key: '4e570daa-d80e-49cf-bc4f-60239c7f440b',
                    label: 'Отсутствие свободного пространства около раковины'
                },
                {key: '7cb29da0-ea16-468e-94d4-c681dcde194d', label: 'Отсутствие поручней около унитаза'},
                {
                    key: '1750cc2c-9810-4ab7-92d0-59438bd30e87',
                    label: 'Отсутствие свободного пространства рядом с унитазом'
                },
                {key: 'fb55c2c6-2369-4b0f-8658-2f5d905f275e', label: 'Отсутствие крючков'},
                {key: '11c27055-fc69-4e6f-a873-7e29fc5fff8c', label: 'Отсутствие кнопки экстренного вызова персонала'},
            ]
        },
        {
            key: 'navigation',
            title: 'Навигация',
            options: [
                {key: '81bc70ac-5f34-40c1-8ae3-4f9ee740aab4', label: 'Отсутствие электронных табло'},
                {
                    key: '4cd729da-ac47-4ae5-8014-a4105bcdc07e',
                    label: 'Отсутствие указателей, в том числе тактильных и/или с использованием шрифта Брайля'
                },
                {
                    key: 'b117f3d1-e42f-4211-849b-66c9a50d6e2b',
                    label: 'Отсутствие режима работы, расписания, номеров кабинетов и т.д., в том числе тактильных и/или с использованием шрифта Брайля'
                },
                {key: '1adac3a8-ddae-4550-bbbd-78800c90b2b8', label: 'Отсутствие путей экстренной эвакуации'},
                {key: '743e4ca9-4105-49d4-b23b-36eb58e6ae07', label: 'Отсутствие номеров этажей '},
                {key: '8daf9379-b0e4-4585-a06d-a8b1464a9654', label: 'Отсутствие тактильных путей движения'},
                {key: '6621b726-df16-4339-89d5-9a02675e2d9c', label: 'Отсутствие международных символов доступности'},
                {
                    key: '9a64ac67-1180-48fb-9fb9-9f6b98ebaa86',
                    label: 'Отсутствие звукового сопровождения визуальной информации'
                },
                {key: 'e480a9ae-3b5d-4a61-ac08-40201f60e06f', label: 'Отсутствие мнемосхемы'},
            ]
        }
    ];

    export default {
        data() {
            return {
                focus: {
                    lastName: false,
                    firstName: false,
                    middleName: false,
                    iin: false,
                    address: false,
                    phone: false,
                    visitedAt: false,
                    objectName: false,
                    street: false,
                    building: false,
                    office: false,
                    visitPurpose: false
                },
                isLoading: false,
                authorities: [],
                cities: [],
                photosRaw: [{}],
                photosPreview: [],
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
                        videos: [''],
                        photos: [''],
                        options: {}
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
                try {
                    await api.get('users/me');
                } catch (e) {
                    return this.$router.push({name: 'login', query: {next: '/complaint'}})
                }
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
                    const uploads = await Promise.all(this.photosRaw.filter(photo => !!photo).map(photo => api.post('storage/upload', photo)));
                    this.complaint.content.photos = uploads.map(upload => upload.data.path);
                    await api.post('complaints', this.complaint);
                    this.$router.push('/')
                } catch (e) {
                    this.violations = get(e, 'response.data.errors.violations', []).reduce((violations, violation) => {
                        if (violations['complainant.lastName']) {
                            document.getElementById("11").focus();
                            this.focus.lastName = true
                        }
                        if (violations['complainant.firstName']) {
                            document.getElementById("12").focus();
                        }
                        if (violations['complainant.middleName']) {
                            document.getElementById("21").focus();
                        }
                        if (violations['complainant.iin']) {
                            document.getElementById("22").focus();
                        }
                        if (violations['complainant.address']) {
                            document.getElementById("31").focus();
                        }
                        if (violations['complainant.phone']) {
                            document.getElementById("32").focus();
                        }
                        if (violations['complainant.authorityId']) {
                            document.getElementById("41").focus();
                        }
                        if (violations['complainant.complaint.rememberPersonalData']) {
                            document.getElementById("f1").focus();
                        }
                        if (violations['content.type']) {
                            document.getElementById("s2").focus();
                        }
                        if (violations['content.visitedAt']) {
                            document.getElementById("x3").focus();
                        }
                        if (violations['content.objectName']) {
                            document.getElementById("i2").focus();
                        }
                        if (violations['content.street']) {
                            document.getElementById("i3").focus();
                        }
                        if (violations['content.building']) {
                            document.getElementById("i4").focus();
                        }
                        if (violations['content.office']) {
                            document.getElementById("i5").focus();
                        }
                        if (violations['content.visitPurpose']) {
                            document.getElementById("i6").focus();
                        }
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
            addPhotoInput() {
                this.photosRaw.push({})
            },
            imageFileChanged(event, index) {
                var input = event.target;
                var file = input.files[0];
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = (e) => {
                        this.photosPreview.push(e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
                this.photosRaw[index] = file
            }
        },
        computed: {
            types() {
                return types
            },
            hasViolations() {
                return Object.values(this.violations).length > 0
            },
            fields() {
                return fields;
            }
        }
    }
</script>

<style lang="scss" scoped>
.input {
    margin-bottom: 10px;
}
    .violations_error {
        color: red;
    }

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

    .button {
        padding: 14px 50px 16px;
        font-size: 16px;
        line-height: 20px;
        color: #ffffff;
        border: none;
        background: #3DBA3B;
        cursor: pointer;
        -webkit-transition: opacity 0.3s;
        -moz-transition: opacity 0.3s;
        -ms-transition: opacity 0.3s;
        -o-transition: opacity 0.3s;
        transition: opacity 0.3s;

        &:hover {
            opacity: 0.7;
        }
    }
</style>