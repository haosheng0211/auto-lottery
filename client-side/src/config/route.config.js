export default [
  {
    path: '/',
    component: () => import('@/views/home'),
  },
  {
    path: '/agent',
    component: () => import('@/views/agent'),
  },
  {
    path: '/staff',
    component: () => import('@/views/staff'),
  },
  {
    path: '/member',
    component: () => import('@/views/member'),
  },
  {
    path: '/wager',
    component: () => import('@/views/wager'),
  },
  {
    path: '/strategy',
    component: () => import('@/views/strategy'),
  },
  {
    path: '/track',
    component: () => import('@/views/track'),
  },
]
