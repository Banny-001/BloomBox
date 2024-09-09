<template>
    <v-container>
      <v-row justify="center">
        <v-col cols="12" md="8">
  
  
          <v-card class="mt-5">
            <v-card-title>Stk Transactions</v-card-title>
            <v-card-text>
              <v-form action="">
                <v-text-field  label="Phone " type="number"></v-text-field>
                <v-text-field v-model="amount" label="Amount" type="number"></v-text-field>
             
                <v-text-field v-model="account" label="Account"></v-text-field>
                <v-btn color="primary" id="stkpush" type="submit">Simulate stk</v-btn>
              </v-form>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </template>
  
  <script>
  import axios from "axios";
  
  // export default {
  //   data() {
  //     return {
  //       accessToken: null,
  //       responseMessage: null,
  //       responseMessageType: "success",
  //       amount: "",
  //       account: "",
  //     };
  //   },
  //   methods: {
  //     getAccessToken() {
  //       axios
  //         .post("/get-token")
  //         .then((response) => {
  //           this.accessToken = response.data.access_token;
  //         })
  //         .catch((error) => {
  //           console.error(error);
  //           this.responseMessage = "Failed to obtain access token.";
  //           this.responseMessageType = "error";
  //         });
  //     },
  //     registerURLs() {
  //       const requestBody = {
  //         token: this.accessToken,
  //       };
  
  //       axios
  //         .post("/register-urls", requestBody)
  //         .then((response) => {
  //           this.responseMessage = response.data.ResponseDescription
  //             ? response.data.ResponseDescription
  //             : response.data.errorMessage;
  //           this.responseMessageType = response.data.ResponseDescription
  //             ? "success"
  //             : "error";
  //         })
  //         .catch((error) => {
  //           console.error(error);
  //           this.responseMessage = "Failed to register URLs.";
  //           this.responseMessageType = "error";
  //         });
  //     },
  //     simulateTransaction() {
  //       const requestBody = {
  //         amount: this.amount,
  //         account: this.account,
  //       };
  
  //       axios
  //         .post("/simulate", requestBody)
  //         .then((response) => {
  //           console.log("Transaction simulated: ", response);
  //           this.responseMessage = "Transaction simulated successfully.";
  //           this.responseMessageType = "success";
  //         })
  //         .catch((error) => {
  //           console.error(error);
  //           this.responseMessage = "Failed to simulate transaction.";
  //           this.responseMessageType = "error";
  //         });
  //     },
  //   },
  // };
   document.getElementById ('/stkpush').addEventListener('click',(event)=> {
           event.preventDefault()

           const requestBody={
              amount: document.getElementById('amount').value,
              account: document.getElementById('account').value,
              phone: document.getElementById('phone').value
           }
           axios.post('/stkpush',requestBody)
           .then((response)=>{
            if(response.data.ResponseDescription){
              document.getElementById('c2b_response').innerHTML = response.data.ResponseDescription
            }else{
              document.getElementById('c2b_response').innerHTML=response.data.errorMessage
            }
           })
           .catch((error)=>{
            console.log(error);
           })
        })
  </script>
  