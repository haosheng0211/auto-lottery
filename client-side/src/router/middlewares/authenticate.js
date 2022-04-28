import store from '@/store'
import router from '@/router'

export default function (to, from, next) {
  if (!store.state.auth.token) {
    return router.push('/login').then((r) => {
      console.log(r)
    })
  }

  next()
}
