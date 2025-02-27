<template>
    <v-main>
        <v-card
           class="mx-auto pt-2 mt-4 ml-2 rounded-xl"
            style="margin: 0 auto; width: auto"
            outlined
        >
            <v-card  outlined>
                <template v-slot:title>
                    <span class="font-weight text-h5">Edit Product</span>
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
            </v-card>

            <v-card-text class="bg-surface-light pt-6 mt-4 rounded-xl">
                <v-form @submit.prevent="updateProduct">
                    <v-row>
                        <!-- Product Name -->
                        <v-col cols="10" md="6">
                            <label for="product_name" class="form-label"
                                >Product Name</label
                            >
                            <v-text-field
                                id="product_name"
                                v-model="form.name"
                                dense
                                clearable
                                :rules="[
                                    (v) => !!v || 'Product name is required',
                                ]"
                                required
                                hide-details
                                class="my-3"
                            ></v-text-field>
                        </v-col>

                        <!-- Product Price -->
                        <v-col cols="12" md="6">
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

                        <!-- Description -->
                        <v-col cols="12" md="6">
                            <label for="description" class="form-label"
                                >Description</label
                            >
                            <v-text-field
                                id="description"
                                v-model="form.description"
                                dense
                                clearable
                                rows="3"
                                :rules="[
                                    (v) => !!v || 'Description is required',
                                ]"
                                required
                                hide-details
                                class="my-3"
                            ></v-text-field>
                        </v-col>

                        <!-- Florist -->
                        <v-col cols="12" md="6">
                            <label for="florist" class="form-label"
                                >Florist Shop Name</label
                            >
                            <v-autocomplete
                                id="florist"
                                v-model="form.florist_id"
                                :items="florists"
                                item-title="business_name"
                                item-value="id"
                                dense
                                clearable
                                :loading="loadingFlorist"
                                :rules="[(v) => !!v || 'Florist is required']"
                                required
                                hide-details
                                class="my-3"
                            ></v-autocomplete>
                        </v-col>

                        <!-- Category -->
                        <v-col cols="12" md="6">
                            <label for="category">Category</label>
                            <v-autocomplete
                                id="category"
                                v-model="form.category_id"
                                :items="categories"
                                item-title="name"
                                item-value="id"
                                dense
                                clearable
                                :loading="loadingCategory"
                                :rules="[(v) => !!v || 'Category is required']"
                                required
                                hide-details
                                class="my-3"
                            ></v-autocomplete>
                        </v-col>

                        <!-- Special Occasion -->
                        <v-col cols="12" md="6">
                            <label for="special_occassion" class="form-label"
                                >Special Occasion</label
                            >
                            <v-autocomplete
                                id="special_occassion"
                                v-model="form.special_occassion_id"
                                :items="specialOccassions"
                                item-title="name"
                                item-value="id"
                                dense
                                clearable
                                :loading="loadingSpecialOccassions"
                                :rules="[
                                    (v) =>
                                        !!v || 'Special occasion is required',
                                ]"
                                required
                                hide-details
                                class="my-3"
                            ></v-autocomplete>
                        </v-col>

                        <!-- Image -->
                        <v-col cols="12" md="6">
                            <label>Image</label>
                            <v-file-input
                                prepend-icon="mdi-camera"
                                v-model="selectedFile"
                                accept="image/*"
                                outlined
                                required
                                @change="handleImageUpload"
                            ></v-file-input>
                            <img
                                v-if="previewImage"
                                :src="previewImage"
                                alt="Product Image"
                                class="rounded mt-4"
                                style="max-width: 50%; height: auto"
                            />
                        </v-col>
                    </v-row>

                    <!-- Submit Button -->
                    <div class="d-flex justify-end mt-6">
                        <v-btn
                            size="large"
                            class="rounded-xl mx-2"
                            type="submit"
                        >
                            Update
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
            loading: true,
            florists: [],
            categories: [],
            specialOccassions: [],
            previewImage: "",
            selectedFile: null,
            form: {
                id: null,
                name: "",
                price: "",
                description: "",
                florist_id: "",
                category_id: "",
                special_occassion_id: "",
                image: "",
            },
        };
    },
    methods: {
        async fetchFlorists() {
            this.loadingFlorist = true;
            try {
                const response = await axiosInstance.get("/florists");
                this.florists = response.data;
            } catch (error) {
                console.error("Error fetching florists:", error);
                this.$toast.error("Failed to load florists");
            } finally {
                this.loadingFlorist = false;
            }
        },
        async fetchCategories() {
            this.loadingCategory = true;
            try {
                const response = await axiosInstance.get("/categories");
                this.categories = response.data;
            } catch (error) {
                console.error("Error fetching categories:", error);
                this.$toast.error("Failed to load categories");
            } finally {
                this.loadingCategory = false;
            }
        },
        async fetchSpecialOccassions() {
            this.loadingSpecialOccassions = true;
            try {
                const response = await axiosInstance.get("/SpecialOccassion");
                this.specialOccassions = response.data;
            } catch (error) {
                console.error("Error fetching special occasions:", error);
                this.$toast.error("Failed to load special occasions");
            } finally {
                this.loadingSpecialOccassions = false;
            }
        },
        async fetchProductDetails(id) {
            this.loading = true;
            try {
                const response = await axiosInstance.get(`/products/${id}`);
                this.form = response.data;

                if (this.form.image) {
                    this.previewImage = this.form.image; // Ensure form.image holds the image URL
                }
            } catch (error) {
                console.error("Error fetching product details:", error);
                this.$toast.error("Failed to load product details");
            } finally {
                this.loading = false;
            }
        },
        handleImageUpload(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.previewImage = e.target.result;
                };
                reader.readAsDataURL(file);
                this.selectedFile = file;
            } else {
                this.previewImage = "";
            }
        },

        async updateProduct() {
            this.loading = true;
            const formData = new FormData();

            for (const key in this.form) {
                formData.append(key, this.form[key]);
            }
            console.log(this.form);
            if (this.selectedFile) {
                formData.append("image", this.selectedFile);
            }

            try {
                await axiosInstance.put(
                    `/products/${this.form.id}`,
                    formData,
                    {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    }
                );
                console.log(formData);
                this.$router.push("/products");
                this.$toast.success("Product updated successfully");
            } catch (error) {
                console.error("Error updating product:", error);
                this.$toast.error("Failed to update product");
            } finally {
                this.loading = false;
            }
        },
    },
    mounted() {
        this.fetchFlorists();
        this.fetchCategories();
        this.fetchSpecialOccassions();
        const productId = this.$route.params.id;
        this.fetchProductDetails(productId);
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
</style>

  .v-divider {
    margin-top: 15px;
  }