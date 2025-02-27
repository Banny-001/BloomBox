<template>
    <v-main>
      <v-card
        class="mx-auto pt-2 mt-4 ml-2 rounded-xl"
        width="Auto"
        outlined
      >
        <!-- Card Header -->
        <template v-slot:title>
          <span class="font-weight-bold text-h5">View Product</span>
          <div class="d-flex justify-end">
            <v-btn
              size="large"
              class="rounded-xl mx-2"
              @click="$router.push('/products')"
            >
              Back
            </v-btn>
          </div>
        </template>
  
        <!-- Details Section -->
        <v-card-text class="bg-surface-light pt-6 mt-4 rounded-xl">
          <v-form>
            <v-row>
                <v-col cols="10" md="6">
            <label>Product Name</label>
            <v-text-field
              v-model="product.name"
              outlined
              readonly
            ></v-text-field>
        </v-col>
  
        <v-col cols="10" md="6">
            <label>Price</label>
            <v-text-field
              v-model="product.price"
              outlined
              readonly
            ></v-text-field>
          </v-col>
          <v-col cols="10" md="6">
            <label>Description</label>
            <v-text-field
              v-model="product.description"
              outlined
              readonly
            ></v-text-field>
            </v-col>
            <v-col cols="10" md="6">
            <label>Florist Shop Name</label>
            <v-autocomplete
              v-model="product.florist_id"
              :items="florists"
              item-title="business_name"
              item-value="id"
              outlined
              readonly
            ></v-autocomplete>
            </v-col>
            <v-col cols="10" md="6">
            <label>Category</label>
            <v-autocomplete
              v-model="product.category_id"
              :items="categories"
              item-title="name"
              item-value="id"
              outlined
              readonly
            ></v-autocomplete>
            </v-col>
            <v-col cols="10" md="6">
                <label>Special Occasion</label>
                <v-autocomplete
                  v-model="product.special_occassion_id"
                  :items="categories"
                  item-title="name"
                  item-value="id"
                  outlined
                  readonly
                ></v-autocomplete>
                </v-col>
            <v-col cols="10" md="6">
            <label>Product Image</label>
            <div v-if="previewImage">
              <img
                :src="previewImage"
                alt="Product Image"
                class="rounded mt-4"
                style="max-width: 50%; height: auto"
              />
            </div>
            </v-col>
        </v-row>
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
        product: {
          id: null,
          name: "",
          price: "",
          description: "",
          florist_id: "",
          category_id: "",
          image: "",
        },
        florists: [],
        categories: [],
        loadingData: false,
        previewImage: "",
      };
    },
    async mounted() {
      const productId = this.$route.params.id;
      await this.fetchProductDetails(productId);
      await this.fetchFlorists();
      await this.fetchCategories();
    },
    methods: {
      async fetchProductDetails(id) {
        try {
          const response = await axiosInstance.get(`/products/${id}`);
          this.product = response.data;

        if (this.product.image) {
      this.previewImage = this.product.image.startsWith("http")
        ? this.product.image
        : this.getImageUrl(this.product.image);
    }
        } catch (error) {
          console.error("Error fetching product details:", error);
        }
      },
      async fetchFlorists() {
        try {
          const response = await axiosInstance.get("/florists");
          this.florists = response.data;
        } catch (error) {
          console.error("Error fetching florists:", error);
        }
      },
      async fetchCategories() {
        try {
          const response = await axiosInstance.get("/categories");
          this.categories = response.data;
        } catch (error) {
          console.error("Error fetching categories:", error);
        }
      },
      getImageUrl(imagePath) {
        const baseUrl = "http://127.0.0.1:8000/storage/products/";
        return `${baseUrl}${imagePath}`;
      },
    },
  };
  </script>
  
  <style scoped>
.v-btn {
    background-color: #03293a; 
    color: white;
  }
  
  .v-btn:hover {
    background-color: #34708e; 
  }
  .v-card {
 
    background-color: #6fb5e7;
  }
  .v-divider {
    margin-top: 15px;
  }
  </style>
  