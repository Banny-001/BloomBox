<template>
  <v-container fluid>
    <v-row class="d-flex justify-center">

    <v-col cols="12" md="4" v-for="product in stock" :key="product">
      <v-card class="mx-auto padding:none"  max-width="400">
        <v-img
          class="align-end text-white"
          id="hoverable"
          height="400"
          :src="product.image"
          cover
        >
        </v-img>
        <v-card-subtitle>
          <span class="me-1">{{ product.productPopular }}</span>

          <v-icon color="error" icon="mdi-fire-circle" size="small"></v-icon>
        </v-card-subtitle>

        <v-card-text>
          <div class="font-weight-bold text-lg">{{ product.name }}</div>
          <div class="my-2 text-subtitle-1">
           ${{ product.price }}
          </div>
          <div class="description">{{ product.description }}<br /></div>
        </v-card-text>

        <v-card-text>
          <v-row align="center" class="mx-0">
            <v-rating
              :model-value="4"
              color="amber"
              density="compact"
              size="small"
              half-increments
              readonly
            ></v-rating>

            <div class="text-grey ms-4">
              {{ product.productRating }}
            </div>
          </v-row>
        </v-card-text>
        <v-card-text>
          <div class="seller " >
            <a href="/florists" class="text-decoration-none" >
              <v-icon left>mdi-account</v-icon>
              {{ product.florist_id }}
            </a>
          </div>
        </v-card-text>

        <v-card-actions>
          <v-btn
           class="elevation-2 rounded-btn white--text"
           color="purple darken-2"
            block
            text="Direct Import"
            @click="addToCart(product)"
            >Add to cart</v-btn >

          
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
 
  </v-container>
</template>
<script>
import { mapActions, mapGetters } from "vuex";


export default {
  data() {
    return {
      products: [1, 2],
      subtotal: 0,

      cartItems: [],
      favoriteItems: [],
    };
  },
  methods: {
    ...mapActions([
      "addToCart",
     "addToFavorites", 
     "fetchProduct"
    ]),
  },
  computed: {
    ...mapGetters({
      // product: "product",
      stock:'stock'
    })
  },
   created() {
      this.fetchProduct();
    },
  
};
</script>
<style scoped>
#hoverable:hover{
  transform: translateY(-8px);
  box-shadow: 0px 20px 30px rgba(0, 0, 0, 0.1);
}
</style>
