module.exports = {
    publicPath: '/adminpanel',
    devServer: {
        proxy: {
            "^/api": {
                target: "http://localhost:8000"
            }
        }
    }
};