// var domain = "http://doskaz.vps3.zed.kz";
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
            "^/pipeline": {
                target: domain
            },
            '^/blog/rss': {
                target: domain
            }
        }
    }
};
