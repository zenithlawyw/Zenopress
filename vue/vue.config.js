path = require('path');

module.exports = {

  filenameHashing: true,
  indexPath: process.env.VUE_ADMIN === 'true' ? "admin/index.html" : "public/index.html",
  lintOnSave: false,
  productionSourceMap: false,
  runtimeCompiler: true,

  publicPath: '/wp-content/plugins/zenopress/vue/dist',

  configureWebpack: {

    resolve: {
      alias: {
        '@': path.join( __dirname, 'src' )
      },
      symlinks: false,
    },
    output: {
      filename: process.env.VUE_ADMIN === 'true' ? "admin/js/zenopress-admin.js" : "public/js/zenopress-public.js",
    },
    optimization: {
      splitChunks: false
    }
  },
  css: {
    extract: {
      filename: process.env.VUE_ADMIN === 'true' ? "admin/css/zenopress-admin.css" : "public/css/zenopress-public.css"
    }
  },
  pluginOptions: {
    i18n: {
      locale: 'en',
      fallbackLocale: 'en',
      localeDir: 'locales',
      enableInSFC: true
    }
  }
};
