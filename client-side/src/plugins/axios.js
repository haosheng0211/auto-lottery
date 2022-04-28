import axios from 'axios'
import store from '@/store'
import router from '@/router'

axios.interceptors.request.use(
  (config) => {
    config.headers['Accept-Language'] = store.state.i18n.locale

    if (store.state.auth.token) {
      config.headers['Authorization'] = 'Bearer ' + store.state.auth.token
    }

    return config
  },
  (error) => {
    return Promise.reject(error)
  }
)

axios.interceptors.response.use(
  (response) => {
    return response
  },
  (error) => {
    if (error.response.status === 401) {
      router.push('/login')
    }

    return Promise.reject(error)
  }
)
