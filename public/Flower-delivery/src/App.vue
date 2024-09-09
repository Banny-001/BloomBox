<script setup lang="ts">
import "@fortawesome/fontawesome-free"
import { RouterLink, RouterView } from 'vue-router'
import Navbar from "./components/Navbar.vue"
</script>

<template>
 <v-app class="app">
   <Navbar/>
  
      <!-- <RouterView />  -->
       <router-link></router-link>

 </v-app>
</template>

<style scoped>


  
</style>
