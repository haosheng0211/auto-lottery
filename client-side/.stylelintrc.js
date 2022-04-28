module.exports = {
  overrides: [
    {
      files: ['*.html', '**/*.html'],
      customSyntax: 'postcss-html',
    },
  ],
  extends: [
    'stylelint-config-standard',
    'stylelint-config-recommended-vue',
    'stylelint-config-prettier',
  ],
  plugins: ['stylelint-order'],
  rules: {
    'order/properties-alphabetical-order': true,
  },
}
