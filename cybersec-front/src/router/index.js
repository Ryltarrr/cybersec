import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Models from '../views/Models.vue'
import Ingredients from '../views/Ingredients.vue'
import AddIngredient from '../views/AddIngredient'
import ModelDetail from '../views/ModelDetail'
import Processes from '../views/Processes'
import ProcessDetails from '../views/ProcessDetails'
import AddProcess from '../views/AddProcess'
import AddModel from '../views/AddModel'
import UpdateIngredient from '../views/UpdateIngredient'
import UpdateProcess from '../views/UpdateProcess'
import UpdateModel from '../views/UpdateModel'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/models',
    name: 'Models',
    component: Models
  },
  {
    path: '/ingredients',
    name: 'Ingredients',
    component: Ingredients
  },
  {
    path: '/about',
    name: 'About',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  },
  {
    path: '/addIngredient',
    name: 'AddIngredient',
    component: AddIngredient
  },
  {
    path: '/models/:id',
    name: "ModelDetail",
    component: ModelDetail,
    props: true
  },
  {
    path: '/processes',
    name: 'Processes',
    component: Processes
  },
  {
    path: '/process/:id',
    name: "ProcessDetails",
    component: ProcessDetails,
    props: true
  },
  {
    path: '/addProcess',
    name: "addProcess",
    component: AddProcess,
  },
  {
    path: '/addModel',
    name: "addModel",
    component: AddModel,
  },
  {
    path: '/updateIngredient/:id',
    name: "UpdateIngredient",
    component: UpdateIngredient,
    props: true
  },
  {
    path: '/updateProcess/:id',
    name: "UpdateProcess",
    component: UpdateProcess,
    props: true
  },
  {
    path: '/updateModel/:id',
    name: "UpdateModel",
    component: UpdateModel,
    props: true
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
