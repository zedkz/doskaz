require('dotenv').config();
import axios from 'axios'


export default {
    srcDir: 'src/',
    loading: false,
    modules: [
        '@nuxtjs/axios',
        'cookie-universal-nuxt',
        '@nuxtjs/redirect-module',
        '@nuxtjs/robots',
        'nuxt-i18n',
        '@nuxtjs/sitemap',
        '@nuxtjs/feed'
    ],
    router: {
        middleware: 'languageUnderConstruction'
    },
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
        },
        '/storage': {
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
        {src: '~plugins/i18n.js'},
        {src: '~plugins/axios.js'},
        {src: '~plugins/csrf.js', mode: 'server'},
        {src: '~plugins/no-ssr.js', mode: 'client'},
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
            {
                hid: 'description',
                name: 'description',
                content: 'Актуальная информация о доступности объектов для людей с ограниченными возможностями, полезные статьи, законодательные акты, обсуждение, отзывы'
            },
            {
                hid: 'keywords',
                name: 'keywords',
                content: 'Доступность объектов, Инвалиды Павлодар, Инвалиды Астана, Инвалиды Нур-Султан, Инвалиды Алматы, Инвалиды Алмата, Инвалиды Кокшетау, Инвалиды Костанай, Инвалиды Талдыкорган, Инвалиды Кызылорда, Инвалиды Капчагай, Инвалиды Актау, Инвалиды Атырау, Инвалиды Актобе, Инвалиды Караганда, Инвалиды Семей, Инвалиды Тараз, Инвалиды Туркестан, Инвалиды Шымкент, Инвалиды Уральск, Инвалиды Усть-Каменагорск, Инвалиды Петрапаволск, Инвалиды Экибастуз, Инвалиды Казахстан, Объекты для инвалидов, Люди с ограниченными возможностями'
            }
        ],
        script: [
            {type: "text/javascript", src: "https://code.jquery.com/jquery-1.11.0.min.js"}
        ],
        link: [
            {rel: 'icon', type: 'image/png', href: '/favicon.png?v1'}
        ]
    },
    robots: process.env.ROBOTS_ALLOW ? [
        {UserAgent: '*'},
        {Disallow: '*?query='},
        {Disallow: '/search'},
        {Allow: '*.css'},
        {Allow: '*.js'},
        {Allow: '*.jpeg'},
        {Allow: '*.png'},
        {Allow: '*.pdf'},
        {Sitemap: 'https://doskaz.kz/sitemap.xml'},
    ] : {
        UserAgent: '*',
        Disallow: '/'
    },
    i18n: {
        strategy: 'prefix_except_default',
        defaultLocale: 'ru',
        parsePages: false,
        pages: {
            'oauth/callback': false
        },
        lazy: true,
        langDir: 'lang/',
        locales: [
            {code: 'kz', name: 'Qazaq', file: 'ru.js'},
            {code: 'ru', name: 'Русский', file: 'ru.js'},
        ]
    },
    sitemap: {
        gzip: true,
        exclude: [
            '/oauth/**',
            '/profile',
            '/complaint',
            '/profile/**',
            '/objects/pdf',
            '/kz/**'
        ],
        routes: () => {
            return [
                
            ]
        }
    },
    feed: [
        {
            path: '/blog/feed.xml',
            type: 'rss2',
            async create(feed) {
                feed.options = {
                    title: 'Доступный Казахстан - Блог',
                    link: 'https://doskaz.kz/feed.xml',
                    description: ''
                }
                const {data: {items: posts}} = await axios.get(`${process.env.BACKEND_DOMAIN}/api/blog/posts`);
                posts.forEach(post => {
                    const url = `https://doskaz.kz/blog/${post.categorySlug}/${post.slug}`
                    feed.addItem({
                        title: post.title,
                        id: url,
                        link: url,
                        description: post.annotation,
                        content: post.content,
                        date: new Date(post.publishedAt),
                        image: post.image
                    })
                })
            }
        }
    ]
}
