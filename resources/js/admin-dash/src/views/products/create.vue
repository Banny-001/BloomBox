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
                                >Florist</label
                            >
                            <v-select
                                id="florist"
                                v-model="form.florist_id"
                                :items="florists"
                                dense
                                clearable
                                :rules="[(v) => !!v || 'Florist is required']"
                                required
                                hide-details
                                class="my-3"
                            ></v-select>
                        </v-col>

                        <!-- Popular -->
                        <v-col cols="12" md="6">
                            <label for="popular" class="form-label"
                                >Popular</label
                            >
                            <v-select
                                id="popular"
                                v-model="form.popular_id"
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
                            <v-select
                                id="category"
                                v-model="form.category_id"
                                :items="categories"
                                dense
                                clearable
                                :rules="[(v) => !!v || 'Category is required']"
                                required
                                hide-details
                            ></v-select>
                        </v-col>

                        <!-- Special Occasion -->
                        <v-col cols="12" md="6">
                            <label for="special_occasion" class="form-label"
                                >Special Occasion</label
                            >
                            <v-select
                                id="special_occasion"
                                v-model="form.special_occasion_id"
                                :items="specialOccasions"
                                dense
                                clearable
                                :rules="[
                                    (v) =>
                                        !!v || 'Special occasion is required',
                                ]"
                                required
                                hide-details
                                class="my-3"
                            ></v-select>
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
export default {
    data() {
        return {
            form: {
                name: "",
                price: "",
                description: "",
                florist_id: null,
                popular_id: null,
                category_id: null,
                special_occasion_id: null,
                image: null,
            },
            florists: ["Florist 1", "Florist 2", "Florist 3"],
            popularItems: ["Yes", "No"],
            categories: ["Roses", "Lilies", "Daisies"],
            specialOccasions: ["Birthday", "Anniversary", "Wedding"],
        };
    },
    methods: {
        create() {
            // Submit form logic here
        },
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
