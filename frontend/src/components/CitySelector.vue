<template>
    <div class="main-filter__geo" v-click-outside="close">
        <div class="main-filter__geo-city" @click="opened = !opened">
            <svg width="12" height="17" viewBox="0 0 12 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M6 16.25C6 16.25 12 9.71155 12 6.34524C12 2.97893 9.31371 0.25 6 0.25C2.68629 0.25 0 2.97893 0 6.34524C0 9.71155 6 16.25 6 16.25ZM6 8.63095C7.24264 8.63095 8.25 7.6076 8.25 6.34524C8.25 5.08287 7.24264 4.05952 6 4.05952C4.75736 4.05952 3.75 5.08287 3.75 6.34524C3.75 7.6076 4.75736 8.63095 6 8.63095Z"
                      fill="#3180F7"/>
            </svg>
            <span>{{ selectedCityTitle }}</span>
        </div>
        <div class="main-filter__geo-sub" v-if="opened">
            <div class="main-filter__geo-list">
                <span class="main-filter__geo-item" v-for="city in cities" :key="city.id" @click="select(city.id)">{{ city.name }}</span>
            </div>
        </div>
    </div>
</template>

<script>
    import ClickOutside from 'vue-click-outside'

    export default {
        name: "CitySelector",
        data() {
            return {
                opened: false
            }
        },
        props: [
            'cities',
            'value'
        ],
        directives: {
            ClickOutside
        },
        computed: {
            selectedCityTitle() {
                const city = this.cities.find(city => city.id === this.value)
                if (city) {
                    return city.name
                }
            }
        },
        methods: {
            select(id) {
              this.$emit('input', id);
              this.close()
            },
            close() {
                this.opened = false;
            }
        }
    }
</script>

<style scoped>

</style>