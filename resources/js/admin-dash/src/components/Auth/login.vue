<template>
  
  <v-container>
    <v-card class="pa-2 mx-auto" max-width="800">
      <v-img
        src="https://i.pinimg.com/736x/75/86/f9/7586f944b521d91b578636b8cf63cce0.jpg"
        alt="logo"
        max-height="200"
        max-width="300"
        class="mx-auto my-8"
      ></v-img>
      <v-card-title class="text-center mb-8">
        <h2 class="text-h5">LOGIN TO BLOOMBOX</h2>
      </v-card-title>
      <v-card-text>
        <!-- Status Message -->
        <v-alert
          v-if="status"
          type="error"
          dismissible
          class="mx-auto d-block my-8"
        >
          {{ status }}
        </v-alert>

        <v-form @submit.prevent="register">
          <v-text-field
            v-model="signin.email"
            label="Email"
            type="email"
            required
            variant="outlined"
          ></v-text-field>
          <v-text-field
            v-model="signin.password"
            label="Password"
            :type="visible ? 'text' : 'password'"
            :append-inner-icon="visible ? 'mdi-eye' : 'mdi-eye-off'"
            required
            @click:append-inner="toggleVisibility"
            variant="outlined"
          ></v-text-field>

          <v-checkbox v-model="signin.remember" label="Remember me"></v-checkbox>

          <v-btn color="primary" :loading="loading" type="submit" block>
            Log in
          </v-btn>
        </v-form>
      </v-card-text>
    </v-card>
  </v-container>

</template>

<script>
import router from '../../router';
import axiosInstance from '@/axiosInstance';

export default {
  name: "Login",
  data() {
    return {
      loading: false,
      status: "",
      signin: {
        email: "",
        password: "",
        remember: false,
      },
      visible: false,  // To toggle the visibility of the password
    };
  },
  methods: {
    toggleVisibility() {
      this.visible = !this.visible;
    },
    register() {
      this.loading = true;
      this.status = ""; 
      axiosInstance
        .post("/login", this.signin)
        .then((response) => {
          const token = response.data.token;
          const user = response.data.user;

          // Save token and user in localStorage
          localStorage.setItem("token", token);
          localStorage.setItem("user", JSON.stringify(user));

          // Set authorization header
          axiosInstance.defaults.headers.common["Authorization"] = `Bearer ${token}`;
          
          // Reset form
          this.signin = { email: "", password: "", remember: false };
          
          // Redirect user to home
          router.push("/home");
        })
        .catch((error) => {
          console.error("Error during login:", error);
          if (error.response) {
            this.status = error.response.data.error || "Login failed. Please check your credentials.";
          } else {
            this.status = "Network error. Please try again.";
          }
        })
        .finally(() => {
          this.loading = false;
        });
    },
  },
};
</script>

