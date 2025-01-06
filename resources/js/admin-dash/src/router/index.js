import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '../views/HomeView.vue';
import Login from '../components/Auth/login.vue'
import Register from '../components/Auth/register.vue';
import Products from '../views/products/products.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/home',
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
      path: '/edit/:id', // Use :id as a dynamic parameter
      name: 'editProduct',
      component: () => import('../views/products/editproducts.vue'), // Edit product view
      props: true,
    },
    {
      path: '/show/:id', // Use :id for dynamic product details view
      name: 'showProduct',
      component: () => import('../views/products/showproducts.vue'),
      props: true,
    },
    {
      path: '/florists',
      name: 'florists',
      component: () => import('../views/florists/florists.vue'), 
      meta: { requiresAuth: true },
    },
    {
      path: '/florists/create',
      name: 'create',
      component: () => import('../views/florists/create.vue'), // Create florist view
    },
    {
      path: '/florists/edit/${item.id}', // Use :id for dynamic edit florist view
      name: 'edit',
      component: () => import('@/views/florists/edit.vue'), // Edit florist view
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
