<template>
    <v-main>
        <v-card
            class="mx-auto pt-2 mt-4 ml-2 rounded-xl"
            outlined
        >
            <template v-slot:title>
                <span class="font-weight-bold text-h5">Edit Accompaniment</span>
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
            <v-card-text class="bg-surface-light pt-6 mt-4 rounded-xl">
                <v-form ref="editForm" @submit.prevent="updateAccompaniment">
                    <v-row>
                        <v-col cols="10" md="6">
                            <label for="accompaniment_name" class="form-label">
                                Accompaniment Name
                            </label>
                            <v-text-field
                                id="accompaniment_name"
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
                        <v-col cols="12" md="6">
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
                        <v-col cols="12" md="6">
                            <label>Product</label>
                            <v-autocomplete
                                v-model="form.product_id"
                                :items="products"
                                item-title="name"
                                item-value="id"
                                outlined
                                required
                                :loading="loadingProducts"
                                clearable
                                :rules="[(v) => !!v || 'Product is required']"
                            ></v-autocomplete>
                        </v-col>
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
                    <div class="d-flex justify-end mt-6">
                        <v-btn
                            size="large"
                            color="secondary"
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
            loadingProducts: true,
            products: [],
            previewImage: "",
            selectedFile: null,
            form: {
                id: null,
                name: "",
                product_id: "",
                price: "",
                description: "",
                image: "",
            },
        };
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
        async updateAccompaniment() {
            const formData = new FormData();
            formData.append("product_id", this.form.product_id);
            formData.append("name", this.form.name);
            formData.append("description", this.form.description);
            formData.append("price", this.form.price);
            for (const key in this.form) {
                formData.append(key, this.form[key]);
            }
            
            if (this.selectedFile) {
                formData.append("image", this.selectedFile);
            }
            try {
                await axiosInstance.put(
                    // `/accompaniments/${this.accompaniment.id}`,
                    `/accompaniments/${this.form.id}`,
                    formData,
                    {
                        headers: { "Content-Type": "multipart/form-data" },
                    },
                    console.log(formData)
                );
                
               
                this.$router.push("/accompaniments");
                this.$toast.success("Accompaniment updated successfully");
            } catch (error) {
                console.error("Error updating accompaniment:", error);
                this.$toast.error("Failed to update accompaniment");
            }
        },
    },
    mounted() {
        const accompanimentId = this.$route.params.id;
        this.fetchAccompaniment(accompanimentId);
        this.fetchProducts();
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