<template>
    <object-view :object="object"/>
</template>

<script>
    import {sync, get} from "vuex-pathify";
    import groupBy from 'lodash/groupBy'
    import map from 'lodash/map'
    import chunk from 'lodash/chunk'
    import Username from "~/components/Username";
    import PostSubmitMessage from "~/components/complaint/PostSubmitMessage";
    import LangSelect from "~/components/LangSelect";
    import {eventBus} from '~/store/bus.js'
    import FormattedDate from "@/components/FormattedDate";
    import ObjectView from "@/components/objects/ObjectView";

    const accessibilityValues = {
        full_accessible: {
            class: '--available',
            label: 'Доступно',
            backgroundColor: 'rgba(61,186,59,0.15)'
        },
        partial_accessible: {
            class: '--partially',
            label: 'Частично доступно',
            backgroundColor: 'rgba(248,172,26,0.15)'
        },
        not_accessible: {
            class: '--not-available',
            label: 'Недоступно',
            backgroundColor: 'rgba(222,18,32,0.1)'
        },
        not_provided: {
            class: '--not-provided',
            label: 'Не предусмотрено',
            backgroundColor: 'rgba(123,149,167,0.15)'
        }
    };

    const zones = [
        {key: 'parking', label: 'Парковка'},
        {key: 'entrance', label: 'Входная группа'},
        {key: 'movement', label: 'Пути движения по объекту'},
        {key: 'service', label: 'Зона оказания услуги'},
        {key: 'toilet', label: 'Туалет'},
        {key: 'navigation', label: 'Навигация'},
        {key: 'serviceAccessibility', label: 'Доступность услуги'},
    ]

    export default {
        components: {ObjectView, FormattedDate, PostSubmitMessage, Username, LangSelect},
        layout({store}) {
            return store.get('visualImpairedModeSettings/enabled') ? 'default' : 'main'
        },
        props: [
            'mobileOpened'
        ],
        head() {
            return {
                title: this.object.title
            }
        },
        data() {
            return {
                isPartially: false,
                isNotAvailable: false,
                isAvailable: true,
                activeItem: 'tab-description',
                visibleDetail: 'detail_1',
                moreDetailsShow: false,
                videosIndex: null,
                videosOptions: {
                    container: '#blueimp-video',
                    continuous: false,
                    youTubeVideoIdProperty: 'youtube',
                    youTubePlayerVars: undefined,
                    youTubeClickToPlay: true
                },
                imagesIndex: null,
                imagesOptions: {
                    continuous: false,
                    onslide: function (index, slide) {
                        var indicator = document.getElementsByClassName('indicator');
                        indicator[0].innerHTML = (index + 1) + ' / ' + document.getElementsByClassName('slide').length;
                    }
                }
            }
        },
        async asyncData({$axios, store, params, query, error}) {
            try {
                const object = await $axios.$get(`/api/objects/${params.id}`, {
                    params: {
                        disabilitiesCategory: store.getters['disabilitiesCategorySettings/currentCategoryValue']
                    }
                })
                await store.dispatch('objectAdding/init')
                store.commit('map/SET_COORDINATES_AND_ZOOM', {
                    coordinates: object.coordinates,
                    zoom: process.server ? 19 : query.zoom
                })
                return {object}
            } catch (e) {
                if (e.response && e.response.status) {
                    return error({statusCode: e.response.status})
                }
                return error({})
            }

        },
        mounted() {
            this.visibleDetail = this.detailsZones[0].key
        },
        computed: {
            ...sync('map', [
                'coordinates',
                'zoom',
                'coordinatesAndZoom'
            ]),
            overallAccessibility() {
                return accessibilityValues[this.object.overallScore]
            },
            zones() {
                return zones.map(zone => ({
                    ...zone,
                    class: accessibilityValues[this.object.scoreByZones[zone.key]].class
                }));
            },
            reviewsLink() {
                return {
                    name: 'objects-id-review',
                    params: {
                        id: this.$route.params.id
                    }
                }
            },
            photosByYear() {
                return map(groupBy(this.object.photos, photo => (new Date(photo.date).getFullYear())), (v, k) => ({
                    year: Number(k),
                    photos: v
                })).sort((a, b) => b.year - a.year)
            },
            tabs() {
                return [
                    {title: this.$t('objects.tabTitles.description'), link: {...this.$route, query: {tab: undefined}}},
                    {
                        title: this.$t('objects.tabTitles.photos'),
                        link: {...this.$route, query: {tab: 'photos'}},
                        counter: this.object.photos.length
                    },
                    {
                        title: this.$t('objects.tabTitles.videos'),
                        link: {...this.$route, query: {tab: 'videos'}},
                        counter: this.object.videos.length
                    },
                    {
                        title: this.$t('objects.tabTitles.reviews'),
                        link: {...this.$route, query: {tab: 'reviews'}},
                        counter: this.object.reviews.length
                    },
                    {title: this.$t('objects.tabTitles.history'), link: {...this.$route, query: {tab: 'history'}}},
                ]
            },
            attributesList: get('objectAdding/attributesList[:form]'),
            form() {
                return this.object.attributes.form
            },
            detailsZones() {
                const zones = [
                    {key: 'parking', title: 'Парковка', group: 'parking'},
                    {key: 'entrance1', title: 'Входная группа 1', group: 'entrance'},
                    {key: 'entrance2', title: 'Входная группа 2', group: 'entrance'},
                    {key: 'entrance3', title: 'Входная группа 3', group: 'entrance'},
                    {key: 'movement', title: 'Пути движения по объекту', group: 'movement'},
                    {key: 'service', title: 'Зона оказания услуги', group: 'service'},
                    {key: 'toilet', title: 'Туалет', group: 'toilet'},
                    {key: 'navigation', title: 'Навигация', group: 'navigation'},
                    {key: 'serviceAccessibility', title: 'Доступность услуги', group: 'serviceAccessibility'},
                ]

                return zones.filter(z => this.object.attributes.zones[z.key])
            },
            zonesMenu() {
                return chunk(this.detailsZones, Math.round(this.detailsZones.length / 2))
            },
            images() {
                return this.object.photos.map(photo => photo.viewUrl)
            },
            videos() {
                return this.object.videos.map(video => ({
                    youtube: video.videoId,
                    poster: video.thumbnail,
                    type: 'text/html',
                    href: video.url
                }));
            },
            userCategory: get('disabilitiesCategorySettings/currentCategory'),
        },
        watch: {
            '$route.query.t'() {
                this.coordinatesAndZoom = {
                    coordinates: this.object.coordinates,
                    zoom: this.$route.query.zoom
                }
            },
            userCategory() {
                this.reloadObject()
            }
        },
        destroyed() {
            this.coordinatesAndZoom = null;
        },
        methods: {
            mainPageMobOpened() {
                eventBus.$emit('mainPageMobOpened');
            },
            isActive(tabItem) {
                return this.activeItem === tabItem
            },
            isVisibleDetail(detail) {
                return this.visibleDetail === detail
            },
            setVisible(detail) {
                this.visibleDetail = detail;
                document.getElementById('' + detail + '').scrollIntoView();
            },
            setActive(tabItem) {
                this.activeItem = tabItem
            },
            async reloadObject() {
                const {data: object} = await this.$axios.get(`/api/objects/${this.$route.params.id}`, {
                    params: {
                        disabilitiesCategory: this.$store.getters['disabilitiesCategorySettings/currentCategoryValue']
                    }
                })
                this.object = object;
            },
            viewPhoto(photo) {
                this.videosIndex = null;
                this.imagesIndex = this.object.photos.indexOf(photo)
            },
        }
    };
</script>