import $vuetify from 'vuetify/lib/locale/en'
import basicLayout from '@/layouts/basic-layout/locales/en'
import login from '@/views/login/locales/en'

export default {
  $vuetify,
  'menu.home': 'Home',
  'menu.agent': 'Agent',
  'menu.staff': 'Staff',
  'menu.member': 'Member',
  'menu.wager': 'Wager',
  'menu.strategy': 'Strategy',
  'menu.track': 'Track',
  ...basicLayout,
  ...login,
}
