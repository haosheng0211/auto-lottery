const { defineConfig } = require('@vue/cli-service')
const EslintPlugin = require('eslint-webpack-plugin')
const StylelintPlugin = require('stylelint-webpack-plugin')

module.exports = defineConfig({
  transpileDependencies: ['vuetify'],
  devServer: {
    proxy: {
      '/api': {
        target: 'http://127.0.0.1:5200',
      },
    },
  },
  css: {
    loaderOptions: {
      css: {
        modules: {
          auto: true,
          localIdentName: '[local]_[hash:base64:5]',
          exportLocalsConvention: 'camelCaseOnly',
        },
      },
    },
  },
  configureWebpack: {
    plugins: [
      new EslintPlugin({
        fix: true,
        extensions: ['.js', '.vue'],
      }),
      new StylelintPlugin({
        fix: true,
        extensions: ['.css', '.scss'],
      }),
    ],
  },
  pluginOptions: {
    i18n: {
      locale: 'en',
      fallbackLocale: 'en',
      localeDir: 'locales',
    },
  },
})
