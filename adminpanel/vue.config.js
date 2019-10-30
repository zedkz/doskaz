const webpack = require('webpack');

module.exports = {
    publicPath: '/adminpanel',
    devServer: {
        proxy: {
            "^/api": {
                target: "http://localhost:8000"
            }
        }
    },
    configureWebpack: {
        plugins: [
            new webpack.ProvidePlugin({
                $: 'jquery',
                jQuery: 'jquery',
                'window.jQuery': 'jquery',
            })
        ]
    }
};