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
        class="text-subtitle-1 text-medium-emphasis text-center mb-8"
        >LOGIN TO BLOOMBOX</v-card-title
      >
      <v-card-text>
        <!-- Status Message -->
        <v-alert
          v-if="status"
          type="success"
          class="mx-auto d-block my-8"
          border="left"
          colored-border
          elevation="2"
        >
          {{ status }}
        </v-alert>

        <v-form @submit.prevent="register">
          <!-- Email Field -->
          <v-text-field
            v-model="signin.email"
            label="Email"
            type="email"
            required
            variant="outlined"
          ></v-text-field>
          <!-- Password Field -->
          <v-text-field
            v-model="signin.password"
            label="Password"
            type="password"
            :append-inner-icon="visible ? 'mdi-eye' : 'mdi-eye-off'"
            :type="visible ? 'text' : 'password'"
            prepend-inner-icon="mdi-lock-outline"
            required
            autocomplete
            class="mt-4"
            variant="outlined"
            @click:append-inner="visible = !visible"
          ></v-text-field>

          <!-- Remember Me Checkbox -->
          <v-checkbox
            v-model="signin.remember"
            label="Remember me"
            class="mt-4"
          ></v-checkbox>

          <!-- Forgot Password Link & Login Button -->
          <!-- <v-row class="mt-4" justify="space-between">
              <v-col v-if="canResetPassword" cols="auto">
                <v-btn text :href="route('register')">
                  Don't have an account?Register
                </v-btn>
              </v-col>
              </v-row> -->
          <v-col>
            <v-btn color="#4A148C" :loading="loading" type="submit" block>
              Log in
            </v-btn>
          </v-col>
        </v-form>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>
import router from '../../router';
// import axiosInstance from '../../../../axiosInstance.js'
import axiosInstance from '@/axiosInstance';

export default {
  data() {
    return {
      loading: false,
      status: "",
      signin: {
        email: "",
        password: "",
        remember: false,
      },

      visible: false,
    };
  },
  methods: {
    //  handleregisterWithGoogle(){
    //      axios.get('http://127.0.0.1:8000/auth/google/call-back')
    //      .then(response=>{
    //       const token=response.data.token;
    //       localStorage.setItem('auth_token',token);

    //       axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
    //       this.$router.push('/');

    //      }).catch(error=>{
    //       console.log('Error during GoogLe login:',error);
    //      })
    //  },

    register() {
      this.loading = true;
      axiosInstance
        .post("/login", this.signin)
        .then((response) => {
          const token = response.data.token;
          const user = response.data.user;
          // const role = response.data.role;
          //save token and user
        //   localStorage.setItem("token", token);
        //   localStorage.setItem("user", JSON.stringify(user));

          // localStorage.setItem("role", role);
          //success message
          this.loginSuccessAlertVisible = true;
          setTimeout(() => {
            this.loginSuccessAlertVisible = false;
          }, 2000);
          //redirect based on user's role
          // if (role === "admin") {
          //   this.$router.push("/admin");
          // } else if (role === "customer") {
          //   this.$router.push("/");
          // } else if (role === "florist") {
          //   this.$router.push("/florist");
          // }
          axiosInstance.defaults.headers.common["Authorization"] = `Bearer ${token}`;
          this.signin = { email: "", password: "", remember: false }; // Reset form
          router.push("/");
          console.log(response.data);
          //   axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
          //   this.signin = false;
          //   router.push("/");
        })
        .catch((error) => {
          console.error("Error during login:", error);
          if (error.response) {
            console.error("Error response data:", error.response.data);
          }
          
          this.status = "Login failed. Please check your credentials.";
          this.$swal({
            icon: "error",
            title: "Authentication Failed",
            text: error.response.data.error,
          });
        })
        .finally(() => {
          this.loading = false;
        });
    },
    // watch: {
    //   $route(to, from) {
    //     this.signin = false;
    //   },
    // },
  },
};
</script>
