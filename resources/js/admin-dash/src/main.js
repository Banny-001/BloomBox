import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router' 
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import axios from 'axios'

// import FileInput from "./components/fileInput.vue";

const app = createApp(App)
const vuetify = createVuetify({
    components,
    directives
  })

app.use(router)
app.use(vuetify)
// app.component("FileInput", FileInput);
app.use (axios)
app.mount('#app')
