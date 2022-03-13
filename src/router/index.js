import Vue from 'vue'
import VueRouter from 'vue-router'
import menupage from '../components/menupage.vue'
import Addmenu from '../components/Addmenu.vue'
import finance from '../components/finance.vue'
import dashboard from '../components/dashboard.vue'
import Queue from '../components/Queue.vue'
import RawMaterial from '../components/RawMaterial.vue'
import Noodle from '../components/Noodle.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'menupage',
    component: menupage
  },
  {
    path: '/Addmenu',
    name: 'Addmenu',
    component: Addmenu
  },
  {
    path: '/finance',
    name: 'finance',
    component: finance
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: dashboard
  },
  {
    path: '/Queue',
    name: 'Queue',
    component: Queue
  },
  {
    path: '/RawMaterial',
    name: 'RawMaterial',
    component: RawMaterial
  },
  {
    path: '/Noodle',
    name: 'Noodle',
    component: Noodle
  },

  
  
  
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
