<template>
    <v-main>
        <v-card
            class="pt-4 rounded-xl"
            style="margin: 0 auto; width: auto"
            outlined
        >
            <v-card color="primary" outlined>
                <template v-slot:title>
                    <span class="font-weight text-h5">Create Florists</span>
                    <div class="d-flex justify-end">
                        <v-btn
                            size="large"
                            color="secondary"
                            class="rounded-xl mx-2"
                            @click="$router.push('/florists')"
                        >
                            Back
                        </v-btn>
                    </div>
                </template>
            </v-card>
            <v-card-text class="bg-surface-light pt-6 mt-4 rounded-xl">
                <v-form @submit.prevent="create">
                    <v-row>
                        <!-- First Row -->
                        <v-col cols="6">
                            <label for="business_name" class="form-label"
                                >Business Name</label
                            >
                            <v-text-field
                                id="business_name"
                                v-model="form.business_name"
                                dense
                                clearable
                                :rules="[
                                    (v) => !!v || 'Business name is required',
                                ]"
                                required
                                hide-details
                                class="my-3"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="6">
                            <label for="location" class="form-label"
                                >Location</label
                            >
                            <v-autocomplete
                                id="location"
                                v-model="form.location_id"
                                :items="locations"
                                item-title="name"
                                item-value="id"
                                dense
                                clearable
                                :loading="loadingLocation"
                                :rules="[(v) => !!v || 'Location is required']"
                                required
                                hide-details
                                class="my-3"
                            ></v-autocomplete>
                        </v-col>

                        <!-- Second Row -->
                        <v-col cols="6">
                            <label for="florist_name" class="form-label"
                                >Florist Name</label
                            >
                            <v-text-field
                                id="florist_name"
                                v-model="form.name"
                                dense
                                clearable
                                :rules="[
                                    (v) => !!v || 'Florist name is required',
                                ]"
                                required
                                hide-details
                                class="my-3"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="6">
                            <label for="phone_number" class="form-label"
                                >Phone Number</label
                            >
                            <v-text-field
                                id="phone_number"
                                v-model="form.phone_number"
                                dense
                                clearable
                                :rules="[
                                    (v) => !!v || 'Phone number is required',
                                ]"
                                required
                                hide-details
                                class="my-3"
                            ></v-text-field>
                        </v-col>

                        <!-- Third Row -->
                        <v-col cols="6">
                            <label for="email" class="form-label">Email</label>
                            <v-text-field
                                id="email"
                                v-model="form.email"
                                dense
                                clearable
                                :rules="[(v) => !!v || 'Email is required']"
                                required
                                hide-details
                                class="my-3"
                            ></v-text-field>
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
import axiosInstance from "../../../../axiosInstance";

export default {
    data() {
        return {
            loading: false,
            valid: false,
            locations: [],
            loadingLocation: false,
            form: {
                business_name: "",
                location_id: "",
                name: "",
                phone_number: "",
                image: null,
            },
        };
    },
    methods: {
        async fetchLocations() {
            this.loadingLocation = true;
            try {
                const response = await axiosInstance.get("/locations");
                this.locations = response.data;
            } catch (error) {
                console.error("Error fetching locations:", error);
                this.$toast.error("Failed to load locations");
            } finally {
                this.loadingLocation = false;
            }
        },
        async create() {
            this.loading = true;
            const formData = new FormData();

            formData.append("business_name", this.form.business_name);
            formData.append("location_id", this.form.location_id);
            formData.append("name", this.form.name);
            formData.append("phone_number", this.form.phone_number);
            formData.append("email", this.form.email);

            if (this.form.image) {
                formData.append("image", this.form.image);
            }

            try {
                await axiosInstance.post("/florists/create", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                });
                this.$router.push("/florists");
                this.$toast.success("Florist created successfully");
            } catch (error) {
                console.error("Full error object:", error);
                this.$toast.error("Failed to create florist");
            } finally {
                this.loading = false;
            }
        },
    },
    mounted() {
        this.fetchLocations();
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

.v-form {
    margin: 0 auto;
}

.my-3 {
    margin-top: 1rem;
    margin-bottom: 1rem;
}

.form-label {
    font-weight: bold;
    margin-bottom: 0.5rem;
    display: block;
    font-size: 14px;
}
</style>
