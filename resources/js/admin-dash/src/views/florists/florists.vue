<template>
  <v-card
    class="mx-auto pt-4 mt-2 rounded-xl"
    subtitle="Florists"
    width="1400"
    color="primary"
    outlined
  >
    <template v-slot:title>
      <span class="font-weight-bold text-h5">Florists</span>
      <v-card class="d-flex flex-end pt-15" color="transparent" outlined>
        <v-row>
          <v-autocomplete
            :items="florists"
            item-title="business_name"
            append-inner-icon="mdi-microphone"
            class="justify-start"
            density="comfortable"
            placeholder="Search florists"
            prepend-inner-icon="mdi-magnify"
            style="max-width: 350px"
            theme="light"
            variant="solo"
            auto-select-first
            rounded
          ></v-autocomplete>
          <v-col class="d-flex justify-end">
            <v-btn
              size="x-large"
              color="secondary"
              class="rounded-xl"
              to="/florists/create"
            >
              Create
            </v-btn>
          </v-col>
        </v-row>
      </v-card>
    </template>

    <v-card-text class="bg-surface-light pt-10 rounded-xl">
      <v-data-table
        :headers="headers"
        :items="florists"
        :loading="isLoading"
        loading-text="Fetching florists..."
        class="elevation-1"
      >
        <template v-slot:top>
          <v-row class="d-flex justify-end mb-4 mt-2">
            <v-btn
              color="secondary"
              padding="2px"
              @click="exportData"
              width="90px"
              class="rounded-xl"
            >
              Export
              <v-icon>mdi-export</v-icon>
            </v-btn>
          </v-row>
        </template>

        <template v-slot:[`item.actions`]="{ item }">
          <!-- Edit Icon -->
          <v-icon
            class="me-4 center"
            size="large"
            color="success"
            @click="$router.push(`/florists/edit/id`)"
          >
            mdi-pencil
          </v-icon>
          <!-- Show Icon -->
          <v-icon
            class="me-4 center"
            size="large"
            color="success"
            @click="$router.push(`/florists/show/${item.id}`)"
          >
            mdi-eye
          </v-icon>

          <!-- Delete Icon -->
          <v-icon size="large" color="error" @click="confirmDelete(item)">
            mdi-delete
          </v-icon>
          <!-- Delete Confirmation Dialog -->
          <v-dialog v-model="dialogDelete" max-width="400px">
            <v-card>
              <v-card-title class="headline">Confirm Delete</v-card-title>
              <v-card-text
                >Are you sure you want to delete this florist?</v-card-text
              >
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="error" text @click="performDelete">Yes</v-btn>
                <v-btn text @click="dialogDelete = false">Cancel</v-btn>
              </v-card-actions>
              <!-- Snackbar -->
              <v-snackbar v-model="snackbar" timeout="3000" color="success">
                {{ snackbarMessage }}
              </v-snackbar>
            </v-card>
          </v-dialog>
        </template>
      </v-data-table>
      <v-divider></v-divider>
    </v-card-text>
  </v-card>
</template>
<script setup>
import axiosInstance from "@/axiosInstance";
import { ref, onMounted } from "vue";

// Data properties
const florists = ref([]);
const isLoading = ref(false);
const dialogDelete = ref(false);
const snackbar = ref(false);
const snackbarMessage = ref("");
let selectedFlorist = null;

// Table headers

const headers = [
  { title: "Business Name", value: "business_name" },
  { title: "Name", value: "name" },
  { title: "Location", value: "location" },
  { title: "Phone Number", value: "phone_number" },
  { title: "Email", value: "email" },
  { title: "Image", value: "image", sortable: false },
  { title: "Actions", value: "actions", sortable: false },
];

// Fetch florists from API
const fetchFlorists = async () => {
  isLoading.value = true;
  try {
    const response = await axiosInstance.get("/florists");
    florists.value = response.data;
  } catch (error) {
    console.error("Error fetching florists:", error);
  } finally {
    isLoading.value = false;
  }
};

// Confirm delete dialog
const confirmDelete = (item) => {
  selectedFlorist = item;
  dialogDelete.value = true;
};
// Delete a florist
const performDelete  = async () => {
  if (!selectedFlorist) return;
  try {
    await axiosInstance.delete(`/florists/${selectedFlorist.id}/delete`);
    florists.value = florists.value.filter((p) => p.id !== selectedFlorist.id);
    console.log("Setting snackbar message...");
    snackbarMessage.value = "Florist deleted successfully!";
   
    snackbar.value = true;
    console.log("Snackbar message set.");
  } catch (error) {
    console.error("Error deleting florist:", error);
  }finally {
    dialogDelete.value = false;
    selectedFlorist = null;
  }
};

// Lifecycle hook
onMounted(fetchFlorists);
</script>
