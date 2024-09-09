<template>
    <v-container>
      <v-card class="pa-5">
        <v-img
        src="/public/images/Neutral Beige Simple Aesthetic Flower Boutique Logo.png"
        alt="logo"
        max-height="200"
        max-width="300"
         class="mx-auto d-block my-8"
        ></v-img>
        <v-card-title 
        class="text-subtitle-1 text-medium-emphasis text-center mb-8 "
        >Create  Account</v-card-title>
        <v-card-text>
          <v-form @submit.prevent="submit">
            <!-- Name Field -->
            <v-text-field
              v-model="form.name"
              label="Name"
              required
              outlined
              autofocus
            ></v-text-field>
  
            <!-- Email Field -->
            <v-text-field
              v-model="form.email"
              label="Email"
              type="email"
           
              required
              outlined
              class="mt-4"
            ></v-text-field>
  
            <!-- Password Field -->
            <v-text-field
              v-model="form.password"
              label="Password"
              type="password"
              :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
              :type="visible ? 'text' : 'password'"
               prepend-inner-icon="mdi-lock-outline"
              required
              outlined
              class="mt-4"
              @click:append-inner="visible = !visible"
            ></v-text-field>
  
            <!-- Confirm Password Field -->
            <v-text-field
              v-model="form.password_confirmation"
               :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
                :type="visible ? 'text' : 'password'"
                   prepend-inner-icon="mdi-lock-outline"
              label="Confirm Password"
              type="password"
              required
              outlined
              class="mt-4"
                @click:append-inner="visible = !visible"
            ></v-text-field>
  
            <!-- Terms Checkbox -->
            
  
            <!-- Already Registered Link -->
             <div class=" d-xxl-inline">
            <v-row class="mt-4">
              <v-col class="text-right">
                <v-btn text to="/login"
                color="#AA00FF"
                >
                  Already registered?
                </v-btn>
              </v-col>
            </v-row>
  
            <!-- Register Button -->
            <v-btn
              
              :loading="form.processing"
              :disabled="form.processing"
              type="submit"
              @click="submit"
              style="width:50%"
               color="#4A148C"
            >
              Register
            </v-btn>
            </div>
          </v-form>
        </v-card-text>
      </v-card>
    </v-container>
  </template>
  
  <script setup>


import { defineProps } from 'vue';
import {reactive,ref} from 'vue';
const visible = ref(false);
   const props=defineProps({
      canResetPassword: Boolean,
      message: String,
    });

    const form = reactive({
      name:'',
      email: '',
      password: '',
      password_confirmation:'',
    });
    const message=ref();

  //   const submit = () => {
  //     form.post(route('login'), {
  //       onFinish: () => form.reset('password'),
  //     });
  //   };
  function submit(){
      message.value ='';
      axios.post('http://127.0.0.1:8000/api/user-register',form)
      .then(response => {
        //   router.push({name:'/login'});
      window.location.href = "/login";    
      alert(' Reqistered successfully!') 
      })
      .catch(error =>{
          if(error.response.status===422){
          message.value=error.response.data.message;
          }
         
      })
      .finally(() => form.password='');
  }


</script>


