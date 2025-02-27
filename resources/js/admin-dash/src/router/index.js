import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '../views/HomeView.vue';
import Login from '../components/Auth/login.vue'
import Register from '../components/Auth/register.vue';
import Products from '../views/products/products.vue';
import EditFlorist from '../views/florists/edit.vue'
import ShowFlorist from '../views/florists/show.vue'
import EditProduct from '../views/products/editproducts.vue'
import Showproduct from '../views/products/showproducts.vue';
import Accompaniment from '../views/accompaniments/accompaniment.vue';
import CreateAccompaniment from '../views/accompaniments/create.vue';
import CreateFlorist from "../views/florists/createflorist.vue";
import EditAccompaniment from "../views/accompaniments/edit.vue";
import ShowAccompaniment from "../views/accompaniments/show.vue";


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/dashboard',
      name: 'home',
      component: HomeView,
      meta: { requiresAuth: true },
    },
    {
      path: '/',
      name: 'login',
      component: () => import('../components/Auth/login.vue'),// Dynamic import for login view
     
    },
    {
      path: '/register',
      name: 'register',
      component: Register, // Dynamic import for register view
    },
    {
      path: '/users',
      name:'user',
      component: ()=>import ( "../views/AccessControl/users/user.vue"),
      meta: { requiresAuth: true },
    },
    {
      path: '/about',
      name: 'about',
      component: () => import('../views/AboutView.vue'), // About view
      meta: { requiresAuth: true },
    },
    {
      path: '/products',
      name: 'products',
      component:Products, // Products list view
      meta: { requiresAuth: true },
    },
    {
      path: '/create',
      name: 'CreateProduct',
      component: () => import('../views/products/create.vue'), 
      meta: { requiresAuth: true },
    },
    {
      path: '/editproducts/:id', 
      name: 'EditProduct',
      component: EditProduct, 
    },
    {
      path: '/showproduct/:id', 
      name: 'showProduct',
      component: Showproduct
    
    },
    {
      path: '/florists',
      name: 'florists',
      component: () => import('../views/florists/florists.vue'), 
      meta: { requiresAuth: true },
    },
    {
      path: '/florists/create',
      name: 'createflorist',
      component: CreateFlorist
    },
    {
      path: '/edit/:id', // Use :id for dynamic edit florist view
      name: 'edit',
      component: EditFlorist, // Edit florist view
    },
    {
      path: '/show/:id', 
      name: 'show',
      component: ShowFlorist, 
    },
    {
      path: '/accompaniments',
      name: 'accompaniments',
      component: Accompaniment, 
      meta: { requiresAuth: true },
    },
    {
      path:'/accompaniments/create',
      name:'create',
      component: CreateAccompaniment
    },
    {
      path: '/editaccompaniment/:id', 
      name: 'EditAccompaniment',
      component: EditAccompaniment, 
    },
    {
      path: '/showaccompaniment/:id', 
      name: 'ShowAccompaniment',
      component: ShowAccompaniment, 
    },
  
  ],
});
router.beforeEach((to, from, next) => {
  const isAuthenticated = !!localStorage.getItem("token"); // Replace with Vuex state if applicable

  if (to.meta.requiresAuth && !isAuthenticated) {
    next("/login");
  } else {
    next();
  }
});

export default router;
