<template>
  <v-main>
    <!-- App Bar -->
  

    <!-- Drawer and Main Content -->

    <!-- Navigation Drawer -->
    <v-navigation-drawer
      v-model="drawer"
      :rail="rail"
      permanent
      app
      @click="rail = false"
    >
      <v-list-item
        prepend-avatar="https://randomuser.me/api/portraits/men/85.jpg"
        title="John Leider"
        nav
      >
        <template v-slot:append>
          <v-btn
            icon="mdi-chevron-left"
            variant="text"
            @click.stop="rail = !rail"
          ></v-btn>
        </template>
      </v-list-item>

      <v-divider></v-divider>

      <v-list density="compact" nav>
        <v-list-item
          prepend-icon="mdi-home-city"
          title="Home"
          to="/"
        ></v-list-item>
        <v-list-item
          prepend-icon="mdi-package-variant"
          title="Products"
          to="/products"
        ></v-list-item>
        <v-list-item
        prepend-icon="mdi-leaf"

          title="Florists"
          to="/florists"
        ></v-list-item>
        <v-list-item
          prepend-icon="mdi-account"
          title="My Account"
          to="/account"
        ></v-list-item>
        <v-list-item
          prepend-icon="mdi-account-group-outline"
          title="Users"
          to="/users"
        ></v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-app-bar app color="#6200ea" dark>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
      <v-toolbar-title>BloomBox</v-toolbar-title>
      <v-spacer></v-spacer>

      <v-btn icon>
        <v-icon>mdi-bell</v-icon>
      </v-btn>
      <v-btn icon>
        <v-icon>mdi-account</v-icon>
      </v-btn>
    </v-app-bar>

    <!-- Main Content -->
    
      <router-view />
   
  </v-main>
</template>

<script setup>
import { ref } from "vue";

const drawer = ref(true); // Drawer state
const rail = ref(false); // Compact drawer toggle
</script>

<style scoped>
/* Ensure Full-Screen Layout */
html,
body,
#app {
  margin: 0;
  padding: 0;
  height: 100%;
  width: 100%;
}

.v-application {
  height: 100%;
  width: 100%;
  display: flex;
  flex-direction: column;
}

/* Ensure Main Content Fills Remaining Space */
.v-main {
  flex: 1;
  display: flex;
  flex-direction: column;
}

/* Content Styling */
.content {
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

/* Drawer Styling */
.v-navigation-drawer {
  background-color: #f5f5f5 !important;
}

/* App Bar Styling */
.v-app-bar {
  z-index: 10;
  position: fixed;
}

/* List Item Hover Effect */
.v-list-item:hover {
  background-color: #e3f2fd;
}
</style>
