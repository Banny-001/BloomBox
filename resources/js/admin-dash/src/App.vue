<script setup>
import { RouterLink, RouterView } from 'vue-router'
import Navbar from "./components/navbar.vue"
</script>

<template>
 <v-app>
    <Navbar/>
   
  </v-app>
</template>

<script>
export default {
  name: "App",
};
</script>

