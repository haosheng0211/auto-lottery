import $vuetify from 'vuetify/lib/locale/zh-Hant'
import basicLayout from '@/layouts/basic-layout/locales/zh_TW'
import login from '@/views/login/locales/zh_TW'

export default {
  $vuetify,
  'menu.home': '首頁',
  'menu.agent': '代理帳號',
  'menu.staff': '跟注帳號',
  'menu.member': '會員帳號',
  'menu.wager': '會員注單',
  'menu.strategy': '跟注策略',
  'menu.track': '跟注紀錄',
  ...basicLayout,
  ...login,
}
