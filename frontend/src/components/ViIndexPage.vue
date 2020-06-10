<template>
    <div class="vi" :class="viSettingsClasses">
        <div class="vi-container">
            <ViHeader></ViHeader>
            <div class="vi__line">
                <div class="col">
                    <label class="vi__label --fcolor">{{ $t('index.selectDisabilitiesCategory') }}</label>
                    <div class="select">
                        <select class="--bcolor" :value="selectedDisabilitiesCategory.key"
                                @change="selectDisabilitiesCategory($event.target.value)">
                            <option v-for="category in disabilitiesCategorySettings" :key="category.key"
                                    :value="category.key">
                                {{ $t(`disabilityCategories.${category.key}`) }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col --city">
                    <label class="vi__label --fcolor">{{ $t('index.selectCity') }}</label>
                    <div class="select">
                        <select class="--bcolor" :value="selectedCity.id" @change="selectCity($event.target.value)">
                            <option v-for="city in cities" :key="city.id" :value="city.id">{{ city.name }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <h3 class="vi__title --fcolor">{{ $t('index.search') }}</h3>
            <div class="vi__line">
                <div class="col --padding">
                    <label class="vi__label --fcolor">{{ $t('index.searchLabel') }}</label>
                    <div class="input --bcolor">
                        <input type="text" v-model="searchQuery">
                    </div>
                </div>
                <div class="col --padding --search">
                    <button type="button" class="vi-search-button --bcolor">{{ $t('index.searchSubmitButton') }}
                    </button>
                </div>
            </div>
            <div class="vi__input-b">
                <label class="vi__label">{{ $t('index.selectAccessibility') }}</label>
                <div class="vi__input-wrapper">
                    <input id="r1" type="checkbox" class="vi__input"><label for="r1">Доступно</label>

                    <input id="r2" type="checkbox" class="vi__input"><label for="r2">Частично доступно</label>

                    <input id="r3" type="checkbox" class="vi__input"><label for="r3">Недоступно</label>
                </div>
            </div>
            <div class="vi__line">
                <div class="col">
                    <label class="vi__label --fcolor">{{ $t('index.selectCategory') }}</label>
                    <div class="select">
                        <select class="--bcolor" @change="selectedCategoryId = $event.target.value">
                            <option v-for="category in objectCategories" :key="category.id" :value="category.id">
                                {{ category.title }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <label class="vi__label --fcolor">{{ $t('index.selectSubCategory') }}</label>
                    <div class="select">
                        <select class="--bcolor">
                            <option v-for="subCategory in subCategories" :key="subCategory.id" :value="subCategory.id">
                                {{ subCategory.title }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <ul class="vi-search__list">
                <li class="vi-search__item">
                    <h3 class="vi-search__title">Lavash Fast Food</h3>
                    <div class="vi-search__around">
                        <div>
                            <span class="vi-search__text">Суши-бар</span>
                            <span class="vi-search__text">Динмухамеда Кунаева, 14Б</span>
                        </div>
                        <span class="vi-search__text">Частично доступно</span>
                    </div>
                </li>
                <li class="vi-search__item">
                    <h3 class="vi-search__title">Алые паруса</h3>
                    <div class="vi-search__around">
                        <div>
                            <span class="vi-search__text">Суши-бар</span>
                            <span class="vi-search__text">Хан Шатыр, Тұран проспект, 37</span>
                        </div>
                        <span class="vi-search__text">Доступно</span>
                    </div>
                </li>
                <li class="vi-search__item">
                    <h3 class="vi-search__title">Saya Sushi</h3>
                    <div class="vi-search__around">
                        <div>
                            <span class="vi-search__text">Суши-бар</span>
                            <span class="vi-search__text">​Бауыржан Момышұлы проспект, 23</span>
                        </div>
                        <span class="vi-search__text">Частично доступно</span>
                    </div>
                </li>
                <li class="vi-search__item">
                    <h3 class="vi-search__title">Алые паруса</h3>
                    <div class="vi-search__around">
                        <div>
                            <span class="vi-search__text">Суши-бар</span>
                            <span class="vi-search__text">Хан Шатыр, Тұран проспект, 37</span>
                        </div>
                        <span class="vi-search__text">Доступно</span>
                    </div>
                </li>
                <li class="vi-search__item">
                    <h3 class="vi-search__title">Saya Sushi</h3>
                    <div class="vi-search__around">
                        <div>
                            <span class="vi-search__text">Суши-бар</span>
                            <span class="vi-search__text">​Бауыржан Момышұлы проспект, 23</span>
                        </div>
                        <span class="vi-search__text">Частично доступно</span>
                    </div>
                </li>
            </ul>
            <div class="vi__complaint">
                <button @click="$router.push(localePath({name: 'objects-add'}))" type="button" class="vi__button">
                    {{ $t('index.addObjectLink') }}
                </button>
                <button @click="$router.push(localePath({name: 'complaint'}))" type="button" class="vi__button">
                    {{ $t('index.makeComplaintLink') }}
                </button>
            </div>
            <ViFooter></ViFooter>
        </div>
    </div>
</template>

<script>
import {get, call} from "vuex-pathify";
import ViHeader from "~/components/ViHeader";
import ViFooter from "~/components/ViFooter";

export default {
    name: 'ViIndexPage',
    components: {
        ViHeader,
        ViFooter
    },
    data() {
        return {
            selectedCategoryId: null,
            searchQuery: ''
        }
    },
    fetch() {
      if(!this.selectedDisabilitiesCategory) {
          this.selectDisabilitiesCategory('justView')
      }
    },
    methods: {
        selectCity: call('settings/select'),
        selectDisabilitiesCategory: call('disabilitiesCategorySettings/selectCategory'),
    },
    computed: {
        disabilitiesCategorySettings: get('disabilitiesCategorySettings/categories'),
        selectedDisabilitiesCategory: get('disabilitiesCategorySettings/currentCategory'),
        cities: get('cities/list'),
        objectCategories: get('objectCategories/categories'),
        selectedCity: get('cities/selectedCity'),
        visualImpairedModeSettings: get('visualImpairedModeSettings'),
        viSettingsClasses() {
            return {
                '--noto': this.visualImpairedModeSettings.fontFamily === 'Noto',
                '--black': this.visualImpairedModeSettings.colorTheme === 'black',
                '--sm': this.visualImpairedModeSettings.fontSize === 'sm',
                '--md': this.visualImpairedModeSettings.fontSize === 'md',
                '--lrg': this.visualImpairedModeSettings.fontSize === 'lrg'
            }
        },
        subCategories() {
            const category = this.objectCategories.find(category => category.id == this.selectedCategoryId)
            if (!category) {
                return []
            }
            return category.subCategories
        }
    }
}
</script>

<style lang="scss">

.vi {
    font-family: 'Lato', sans-serif;
    background: #ffffff;
}

</style>