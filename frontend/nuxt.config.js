require('dotenv').config();

export default {
    srcDir: 'src/',
    loading: false,
    modules: [
        '@nuxtjs/axios',
        '@nuxtjs/proxy',
        'cookie-universal-nuxt'
    ],
    proxy: {
        '/pipeline': {
            target: process.env.BACKEND_DOMAIN || 'http://localhost',
        },
        '/api': {
            target: process.env.BACKEND_DOMAIN || 'http://localhost',
        }
    },
    axios: {
        proxy: true
    },
    plugins: [
        {src: '~plugins/no-ssr.js', ssr: false},
        {src: '~plugins/authenticated.js'}
    ],
    buildModules: [
        ['@nuxtjs/dotenv', {path: './'}]
    ],
    css: [
        '~/static/normalize.css',
        '@fortawesome/fontawesome-free/css/all.css'
    ],
    head: {
        meta: [
            {charset: 'utf-8'},
            {name: 'viewport', content: 'width=device-width, initial-scale=1'}
        ],
        script: [
            {type: "text/javascript", src: "https://code.jquery.com/jquery-1.11.0.min.js"}
        ]
    },
}
