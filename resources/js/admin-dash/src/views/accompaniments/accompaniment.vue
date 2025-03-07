<template>
    <v-main>
        <v-card
            class="mx-auto pt-2 mt-4 ml-2 rounded-xl"
            subtitle="Accompaniments"
            outlined
        >
            <template v-slot:title>
                <span class="font-weight-bold text-h5 white--text"
                    >Accompaniments</span
                >
                <v-card
                    class="d-flex flex-end pt-15"
                    outlined
                >
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
                            class="rounded-xl"
                            to="/accompaniments/create"
                        >
                            Create
                        </v-btn>
                        <v-btn
                        size="x-large"
                        @click="exportData"
                        class="rounded-xl ml-4"
                    >
                        Export
                        <v-icon class="ml-2" size="24" color="white"
                            >mdi-export</v-icon
                        >
                    </v-btn>
                    </v-col>
                </v-card>
            </template>

            <v-card-text class="bg-surface-light pt-10 rounded-xl">
                <v-data-table
                    :headers="headers"
                    :items="accompaniments"
                    :loading="isLoading"
                    loading-text="Fetching accompaniments..."
                    class="elevetion-2"
                >
                    <template v-slot:[`item.actions`]="{ item }">
                        <!-- Edit Icon -->
                        <v-icon
                            class="me-4 center"
                            size="large"
                            color="success"
                            @click="editItem(item)"
                        >
                            mdi-pencil
                        </v-icon>
                        <v-icon
                            class="me-4 center"
                            size="large"
                            color="success"
                            @click="showItem(item)"
                        >
                            mdi-eye
                        </v-icon>
                        <v-icon
                            size="large"
                            color="error"
                            @click="confirmDelete(item)"
                        >
                            mdi-delete
                        </v-icon>
                    </template>
                </v-data-table>
                <v-divider></v-divider>
                <v-dialog v-model="dialogDelete" max-width="400px">
                    <v-card>
                        <v-card-title class="headline"
                            >Confirm Delete</v-card-title
                        >
                        <v-card-text>
                            Are you sure you want to delete this accompaniment?
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="error" text @click="performDelete"
                                >Yes</v-btn
                            >
                            <v-btn text @click="dialogDelete = false"
                                >Cancel</v-btn
                            >
                        </v-card-actions>
                        <v-snackbar
                            v-model="snackbar"
                            timeout="3000"
                            color="success"
                        >
                            {{ snackbarMessage }}
                        </v-snackbar>
                    </v-card>
                </v-dialog>
            </v-card-text>
        </v-card>
    </v-main>
</template>
<script setup>
import axiosInstance from "@/axiosInstance";
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();

const accompaniments = ref([]);
const isLoading = ref(false);
const dialogDelete = ref(false);
const snackbar = ref(false);
const snackbarMessage = ref("");
let selectedAccompaniment = null;

//headers
const headers = [
    { title: "Name", value: "name" },
    { title: "Description", value: "description" },
    { title: "Image", value: "image", sortable: false },
    { title: "Product", value: "product.name" },
    { title: "Actions", value: "actions", sortable: false },
];

const fetchAccompaniments = async () => {
    isLoading.value = true;
    try {
        const response = await axiosInstance.get("/accompaniments");
        accompaniments.value = response.data;
    } catch (error) {
        console.error("Error fetching accompaniments:", error);
    } finally {
        isLoading.value = false;
    }
};

const confirmDelete = (item) => {
    selectedAccompaniments = item;
    dialogDelete.value = true;
};
const performDelete = async () => {
    if (!selectedAccompaniments) return;
    try {
        await axiosInstance.delete(
            `/accompaniments/${selectedAccompaniments.id}/delete`
        );
        accompaniments.value = accompaniments.value.filter(
            (p) => p.id !== selectedAccompaniments.id
        );
        snackbarMessage.value = "Accompaniment deleted successfully!";
        snackbar.value = true;
    } catch (error) {
        console.error("Error deleting florist:", error);
    } finally {
        // dialogDelete.value = false;
        // selectedAccompaniments = null;
    }
};
//edit
const editItem = (item) => {
    selectedAccompaniment= item;
    router.push({ path: `/editaccompaniment/${item.id}` });
};
const showItem = (item) => {
    selectedAccompaniment= item;
    router.push({ path: `/showaccompaniment/${item.id}` });
};

onMounted(fetchAccompaniments);
</script>

<style scoped>
.v-card {
    background-color: #6fb5e7; /* Purple background for the card */
  }
  .v-btn {
    background-color: #03293a; 
    color: white;
  }
  
  .v-btn:hover {
    background-color: #34708e; 
  }
  
  .custom-table .v-data-table {
    background-color: #f4f4f4; /* Light background for the table */
    font-weight: bold;
  }
  
  .v-dialog {
    background-color: #ffffff;
  }
</style>
