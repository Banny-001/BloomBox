import './assets/style.css'


import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import { createVuetify } from 'vuetify'
import "vuetify/styles";
import VueToastificationPlugin from 'vue-toastification'
// import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import { mdiBootstrap } from '@mdi/js'
import store from '@/store'
// import { Toast } from '@/bootstrap'
//ability
// import { abilitiesPlugin } from '@casl/vue';
// import ability from './services/ability';
// import { Can } from '@casl/vue';

import axios from 'axios';
window.axios = axios;

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.baseURL = 'http://127.0.0.1:8000/api';

const token = localStorage.getItem('token');
if ('token') {
  axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
}
axios.interceptors.response.use(
  (response) => response,
  (error) => {
      if (error.response && error.response.status === 401) {
          // Remove the token from local storage:
          localStorage.removeItem('token');
          // // Reset the axios Authorization header:
          // axios.defaults.headers.common['Authorization'] = 'Bearer';
          // Redirect the user to the login page:
          router.push({ name: 'login' });
      }
      return Promise.reject(error);
  }
);
const vuetify = createVuetify({
  components,
  directives,

})
const app = createApp(App)
// Register component globally
// library.add(fas)
app.use(mdiBootstrap)
app.use(router)
app.use(store)
app.use(vuetify)
  // app.use(Toast)
// app.use(abilitiesPlugin)
// app.component('Can',Can);
app.mount('#app')
