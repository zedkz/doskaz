require('dotenv').config();

export default {
    srcDir: 'src/',
    loading: false,
    modules: [
        '@nuxtjs/axios',
        '@nuxtjs/proxy'
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
        '@fortawesome/fontawesome-free/css/all.css'
    ]
}
