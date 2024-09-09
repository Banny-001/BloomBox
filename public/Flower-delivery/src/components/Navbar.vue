<template>
  <v-app class="app" color="#4A148C" :elevation="3" >
    <v-navigation-drawer
      v-model="drawer"
      style="margin-top: 4rem"
      app
      temporary="false"
      class="drawer"
      color="#B39DDB
"
    >

      <v-list>
        <v-list-item 
          v-for="(item, index) in items"
          :key="index"
          @click=""
          class="drawer-item"
        >
          <router-link :to="item.route" class="drawer-link">
            <v-list-item-content>
              <v-list-item-title>
                {{ item.title }}
                <!-- <v-btn to="/products">Products</v-btn>
                  <v-btn to="/accompaniments">Accompaniments</v-btn> -->
              </v-list-item-title>
            </v-list-item-content>
          </router-link>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar app color="#673AB7" fixed>
      
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
      
      <v-img
      src="/public/images/Neutral Beige Simple Aesthetic Flower Boutique Logo.png"
      alt="logo"
      max-height="50"
      max-width="300"
       class="mx-auto my-2"
      
      ></v-img>
      <v-toolbar-title class="font-weight-bold white--text" >BloomBox</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-text-field
        color="white"
        max-width="300"
        border="none"
         class="mx-4"
        :loading="loading"
        append-inner-icon="mdi-magnify"
        density="compact"
        label="Search "
        variant="outlined"
        hide-details
        single-line
        @click:append-inner="onClick"
      ></v-text-field>
      <!--      
          </template> -->
      <v-btn class="cart white--text" to="/cart" icon>
        <v-icon>mdi-cart</v-icon>
        <v-badge :content="cartItemCount" color="primary" overlap v-if="cartItemCount>0">
          
        </v-badge>
      </v-btn>
      <v-btn class="favorite white--text " to="/orders" icon>
        <v-icon>mdi-folder</v-icon>
      </v-btn>

      <v-btn
        icon="mdi-account-outline"
        class="white--text" 
        @click.stop="drawer = !drawer"
        to="/register"
      >
      </v-btn>
    </v-app-bar>

    <v-main>
      <v-container>
        <router-view></router-view>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import "@fortawesome/fontawesome-free";
import Account from "../views/Auth/Login.vue";
 import Cart from "@/views/Cart.vue";
// const store =cart();

export default {
  data() {
    return {
      drawer: false,

      items: [
        { title: "Home", route: "/" },
        { title: "Products", route: "/products" },
        { title: "Florist", route: "/florists" },
        { title: "Accompaniments", route: "/accompaniments" },
        { title: "Account", route: "/account" },
      ],
    };
  },
  computed:{
    cartItems() {
      return this.$store.getters.cart;
    },
    cartItemCount() {
      return this.$store.getters.countCartItems;
    }

  }
};
</script>

<!-- color: inherit; -->
<style>
.app{
  display: flex;
  position: sticky;
}
.drawer-link {
  text-decoration: none;
  display: flex;
  width: 100%;
  font-size: 1rem;
  color: #ffff;
  font-weight: 500;
  color: #fff;
  padding: 0.75rem;
}
.drawer-item{
  border-radius: 8px;
  margin-bottom: 10px;
  transition: background-color 0.3s ease;
}
.drawer-item:hover {
  background-color:  #311B92;
}
.drawer-item .v-list-item-title {
  font-size: 1.2rem;
  font-weight: 700;

}

.v-app-bar {
  padding: 0 20px;
  background-color: #673AB7;
  color: #fff;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
}
.v-text-field input {
  color: #fff;
}

.cart .v-badge__badge {
  background-color: #FF4081;
}
</style>
