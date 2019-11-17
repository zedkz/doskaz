var domain = process.env['BACKEND_DOMAIN'];

module.exports = {
    devServer: {
        proxy: {
            "^/api": {
                target: domain
            },
            "^/storage": {
                target: domain
            },
            "^/image": {
                target: domain
            },
            '^/blog/rss': {
                target: domain
            }
        }
    }
};
