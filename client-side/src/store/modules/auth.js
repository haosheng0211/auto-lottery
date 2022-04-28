import axios from 'axios'

const initState = {
  user: {},
  token: null,
}

export default {
  namespaced: true,
  state: initState,
  mutations: {
    setUser(state, user) {
      state.user = user
    },
    setToken(state, token) {
      state.token = token
    },
    clearState(state) {
      state.user = initState.user
      state.token = initState.token
    },
  },
  actions: {
    login({ commit, dispatch }, params) {
      return axios.post('/api/auth/login', params).then((res) => {
        commit('setToken', res.data.token)
        dispatch('status')

        return res
      })
    },
    status({ commit }) {
      return axios.post('/api/auth/status').then((res) => {
        commit('setUser', res.data.user)

        return res
      })
    },
    logout({ commit }) {
      return axios.post('/api/auth/logout').finally(() => {
        commit('clearState')
      })
    },
  },
}
