<template>
  <v-card class="mx-auto pt-4 rounded-xl" width="1400" color="primary" outlined>
    <template v-slot:title>
      <span class="font-weight-bold text-h5">Create Florists</span>
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

    <v-card-text class="bg-surface-light pt-6 mt-4 rounded-xl">
      <v-form @submit.prevent="create">
        <v-col cols="12" sm="8" md="6">
          <label>Business Name</label>
          <v-text-field
            v-model="form.business_name"
            dense
            clearable
            :rules="[(v) => !!v || 'Business name is required']"
            required
          ></v-text-field>
          <v-spacer></v-spacer>

          <label>Location</label>
          <v-text-field
            v-model="form.location"
            dense
            clearable
            :rules="[(v) => !!v || 'Location is required']"
            required
          ></v-text-field>
          <v-spacer></v-spacer>

          <label>Florist Name</label>
          <v-text-field
            v-model="form.name"
            dense
            clearable
            :rules="[(v) => !!v || 'Florist name is required']"
            required
          ></v-text-field>
          <v-spacer></v-spacer>

          <label>Phone Number</label>
          <v-text-field
            v-model="form.phone_number"
            dense
            clearable
            :rules="[(v) => !!v || 'Phone number is required']"
            required
          ></v-text-field>
          <v-spacer></v-spacer>
          <label>Email</label>
          <v-text-field
            v-model="form.email"
            dense
            clearable
            :rules="[(v) => !!v || 'Email is required']"
            required
          ></v-text-field>
          <v-spacer></v-spacer>

          <label>Image</label>
          <v-file-input
            v-model="form.image"
            label="Image"
            dense
            clearable
            :rules="[(v) => !!v || 'Image is required']"
            required
          ></v-file-input>
        </v-col>

        <div class="d-flex justify-end">
          <v-btn
            size="large"
            color="secondary"
            class="rounded-xl mx-2"
            type="submit"
          >
            Save
          </v-btn>
        </div>
      </v-form>
    </v-card-text>
  </v-card>
</template>

<script>
import axiosInstance from "../../../../axiosInstance";

export default {
  data() {
    return {
      loading: false,
      valid: false,
      form: {
        business_name: "",
        location: "",
        name: "",
        phone_number: "",
        image: null,
      },
    };
  },
  methods: {
    async create() {
      this.loading = true;
      const formData = new FormData();

      // Append form fields to FormData
      formData.append("business_name", this.form.business_name);
      formData.append("location", this.form.location);
      formData.append("name", this.form.name);
      formData.append("phone_number", this.form.phone_number);
      formData.append("email", this.form.email);

      if (this.form.image) {
        formData.append("image", this.form.image);
      }

      try {
        await axiosInstance.post("/florists/create", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        });
        this.$router.push("/florists");
        this.$toast.success("Florist created successfully");
      } catch (error) {
       
        console.error("Full error object:", error);

        if (
          error.response &&
          error.response.data &&
          error.response.data.message
        ) {
          console.error("Error message:", error.response.data.message);
        } else if (error.message) {
          console.error("Error message:", error.message);
        } else {
          console.error("An unknown error occurred.");
        }

       
        this.$toast.error("Failed to create florist");
      } finally {
        this.loading = false;
      }
    },
  },
};
</script>
