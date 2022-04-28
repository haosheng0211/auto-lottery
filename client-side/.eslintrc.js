module.exports = {
  root: true,
  env: {
    node: true,
  },
  extends: [
    'plugin:vue/recommended',
    'eslint:recommended',
    'plugin:prettier/recommended',
  ],
  parserOptions: {
    parser: '@babel/eslint-parser',
  },
  rules: {
    'vue/valid-v-slot': 'off',
    'vue/multi-word-component-names': 'off',
    'padding-line-between-statements': [
      'error',
      { blankLine: 'always', prev: '*', next: ['return', 'if'] },
      { blankLine: 'always', prev: 'import', next: '*' },
      { blankLine: 'never', prev: 'import', next: 'import' },
      { blankLine: 'always', prev: 'export', next: '*' },
      { blankLine: 'never', prev: 'export', next: 'export' },
      { blankLine: 'always', prev: ['const', 'let', 'var'], next: '*' },
      {
        blankLine: 'any',
        prev: ['const', 'let', 'var'],
        next: ['const', 'let', 'var'],
      },
    ],
  },
}
