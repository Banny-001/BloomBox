<template>
    <v-main>
        <v-card
            class="pt-4 rounded-xl"
            style="margin: 0 auto; width: auto"
            outlined
        >
            <v-card  outlined>
                <template v-slot:title>
                    <span class="font-weight text-h5">Create Products</span>
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
                <v-form @submit.prevent="create">
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
                                >Florist Shop name</label
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

                        <!-- Popular -->
                        <!-- <v-col cols="12" md="6">
                            <label for="popular" class="form-label"
                                >Popular</label
                            >
                            <v-select
                                id="popular"
                                v-model="form.popular"
                                :items="popularItems"
                                dense
                                clearable
                                :rules="[(v) => !!v || 'Selection is required']"
                                required
                                hide-details
                                class="my-3"
                            ></v-select>
                        </v-col> -->

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
                                >Special Occassion</label
                            >
                            <v-autocomplete
                                id="'special_occassion"
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
                            <label for="image" class="form-label">Image</label>
                            <v-file-input
                                id="image"
                                v-model="form.image"
                                dense
                                clearable
                                :rules="[(v) => !!v || 'Image is required']"
                                required
                                hide-details
                                class="my-3"
                            ></v-file-input>
                        </v-col>
                    </v-row>

                    <!-- Submit Button -->
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
            florists: [],
            loadingFlorist: false,
            loadingCategory: false,
            loadingSpecialOccassions: false,
            // popularItems: ["True", "False"],
            categories: [],
            specialOccassions: [],
            form: {
                name: "",
                price: "",
                description: "",
                florist_id: "",
                // popular: "",
                category_id: "",
                special_occassion_id: "",
                image: null,
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
                console.error("Error fetching Categories:", error);
                this.$toast.error("Failed to load Categories");
            } finally {
                this.loadingCategory = false;
            }
        },
        async fetchSpecialOccassions() {
            this.loadingSpecialOccassions = true;
            try {
                const response = await axiosInstance.get("/SpecialOccassion");
                this.specialOccassions = response.data;
                console.log(response.data)
            } catch (error) {
                console.error("Error fetching Special Occassions:", error);
                this.$toast.error("Failed to load Special Occassions");
            } finally {
               this.loadingSpecialOccassions = false;
            }
        },
        async create() {
            this.loading = true;
            const formData = new FormData();

            formData.append("price", this.form.price);
            formData.append("florist_id", this.form.florist_id);
            formData.append("name", this.form.name);
            formData.append("description", this.form.description);
            formData.append("popular", this.form.popular);
            formData.append("category_id", this.form.category_id);
            formData.append("special_occassion_id", this.form.special_occassion_id);
          
         
            if (this.form.image) {
                formData.append("image", this.form.image);
            }
            // console.log("Florist ID:", this.form.florist_id);
            try {
                await axiosInstance.post('/products', formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                });
                
                this.$router.push('/products');
                this.$toast.success("Products created successfully");
            } catch (error) {
                console.error("Full error object:", error);
                this.$toast.error("Failed to create product");
            } finally {
                this.loading = false;
            }
        },
    },
    mounted() {
        this.fetchFlorists();
        this.fetchCategories();
        this.fetchSpecialOccassions();
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
