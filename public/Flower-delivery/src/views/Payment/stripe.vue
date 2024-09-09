<template>
    <v-container>
        <form @submit.prevent="submit">
            <v-row justify="center">
                <v-col cols="12" md="8">
                    <v-card>
                        <v-card-title class="headline">Stripe</v-card-title>

                        <v-card-text>
                            <v-form ref="form" v-model="valid">
                                <v-text-field label="Amount" v-model="amount" required></v-text-field>

                                <v-select v-model="currency" :items="currencies" label="Currency" required></v-select>

                                <v-divider class="my-4"></v-divider>

                                <v-text-field label="Card Number" v-model="cardNumber" required></v-text-field>

                                <v-text-field label="Expiry Date (MM/YY)" v-model="expiryDate" required></v-text-field>

                                <v-text-field label="CVC" v-model="cvc" required></v-text-field>

                                <v-alert v-if="errorMessage" type="error" dismissible>
                                    {{ errorMessage }}
                                </v-alert>
                            </v-form>
                        </v-card-text>

                        <v-card-actions>
                            <v-btn :disabled="!valid" color="primary" 
                            @click="handleSubmit"
                            type="">
                                Pay {{ amount }} {{ currency }}
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col>
            </v-row>
            </form>
    </v-container>
   
</template>

<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";
import { loadStripe } from "@stripe/stripe-js";

const stripe = ref(null);
const cardElement = ref(null);
const elements = ref(null);

const amount = ref('300');
const currency = ref('USD');

onMounted(async () => {
    stripe.value = await loadStripe('pk_test_51PopaqRriseGuZlifAbBKMCgaS1GNvnI3TG6vVovR40y00xf214tJzMvHdUMiM9590xG5VbiT2qbVKyM9RTId0Y700OOczuXCq'); // Replace with your Stripe publishable key

    elements.value = stripe.value.elements();
    cardElement.value = elements.value.create('card');
    cardElement.value.mount('#card-element');
});
const handleSubmit = async (e) => {
    e.preventDefault();

    const { paymentMethod, error } = await stripe.value.createPaymentMethod({
        type: 'card',
        card: cardElement.value,
        billing_details: {
            // Optional: add billing details here
        },
    });
    if (!error) {
        axios.post('http://127.0.0.1:8000/api/checkout', {
            payment_method_id: paymentMethod.id,
            amount: amount.value,
            currency: currency.value,
        })
            .then(response => {
                console.log('Payment successful:', response.data);
                // Handle success
            })
            .catch(error => {
                console.error('Payment error:', error);
                // Handle error
            });
    } else {
        console.error('Stripe error:', error);
        // Handle error
    }
};
</script>

<style scoped>
#card-element {
    margin-top: 20px;
    padding: 10px;
    border: 1px solid #0c0c0c;
    border-radius: 4px;
}
</style>