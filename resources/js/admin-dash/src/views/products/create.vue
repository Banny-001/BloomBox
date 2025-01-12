<template>
    <v-main>
        <v-card
            class="pt-4 rounded-xl"
            style="margin: 0 auto; width: auto"
            outlined
        >
            <v-card color="primary" outlined>
                <template v-slot:title>
                    <span class="font-weight text-h5">Create Products</span>
                    <div class="d-flex justify-end">
                        <v-btn
                            size="large"
                            color="secondary"
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
                            <v-textarea
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
                            ></v-textarea>
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
                        <v-col cols="12" md="6">
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
                            color="secondary"
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
            popularItems: ["True", "False"],
            categories: [],
            specialOccassions: [],
            form: {
                name: "",
                price: "",
                description: "",
                florist_id: "",
                popular: "",
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
            try {
                const formData = new FormData();
                for (const key in this.form) {
                    formData.append(key, this.form[key]);
                }
                await axiosInstance.post('/products', formData);
                this.$router.push('/products');
            } catch (error) {
                console.error("Error creating product:", error);
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
.bg-surface-light {
    background-color: #f5f5f5;
}

.v-btn {
    font-weight: bold;
}
</style>
