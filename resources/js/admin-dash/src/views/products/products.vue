<template>

    <v-card
     
      class="mx-auto pt-4 mt-2 rounded-xl"
      prepend-icon="$fa:fas fa-list"
      subtitle="Products"
      width="1400"
      color="primary"
      outlined
    >
      <template v-slot:title>
        <span class="font-weight-bold text-h5">Products</span>
        <v-card class="d-flex flex-end pt-15" color="transparent"  outlined>
          <v-row>
            <v-autocomplete
              :items="items"
              append-inner-icon="mdi-microphone"
              class="justify-start"
              density="comfortable"
              menu-icon=""
              placeholder="Search products"
              prepend-inner-icon="mdi-magnify"
              style="max-width: 350px"
              theme="light"
              variant="solo"
              auto-select-first
              item-props
              rounded
            ></v-autocomplete>
            <v-col class="d-flex justify-end">
              <v-btn
                size="x-large"
                color="secondary"
                class="rounded-xl"
                to="/create"
              >
                Create
              </v-btn>
            </v-col>
          </v-row>
        </v-card>
      </template>
    

    <v-card-text class="bg-surface-light pt-10 rounded-xl"  >
      <v-data-table :items="items">
        <template v-slot:top>
          <v-row class="d-flex justify-end mb-4mt-2" >
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
          <v-icon class="me-4" size="small" color="success" to="/edit">
            mdi-pencil
          </v-icon>
          <v-icon class="me-2" size="small" color="primary" to="/show">
            mdi-eye
          </v-icon>
          <v-icon size="small" color="error" @click="deleteItem(item)">
            mdi-delete
          </v-icon>
        </template>
      </v-data-table>
      <v-divider></v-divider>
    </v-card-text>
  </v-card>

</template>

<script setup>
import axiosInstance from '@/axiosInstance';
import { ref, onMounted } from "vue";

const products = ref([]);

const fetchProducts = async () => {
  try {
    const response = await axiosInstance.get("/products");
    products.value = response.data;
  } catch (error) {
    console.error("Error fetching products:", error);
  }
};
const deleteItem = async (item) => {
  try {
    await axiosInstance.delete(`/products/${item.id}`);
    products.value = products.value.filter((p) => p.id !== item.id);
    alert("Product deleted successfully!");
  } catch (error) {
    console.error("Error deleting product:", error);
  }
};
onMounted(fetchProducts);
</script>
