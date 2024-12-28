<script setup>
import { useRoute } from "vue-router";
import Navbar from "./components/navbar.vue";

const route = useRoute();
</script>

<template>
  <v-app>
    <!-- Show Navbar only for authenticated routes -->
    <Navbar v-if="!['/', '/register'].includes(route.path)" />

    <!-- Render routed content -->
    <RouterView />
  </v-app>
</template>

<script>
export default {
  name: "App",
};
</script>
