<template>
    <v-main>
        <v-card
            class="pt-4 rounded-xl"
            style="margin: 0 auto; width: auto"
            outlined
        >
            <v-card outlined>
                <template v-slot:title>
                    <span class="font-weight text-h5"
                        >Create Accompaniments</span
                    >
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
            </v-card>
            <v-card-text class="bg-surface-light pt-6 mt-4 rounded-xl">
                <v-form @submit.prevent="create">
                    <v-row>
                        <v-col cols="6">
                            <label for="name" class="form-label"
                                >Accompaniment Name</label
                            >
                            <v-text-field
                                id="name"
                                v-model="form.name"
                                dense
                                clearable
                                :rules="[
                                    (v) =>
                                        !!v || 'Accompaniment name is required',
                                ]"
                                required
                                hide-details
                                class="my-3"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="6">
                            <label for="description" class="form-label"
                                >Description</label
                            >
                            <v-text-field
                                id="description"
                                v-model="form.description"
                                dense
                                clearable
                                :rules="[
                                    (v) => !!v || 'Description is required',
                                ]"
                                required
                                hide-details
                                class="my-3"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="6">
                            <label for="price" class="form-label">Price</label>
                            <v-text-field
                                id="price"
                                v-model="form.price"
                                dense
                                clearable
                                :rules="[(v) => !!v || 'Price is required']"
                                required
                                hide-details
                                class="my-3"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="6">
                            <label for="product_id" class="form-label"
                                >Product</label
                            >
                            <v-autocomplete
                                id="product"
                                v-model="form.product_id"
                                :items="products"
                                item-title="name"
                                item-value="id"
                                dense
                                clearable
                                :loading="loadingProduct"
                                :rules="[(v) => !!v || 'Product is required']"
                                required
                                hide-details
                                class="my-3"
                            ></v-autocomplete>
                        </v-col>
                        <v-col cols="6">
                            <label for="image" class="form-label">Image</label>
                            <v-file-input
                                id="image"
                                prepend-icon="mdi-camera"
                                v-model="form.image"
                                dense
                                clearable
                                :rules="[(v) => !!v || 'Image is required']"
                                required
                                hide-details
                                class="my-3"
                                @change="updatePreview"
                            ></v-file-input>
                            <img
                                v-if="previewImage"
                                :src="previewImage"
                                alt="Accompaniment Preview"
                                class="rounded mt-4"
                                style="max-width: 50%; height: auto"
                            />
                        </v-col>
                    </v-row>
                    <div class="d-flex justify-end mt-6">
                        <v-btn
                            size="large"
                            class="rounded-xl mx-2"
                            type="submit"
                        >
                            Save
                        </v-btn>
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
            loading: false,
            valid: false,
            products: [],
            loadingProduct: false,
            previewImage: "",
            form: {
                product_id: "",
                name: "",
                description: "",
                price: "",
                image: null,
            },
        };
    },
    methods: {
        async fetchProducts() {
            this.loadingProduct = true;
            try {
                const response = await axiosInstance.get("/products");
                this.products = response.data;
            } catch (error) {
                console.error("Error fetching products:", error);
                this.$toast.error("Failed to load products");
            } finally {
                this.loadingProduct = false;
            }
        },
        updatePreview(event) {
            const file = event.target.files[0];
            if (file) {
                this.previewImage = URL.createObjectURL(file);
            } else {
                this.previewImage = "";
            }
        },
        async create() {
            this.loading = true;
            const formData = new FormData();
            formData.append("name", this.form.name);
            formData.append("product_id", this.form.product_id);
            formData.append("description", this.form.description);
            formData.append("price", this.form.price);

            if (this.form.image) {
                formData.append("image", this.form.image);
            }

            try {
                await axiosInstance.post("accompaniments/create", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                });
                this.$router.push("/accompaniments");
                this.$toast.success("Accompaniment created successfully");
            } catch (error) {
                console.error("Full error object:", error);
                this.$toast.error("Failed to create accompaniment");
            } finally {
                this.loading = false;
            }
        },
    },
    mounted() {
        this.fetchProducts();
    },
};
</script>
<style>
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
