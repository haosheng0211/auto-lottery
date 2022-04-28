import Vue from 'vue'
import Pusher from 'pusher-js'

Vue.prototype.$pusher = new Pusher(process.env.VUE_APP_PUSHER_APP_KEY, {
  cluster: process.env.VUE_APP_PUSHER_CLUSTER,
})
