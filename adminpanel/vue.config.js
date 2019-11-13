const webpack = require('webpack');

module.exports = {
    publicPath: '/adminpanel',
    devServer: {
        proxy: {
            "^/api": {
                target: "http://doskaz.local"
            },
            "^/storage": {
                target: "http://doskaz.local"
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