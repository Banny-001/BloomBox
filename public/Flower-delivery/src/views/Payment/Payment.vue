<template>
  <v-card-title class="bg-surface-light pt-4">
    <h1>Checkout</h1>
  </v-card-title>
  <v-card-text>
    <v-card-subtitle>
      <h1>Shipping Address</h1>
    </v-card-subtitle>
    <v-radio value="location" label="address"></v-radio>

    <v-radio class="text-medium-emphasis pa-6" value="location" label="Add new address"></v-radio>
  </v-card-text>
  <form id="payment-form">
    <v-card-subtitle>
      <h1>Choose Payment Method</h1>
    </v-card-subtitle>
    <v-list>
      <v-card-text>
        <v-btn color="deep-purple-darken-2" size="x-large" href="http://127.0.0.1:8000/mpesa">
          Mpesa
        </v-btn>
      </v-card-text>
      <v-card-text>
        <v-btn color="deep-purple-darken-2" size="x-large" @click="handleSubmit">
          Stripe
        </v-btn>
      </v-card-text>
      <!-- <v-container>
        <v-btn @click="openPaymentDialog">Pay with Stripe</v-btn>
    
        <v-dialog v-model="dialog" max-width="600px">
          <v-card>
            <v-card-title>Enter Your Card Details</v-card-title>
            <v-card-text>
              <form @submit.prevent="handleSubmit">
                <v-text-field
                label="Amount"
                v-model="amount"
                :rules="[rules.required, rules.number]"
                required
              ></v-text-field>
                <div id="payment-element">
                  
                </div>
                <v-btn type="submit"
                @click="handleSubmit"
                 :loading="loading"
                >Submit Payment</v-btn>
              </form>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="red darken-1" text @click="closePaymentDialog">Cancel</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-container> -->
    </v-list>

    <v-btn to="/shipping" @click="submitOrder"> Procced to Checkout</v-btn>
  </form>
</template>

<script setup>
import axios from "axios";
import Cart from "../../store/modules/cart";
import { ref, onMounted } from "vue";
import { useStore } from "vuex";

const dialog = ref(false);
const loading = ref(false);
const token = ref(null);
const stripe = ref(null);
const elements = ref(null);
const store = useStore();

// const openPaymentDialog = () => {
//   dialog.value = true;
// };
// const closePaymentDialog = () => {
//   dialog.value = false;
// };

const totalCartAmount = ref(store.getters["totalCartAmount"]);

onMounted(() => {
  axios
    .post("http://127.0.0.1:8000/api/checkout", {
      payment_intent_id: "",
      amount: totalCartAmount.value,
      cartItems: store.getters["cartItems"],
      // name: product_name,
      currency: "USD",
    })
    .then((response) => {
      token.value = response.token;
      stripe.value = Stripe(
        "pk_test_51PopaqRriseGuZlifAbBKMCgaS1GNvnI3TG6vVovR40y00xf214tJzMvHdUMiM9590xG5VbiT2qbVKyM9RTId0Y700OOczuXCq"
      );
      const options = {
        clientSecret: response.client_secret,
      };
      elements.value = stripe.value.elements(options);
      const paymentElement = elements.value.create("payment");
      paymentElement.mount("#payment-element");
      
      callBackend();
    })
    .catch((error) => {
      console.error("Error creating payment intent: ", error);
    });
});
const handleSubmit = async (e) => {
  e.preventDefault();
  axios.post("http://127.0.0.1:8000/api/complete-payment", {
    PAYMENT_INTENT_ID: paymentIntentId,
    order_data: orderData,
    customer_id: customerId,
    cartItems: store.getters["cartItems"],
  });
  const { error } = await stripe.value.completePayment({
    elements: elements.value,

    confirmParams: {
      return_url: "http://127.0.0.1:8000/api/payment-success",
    },
    redirect: "if_required",
  });

  if (!error) {
    axios
      .post("http://127.0.0.1:8000/api/orders/create", {
        token: token.value,
        cartItems: store.getters["cartItems"],
        totalCartAmount: totalCartAmount.value,
        customerId: store.getters["auth/customerId"],
        paymentIntentId: paymentIntent.id,
      })
      .then((response) => {
        console.log("Order placed successfully:", response.data);
      })
      .catch((error) => {
        console.error("Error placing order:", error);
      });
  } else {
    axios.post("http://127.0.0.1:8000/api/payment-cancel", {
      token: token.value,
      code: error.code,
      description: error.message,
    });
  }
};

function callBackend(){
  try {
        const data = axios.post("api/payments", FormData);
        if (data.message == "successful") {
          console.log("payment Successful")
          //logic
        }
        else {
          console.log("payment unsuccessful")
          // logic
        }
      } catch (error) {
        console.log("error", error)
      }
}
// let access_token;
//         document.getElementById('getAccessToken').addEventListener('click', (event) => {
//             event.preventDefault()

//             axios.post('/api/get-token', {})
//                 .then((response) => {
//                     console.log(response.data);
//                     access_token = response.data.access_token;
//                     document.getElementById('access_token').innerHTML = response.data.access_token
//                 })
//                 .catch((error) => {
//                     console.log();
//                 })
//         });
//         document.getElementById('registerURLS').addEventListener('click',(event) => {
//             event.preventDefault()
//             const requestBody={
//               token: access_token,
//            }

//             axios.post('/register-urls', requestBody)
//             .then((response) =>{
//                 console.log('Response: ', response);
//                 if(response.data.ResponseDescription){
//                   document.getElementById('response').innerHTML = response.data.ResponseDescription
//                 }else{
//                     document.getElementById('response').innerHTML= response.data.errorMessage
//                 }
//                 console.log(response.data);

//             })
//             .catch((error)=>{
//                 console.log(error);
//             })
//         }) ;
//         document.getElementById ('simulate').addEventListener('click',(event)=> {
//            event.preventDefault()

//            const requestBody={
//               amount: document.getElementById('amount').value,
//               account: document.getElementById('account').value
//            }
//            axios.post('/simulate',requestBody)
//            .then((response)=>{
//             console.log(response);
//            })
//            .catch((error)=>{
//             console.log(error);
//            })
//         });
</script>
