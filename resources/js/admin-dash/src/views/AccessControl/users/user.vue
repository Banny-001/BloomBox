<template>
    <v-main>
        <v-card
            class="mx-auto pt-2 mt-4 ml-2 rounded-xl"
            subtitle="Users"
            outlined
        >
            <template v-slot:title>
                <span class="font-weight-bold text-h5 white--text">Users</span>
                <v-card
                    class="d-flex flex-end pt-15"
                    outlined
                >
                    <v-row>
                       
                        <Search  :items="items" @update:filteredItems="updateFilteredUsers" />
                        <v-col class="d-flex justify-end">
                            <v-btn
                                size="x-large"
                                class="rounded-xl"
                                to="/create"
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
                    </v-row>
                </v-card>
            </template>

            <v-card-text class="bg-surface-light pt-10 rounded-xl">
                <v-data-table
                    :headers="headers"
                    :items="items"
                    :loading="isLoading"
                    loading-text="Fetching users..."
                    class="elevation-2"
                >
                    <template v-slot:[`item.actions`]="{ item }">
                        <v-icon
                            class="me-4 center"
                            size="large"
                            color="success"
                            @click="$router.push(`/editusers/${item.id}`)"
                        >
                            mdi-pencil
                        </v-icon>
                        <v-icon
                            class="me-4 center"
                            size="large"
                            color="success"
                            @click="$router.push(`/showusers/${item.id}`)"
                        >
                            mdi-eye
                        </v-icon>

                        <Delete :item="item" :deleteAction="confirmDelete" />

                    </template>
                </v-data-table>
                <v-divider></v-divider>
            </v-card-text>
        </v-card>

        <!-- Delete Confirmation Dialog -->
     
    </v-main>
</template>

<script setup>
import axiosInstance from "@/axiosInstance";
import { ref, onMounted } from "vue";
import Search from "../../../components/buttons/search.vue";
import Delete from "../../../components/buttons/delete.vue";


const items = ref([]);
const isLoading = ref(false);
const dialogDelete = ref(false);
const snackbar = ref(false);
const snackbarMessage = ref("");
let selectedItem = null;

const headers = [
    { title: "Name", value: "name" },
    { title: "Email", value: "email" },
    { title: "Actions", value: "actions", sortable: false },
];

// Fetch products from API
const fetchUsers = async () => {
    isLoading.value = true;
    try {
        const response = await axiosInstance.get("/users");
        items.value = response.data;
        console.log("Fetched users:", items.value);
    } catch (error) {
        console.error("Error fetching users:", error);
    } finally {
        isLoading.value = false;
    }
};

// Confirm delete dialog
const confirmDelete = (item) => {
    selectedItem = item;
    dialogDelete.value = true;
};


// Delete a product
// const performDelete = async () => {
//     if (!selectedItem) return;
//     try {
//         await axiosInstance.delete(`/users/${selectedItem.id}`);
//         items.value = items.value.filter((p) => p.id !== selectedItem.id);
//         snackbarMessage.value = "User deleted successfully!";
//         snackbar.value = true;
//     } catch (error) {
//         console.error("Error deleting user:", error);
//     } finally {
//         dialogDelete.value = false;
//         selectedItem = null;
//     }
// };

const exportData = () => {
    // Implement export functionality
};

onMounted(fetchUsers);

const updateFilteredUsers = (newList) => {
    filteredUsers.value = newList;
};
</script>

<style scoped>
/* Purple theme for card and actions */
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

/* Adjust padding and spacing for a cleaner layout */
.v-row {
    padding: 10px 0;
}

.v-col {
    margin-top: 10px;
}

.v-divider {
    margin-top: 15px;
}
</style>
