<template>
    <v-main>
        <v-card
            class="mx-auto pt-2 mt-4 ml-2 rounded-xl"
            outlined
        >
            <!-- Card Header -->
            <template v-slot:title>
                <span class="font-weight-bold text-h5">View Accompaniments</span>
                <div class="d-flex justify-end">
                    <v-btn
                        size="large"
                        class="rounded-xl mx-2"
                       @click="$router.push('/accompaniments')"
                    >
                        Back
                    </v-btn>
                </div>
            </template>
  
            <!-- Details Section -->
            <v-card-text class="bg-surface-light pt-6 mt-4 rounded-xl">
                <v-form>
                  <v-row>
                    <v-col cols="6">
                     <label>  Accompaniment Name</label>
                    <v-text-field
                        v-model="form.name"
                        outlined
                        readonly
                    ></v-text-field>
                    </v-col>
                    <v-col cols="6">
                     <label>Price</label>
                    <v-text-field
                        v-model="form.price"
                        outlined
                        readonly
                        type="price"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="6">
                     <label>Description</label>
                    <v-text-field
                        v-model="form.description"
                        outlined
                        readonly
                    ></v-text-field>
                   </v-col>
                   <v-col cols="6">
                     <label>Product</label>
                    <v-autocomplete
                       v-model="form.product_id"
                       :items="products"
                       item-title="name"
                       item-value="id"
                        outlined
                        readonly
                    ></v-autocomplete>
                    </v-col>
                    <v-col cols="6">
                     <label> Image</label>
                    <div v-if="previewImage">
                        <img
                            :src="previewImage"
                            alt="Accomaniment Image"
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
            form: {
                id: null,
                name: "",
                product_id: "",
                price: "",
                description: "",
                image: "",
            },
            products: [],
            loadingLocation: false,
            previewImage: "",
        };
    },
    async mounted() {
        const accompanimentId = this.$route.params.id;
        this.fetchAccompaniment(accompanimentId);
        this.fetchProducts();
    },
    methods: {
        async fetchAccompaniment(id) {
            try {
                const response = await axiosInstance.get(
                    `/accompaniments/${id}/edit`
                );
                const accompaniment = response.data;
                this.form = { ...accompaniment };
                if (accompaniment.image) {
                    this.previewImage = accompaniment.image;
                }
            } catch (error) {
                console.error("Error fetching accompaniment details:", error);
            }
        },
        async fetchProducts() {
            this.loadingProducts = true;
            try {
                const response = await axiosInstance.get("/products");
                this.products = response.data;
            } catch (error) {
                console.error("Error fetching products:", error);
                this.$toast.error("Failed to load products");
            } finally {
                this.loadingProducts = false;
            }
        },
        getImageUrl(imagePath) {
        const baseUrl = "http://127.0.0.1:8000/storage/"; 
        return `${baseUrl}${imagePath}`;
      },
    },
  };
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
  