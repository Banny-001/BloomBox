<template>
  <v-container>
    <!-- <v-row class="mx-auto" width="auto"  > -->

    <v-card-text class="bg-surface-light pt-4">
      <h1>My Cart</h1>
    </v-card-text>

    <v-col>
      <v-row v-for="product in cartItems" :key="product.id" class="mb-4">
        <v-col cols="2">
          <v-img :src="product.image" alt="Product Image"></v-img>
        </v-col>
        <v-col>
          <v-col> {{ product.name }}</v-col>
          <v-col>{{ product.price }}</v-col>
          <v-col>{{ product.description }} </v-col>
        </v-col>
        <v-row>
          <v-col cols="10">
            <v-divider></v-divider>
          </v-col>
        </v-row>
        <v-row row="6">
          <v-btn class="card-btn" @click="incrementQ(product)">
            <v-icon>mdi-plus</v-icon>
          </v-btn>
          {{ product.quantity }}
          <v-btn class="card-btn" border @click="decrementQ(product)">
            <v-icon>mdi-minus</v-icon>
          </v-btn>
        </v-row>

        <v-btn class="card-btn" border @click="removeFromCart(product)">
          <v-icon>mdi-delete</v-icon>
        </v-btn>
      </v-row>

      <!-- </div> -->
    </v-col>

    <v-row>
      <v-col cols="10">
        <v-divider></v-divider>
      </v-col>
    </v-row>
    <v-col cols="10">
      <v-col>
        <v-row class="bage bg-danger rounded-pill">Total: </v-row>
        <v-row class="text-right">${{ totalCartAmount }}</v-row>
      </v-col>
    </v-col>
    <v-row v-if="totalCartAmount > 0">
      <Stripe />
    </v-row>

    <v-row>
      <v-col class="text-center">
        <v-btn
          class="continue-btn"
          color="primary"
       
          to="/payment"
          block
         
          >Proceed to checkout</v-btn
        >
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
import Stripe from "../views/Payment/Payment.vue";
import products from "@/store/modules/products";
export default {
  data() {
    return {
      Items: [],
      total: 0,
    };
  },
  methods: {
    ...mapActions([
      "removeFromCart",
      "decrementQ",
      "incrementQ",
      "checkout",
      // "applyPromoCode",
    ]),
    //  checkout(){
    //   axios.post('http://127.0.0.1:8000/api/checkout',{
    //     items:this.items,
    //     total: this.total,
    //   })
    //   .then(response =>{
    //     console.log(response.data);
    //   })
    //   .catch(error =>{
    //     console.error(error);
    //   })
    //  }
  },
  computed: {
    ...mapGetters({
      cartItems: "cart",
      totalCartAmount: "totalCartAmount",
      // tax: "tax",
      // deliveryCharge: "deliveryCharge",
      // discount: "discount",
      // subtotal: "subtotalCartAmount",
    }),
    deliveryCharge() {
      return this.$store.state.cart.deliveryCharge;
    },
  },
};
</script>
<style scoped>
.text-right {
  display: block;
  text-align: right;
}

.card-btn {
  display: block;
}

.continue-btn {
  margin-top: 2rem;
  width: 400px;
  display: flex;
}
</style>
