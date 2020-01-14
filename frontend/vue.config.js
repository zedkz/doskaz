var domain = process.env['BACKEND_DOMAIN'];

module.exports = {
    devServer: {
        proxy: {
            "^/(api|storage|static|image|pipeline|blog/rss)": {
                target: domain
            }
        }
    }
};
