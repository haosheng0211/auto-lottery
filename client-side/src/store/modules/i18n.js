const initState = {
  locale: process.env.VUE_APP_I18N_LOCALE || 'en',
  fallbackLocale: process.env.VUE_APP_I18N_FALLBACK_LOCALE || 'en',
}

export default {
  namespaced: true,
  state: initState,
  mutations: {
    setLocale(state, locale) {
      state.locale = locale
    },
  },
}
