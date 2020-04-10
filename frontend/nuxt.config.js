require('dotenv').config();

export default {
    srcDir: 'src/',
    loading: false,
    modules: [
        '@nuxtjs/axios',
        'cookie-universal-nuxt',
        '@nuxtjs/redirect-module'
    ],
    proxy: {
        '/pipeline': {
            target: process.env.BACKEND_DOMAIN || 'http://localhost',
        },
        '/img': {
            target: process.env.BACKEND_DOMAIN || 'http://localhost',
        },
        '/api': {
            target: process.env.BACKEND_DOMAIN || 'http://localhost',
        },
        '/static': {
            target: process.env.BACKEND_DOMAIN || 'http://localhost',
        }
    },
    axios: {
        proxy: true
    },
    redirect: [
        {from: '^/kurs', to: 'https://oft.kz/kurs'},
        {from: '^/kurs-obrashenie', to: 'https://oft.kz/kurs-obrashenie'}
    ],
    plugins: [
        {src: '~plugins/no-ssr.js', ssr: false},
        {src: '~plugins/authenticated.js'}
    ],
    buildModules: [
        ['@nuxtjs/dotenv', {path: './'}]
    ],
    css: [
        '~/static/normalize.css',
        '@fortawesome/fontawesome-free/css/all.css',
        '~/styles/layout.scss'
    ],
    head: {
        title: 'Доступный Казахстан',
        meta: [
            {charset: 'utf-8'},
            {name: 'viewport', content: 'width=device-width, initial-scale=1'},
            {hid: 'description', name: 'description', content: 'Актуальная информация о доступности объектов для людей с ограниченными возможностями, полезные статьи, законодательные акты, обсуждение, отзывы'},
            {hid: 'keywords', name: 'keywords', content: 'Доступность объектов, Инвалиды Павлодар, Инвалиды Астана, Инвалиды Нур-Султан, Инвалиды Алматы, Инвалиды Алмата, Инвалиды Кокшетау, Инвалиды Костанай, Инвалиды Талдыкорган, Инвалиды Кызылорда, Инвалиды Капчагай, Инвалиды Актау, Инвалиды Атырау, Инвалиды Актобе, Инвалиды Караганда, Инвалиды Семей, Инвалиды Тараз, Инвалиды Туркестан, Инвалиды Шымкент, Инвалиды Уральск, Инвалиды Усть-Каменагорск, Инвалиды Петрапаволск, Инвалиды Экибастуз, Инвалиды Казахстан, Объекты для инвалидов, Люди с ограниченными возможностями'}
        ],
        script: [
            {type: "text/javascript", src: "https://code.jquery.com/jquery-1.11.0.min.js"},
            {type: "text/javascript", src: "https://ulogin.ru/js/ulogin.js"}
        ],
        link: [
            {rel: 'icon', type: 'image/png', href: '/favicon.png'}
        ]
    }
}
