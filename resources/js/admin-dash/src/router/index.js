import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '../views/HomeView.vue';
import Login from '../views/Auth/login.vue';
import Register from '../views/Auth/register.vue';
import Products from '../views/products/products.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/login',
      name: 'login',
      component: Login, // Dynamic import for login view
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
    },
    {
      path: '/products',
      name: 'products',
      component:Products, // Products list view
    },
    {
      path: '/create',
      name: 'CreateProduct',
      component: () => import('../views/products/createproducts.vue'), // Create product view
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
      component: () => import('../views/florists/florists.vue'), // Florists view
    },
    {
      path: '/florists/create',
      name: 'create',
      component: () => import('../views/florists/create.vue'), // Create florist view
    },
    {
      path: '/florists/edit/:id', // Use :id for dynamic edit florist view
      name: 'edit',
      component: () => import('@/views/florists/edit.vue'), // Edit florist view
    },
  ],
});

export default router;
