module.exports = {
  devServer: {
    proxy: {
      "^/api": {
        target: "http://doskaz.vps3.zed.kz"
      }
    }
  }
};
