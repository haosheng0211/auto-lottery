import Vue from 'vue'
import Vuex from 'vuex'
import cookieStorage from '@/utils/storage/cookie-storage'
import VuexPersistedstate from 'vuex-persistedstate'
import i18n from '@/store/modules/i18n'
import auth from '@/store/modules/auth'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    audioVolume: 1,
  },
  mutations: {
    setAudioVolume(state, audioVolume) {
      state.audioVolume = audioVolume
    },
  },
  modules: { i18n, auth },
  plugins: [
    VuexPersistedstate({
      paths: ['auth'],
      storage: cookieStorage,
    }),
    VuexPersistedstate({
      paths: ['i18n', 'audioVolume'],
      storage: localStorage,
    }),
  ],
})
