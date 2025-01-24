<template>
  <v-main>
      <v-card
          class="mx-auto pt-2 mt-4 ml-2 rounded-xl"
          width="Auto"
          color="primary"
          outlined
      >
          <!-- Card Header -->
          <template v-slot:title>
              <span class="font-weight-bold text-h5">View Florist</span>
              <div class="d-flex justify-end">
                  <v-btn
                      size="large"
                      color="secondary"
                      class="rounded-xl mx-2"
                      @click="$router.push('/florists')"
                  >
                      Back
                  </v-btn>
              </div>
          </template>

          <!-- Details Section -->
          <v-card-text class="bg-surface-light pt-6 mt-4 rounded-xl">
              <v-form>
                  <!-- Florist Name -->
                   <label>Florist Name</label>
                  <v-text-field
                      v-model="florist.name"
                      outlined
                      readonly
                  ></v-text-field>

                  <!-- Florist Email -->
                   <label>Email</label>
                  <v-text-field
                      v-model="florist.email"
                      outlined
                      readonly
                      type="email"
                  ></v-text-field>

                  <!-- Florist Phone -->
                   <label>Phone Number</label>
                  <v-text-field
                      v-model="florist.phone_number"
                      outlined
                      readonly
                  ></v-text-field>

                  <!-- Location -->
                   <label>Location</label>
                  <v-autocomplete
                      v-model="florist.location_id"
                      :items="locations"
                      item-title="name"
                      item-value="id"
                      outlined
                      readonly
                  ></v-autocomplete>

                  <!-- Business Name -->
                   <label>Business Name</label>
                  <v-text-field
                      v-model="florist.business_name"
                      outlined
                      readonly
                  ></v-text-field>

                  <!-- Florist Image -->
                   <label>Florist Image</label>
                  <div v-if="previewImage">
                      <img
                          :src="previewImage"
                          alt="Florist Image"
                          class="rounded mt-4"
                          style="max-width: 50%; height: auto"
                      />
                  </div>
              </v-form>
          </v-card-text>
      </v-card>
  </v-main>
</template>

<script>
import axiosInstance from "@/axiosInstance"; 

export default {
  data() {
      return {
          florist: {
              id: null,
              name: "",
              email: "",
              phone_number: "",
              location_id: "",
              image: "",
          },
          locations: [],
          loadingLocation: false,
          previewImage: "",
      };
  },
  async mounted() {
      const floristId = this.$route.params.id;
      await this.fetchFloristDetails(floristId);
      await this.fetchLocations();
  },
  methods: {
      async fetchFloristDetails(id) {
          try {
              const response = await axiosInstance.get(`/florists/${id}`);
              this.florist = response.data;
              console.log(response.data); 
              if (this.florist.image) {
                  // this.previewImage = `${this.florist.image}`;
                  this.previewImage = this.getImageUrl(this.florist.image);
              }
          } catch (error) {
            //   console.error("Error fetching florist details:", error);
              // Optional: Redirect back if florist not found
              // this.$router.push("/florists");
          }
      },
      async fetchLocations() {
          this.loadingLocation = true;
          try {
              const response = await axiosInstance.get("/locations");
              this.locations = response.data;
          } catch (error) {
              console.error("Error fetching locations:", error);
              this.$toast.error("Failed to load locations");
          } finally {
              this.loadingLocation = false;
          }
      },
      getImageUrl(imagePath) {
      const baseUrl = "http://127.0.0.1:8000/storage/"; 
      return `${baseUrl}${imagePath}`;
    },
  
      // handleImageUpload(event) {
      //       const file = event.target.files[0];
      //       if (file) {
      //           const reader = new FileReader();
      //           reader.onload = (e) => {
      //               this.previewImage = e.target.result;
      //           };
      //           reader.readAsDataURL(file);
      //           this.selectedFile = file;
      //       }
      //   },
  },
};
</script>

<style scoped>
.bg-surface-light {
  background-color: #f9f9f9;
}
</style>
