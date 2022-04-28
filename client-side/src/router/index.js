import Vue from 'vue'
import VueRouter from 'vue-router'
import routeConfig from '@/config/route.config'
import authenticate from '@/router/middlewares/authenticate'

Vue.use(VueRouter)

const routes = [
  {
    path: '/login',
    component: () => import('@/views/login'),
  },
  {
    path: '/',
    component: () => import('@/layouts/basic-layout'),
    beforeEnter: authenticate,
    children: routeConfig,
  },
  {
    path: '*',
    redirect: '/',
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes,
})

export default router
