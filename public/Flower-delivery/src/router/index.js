import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import Register from '../views/Auth/Register.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/products',
      name: 'Products',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/Products.vue')
    },
    {
      path:'/cart',
      name:'Cart',
      component:()=>import('../views/Cart.vue')
    },
    // {
    //   path:'/favorite',
    //   name:'Favorite',
    //   component:()=>import('../views/Favorite.vue')
    // },
   
    {
      path:'/florists',
      name:'Florist',
      component:()=>import('../views/Florist.vue')
    },
   
    {
      path:'/accompaniments',
      name:'Accompaniments',
      component:()=>import('../views/Accompaniment.vue')
    },
    {
      path:'/account',
      name:'Account',
      component:()=>import ('../views/Auth/Login.vue')
    },
    {
      path:'/login',
      name:'Login',
      component:()=>import ('../views/Auth/Login.vue')
    },
    {
      path:'/register',
      name:'Register',
      component:()=>import('../views/Auth/Register.vue')
    },
    
    {
      path:'/shipping',
      name:'Shipping',
      component:()=>import('../views/Shipping.vue')
    },
    {
      path:'/payment',
      name:'Payment',
      component:()=>import('../views/Payment/Payment.vue')
    },
    {
      path:'/mpesa',
      name:'Mpesa',
      component :()=>import ('../views/Payment/mpesa.vue')
    },
    {
      path:'/stripe',
      name:'Stripe',
      component :()=>import ('../views/Payment/stripe.vue')
    },
    {
      path:'/success',
      name:'Success',
      component :()=>import ('../views/Payment/Success.vue')
    },
    {
      path:'/orders',
      name:'Orders',
      component:()=>import ('../views/Orders.vue')
    }
  

  ],
  // const router= CreaterRouter({
  //   history:createWebHistory(),
  //   routes
  // })
})

export default router
