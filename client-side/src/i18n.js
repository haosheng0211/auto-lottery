import Vue from 'vue'
import store from '@/store'
import VueI18n from 'vue-i18n'
import i18nConfig from '@/config/i18n.config'

Vue.use(VueI18n)

function loadMessages() {
  const messages = {}

  i18nConfig.forEach((item) => {
    messages[item.locale] = require(`@/locales/${item.locale}`).default
  })

  return messages
}

export default new VueI18n({
  locale: store.state.i18n.locale,
  fallbackLocale: store.state.i18n.fallbackLocale,
  messages: loadMessages(),
})
