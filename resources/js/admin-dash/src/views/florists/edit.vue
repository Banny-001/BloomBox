<template>
  <v-card class="mx-auto pt-4 rounded-xl" width="1400" color="primary" outlined>
    <!-- Card Header -->
    <template v-slot:title>
      <span class="font-weight-bold text-h5">Edit Florist</span>
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

    <!-- Form Section -->
    <v-card-text class="bg-surface-light pt-6 mt-4 rounded-xl">
      <v-form ref="editForm" @submit.prevent="updateFlorist">
        <!-- Florist Name -->
        <v-text-field
          label="Florist Name"
          v-model="florist.name"
          outlined
          required
        ></v-text-field>

        <!-- Florist Email -->
        <v-text-field
          label="Email"
          v-model="florist.email"
          outlined
          required
          type="email"
        ></v-text-field>

        <!-- Florist Phone -->
        <v-text-field
          label="Phone Number"
          v-model="florist.phone"
          outlined
          required
        ></v-text-field>

        <!-- Submit Button -->
        <div class="d-flex justify-end mt-4">
          <v-btn type="submit" color="success" class="rounded-xl">
            Save Changes
          </v-btn>
        </div>
      </v-form>
    </v-card-text>
  </v-card>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      florist: {
        id: null,
        name: "",
        email: "",
        phone: "",
      },
      loading: true, // To show a loading state while fetching data
    };
  },
  async mounted() {
    const floristId = this.$route.params.id;
    await this.fetchFloristDetails(floristId);
  },
  methods: {
    async fetchFloristDetails(id) {
      try {
        const response = await axios.get(`/api/florists/${id}`);
        this.florist = response.data;
        this.loading = false;
      } catch (error) {
        console.error("Error fetching florist details:", error);
        this.$router.push("/florists"); // Redirect back if the florist isn't found
      }
    },
    async updateFlorist() {
      try {
        const response = await axios.put(`/api/florists/${this.florist.id}`, {
          name: this.florist.name,
          email: this.florist.email,
          phone: this.florist.phone,
        });
        console.log("Florist updated successfully:", response.data);
        this.$router.push("/florists"); // Redirect after successful update
      } catch (error) {
        console.error("Error updating florist:", error);
      }
    },
  },
};
</script>

<style scoped>
.bg-surface-light {
  background-color: #f9f9f9;
}
</style>
