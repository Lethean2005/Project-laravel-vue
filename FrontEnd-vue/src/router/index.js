// Composables
import { createRouter, createWebHistory } from 'vue-router'
import Orders from '@/views/Orders.vue';

const routes = [
  {
    path: '/',
    component: () => import('@/layouts/default/Default.vue'),
    children: [
      {
        path: '',
        name: 'Home',
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import(/* webpackChunkName: "home" */ '@/views/Home.vue'),
      },
      {
        path : '/order',
        name : 'Orders',
        component: ()=> import('@/views/Orders.vue')
      },
      {
        path : '/finance',
        name : 'Finance',
        component : ()=> import ('@/views/Finance.vue')
      },
      {
        path : '/restaurants',
        name : 'restaurants',
        component : ()=> import ('@/views/Restaurants.vue')
      }
      
    ],
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
})

export default router
