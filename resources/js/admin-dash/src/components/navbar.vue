<template>
    <v-navigation-drawer
        v-model="drawer"
        :rail="rail"
        permanent
        app
        @click="rail = false"
    >
        <v-list-item
            prepend-avatar="https://i.pinimg.com/736x/b4/3d/7b/b43d7bf24a4b88e339723c6fed137db9.jpg"
            title="BLOOMBOX"
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
                title="Dashboard"
                to="/dashboard"
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
            >
            </v-list-item>
            <v-list-item
                prepend-icon="mdi-gift"
                title="Accompaniments"
                to="/accompaniments"
            ></v-list-item>
            <v-list-item
                prepend-icon="mdi-pin"
                title="Locations"
                to="/locations"
            ></v-list-item>
            <v-list-item
                prepend-icon="mdi-star"
                title="Special Occassions"
                to="/special-occassions"
            ></v-list-item>
            <v-list-item
                prepend-icon="mdi-group"
                title="Category"
                to="/category"
            ></v-list-item>
            <v-list-item
                prepend-icon="mdi-account"
                title="My Account"
                to="/account"
            ></v-list-item>
            <v-list-group>
              <template v-slot:activator="{ props }">
                <v-list-item
                  v-bind="props"
                  prepend-icon="mdi-account-group-outline"
                  title="Access Control"
                ></v-list-item>
              </template>
            
              <v-list-item
                prepend-icon="mdi-shield-account"
                title="Roles"
                to="/roles"
              ></v-list-item>
            
              <v-list-item
                prepend-icon="mdi-lock"
                title="Permissions"
                to="/permissions"
              ></v-list-item>

              <v-list-item
              prepend-icon="mdi-account"
              title="Users"
              to="/users"
            ></v-list-item>
            </v-list-group>
            
        </v-list>
    </v-navigation-drawer>

    <v-app-bar class="app-bar" color="#6fb5e7">
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

/* Drawer Styling */
.v-navigation-drawer {
    background-color: #f5f5f5;
}

/* App Bar Styling */
.v-app-bar {
    z-index: 10;
    position: fixed;
    background-color: #6fb5e7;
}

/* List Item Hover Effect */
.v-list-item:hover {
    background-color: #c7e5fb;
}
</style>
