<template>
    <v-main>
        <v-card class="mx-auto pt-2 mt-4 ml-2 rounded-xl" width="Auto" outlined>
            <template v-slot:title>
                <span class="font-weight-bold text-h5">Edit Florist</span>
                <div class="d-flex justify-end">
                    <v-btn
                        size="large"
                        class="rounded-xl mx-2"
                        @click="$router.push('/florists')"
                    >
                        Back
                    </v-btn>
                </div>
            </template>

            <v-card-text class="bg-surface-light pt-6 mt-4 rounded-xl">
                <v-form ref="editForm" @submit.prevent="updateFlorist">
                    <v-row>
                        <v-col cols="6">
                            <label>Florist Name</label>
                            <v-text-field
                                v-model="florist.name"
                                outlined
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col cols="6">
                            <label>Email</label>
                            <v-text-field
                                v-model="florist.email"
                                outlined
                                required
                                type="email"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="6">
                            <label>Phone Number</label>
                            <v-text-field
                                v-model="florist.phone_number"
                                outlined
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col cols="6">
                            <label>Location</label>
                            <v-autocomplete
                                v-model="florist.location_id"
                                :items="locations"
                                item-title="name"
                                item-value="id"
                                outlined
                                required
                                :loading="loadingLocations"
                                clearable
                                :rules="[(v) => !!v || 'Location is required']"
                            ></v-autocomplete>
                        </v-col>
                        <v-col cols="6">
                            <label>Business Name</label>
                            <v-text-field
                                v-model="florist.business_name"
                                outlined
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col cols="6">
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
                                alt="Florist Image"
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
            florist: {
                id: null,
                name: "",
                email: "",
                phone_number: "",
                location_id: "",
                image: "",
            },
            locations: [],
            loading: true, // To show a loading state while fetching data
            loadingLocations: true,
            // loadingLocation: false,
            selectedFile: null,
            previewImage: "",
        };
    },
    async mounted() {
        const floristId = this.$route.params.id;
        // Getting the ID from the route params
        await this.fetchFloristDetails(floristId);
        await this.fetchLocations();
    },
    methods: {
        async fetchFloristDetails(id) {
            try {
                const response = await axiosInstance.get(
                    `/florists/${id}/edit`
                );
                this.florist = response.data;
                // this.previewImage = this.florist.blob();
                // this.loading = false;
                if (this.florist.image) {
                    this.previewImage = `${this.florist.image}`;
                }
            } catch (error) {
                console.error("Error fetching florist details:", error);
                // this.$router.push("/florists"); // Redirect back if the florist isn't found
            }
        },
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
        //IMAGE UPLOAD
        handleImageUpload(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.previewImage = e.target.result;
                };
                reader.readAsDataURL(file);
                this.selectedFile = file;
            }
        },
        // Update
        async updateFlorist() {
            const formData = new FormData();
            formData.append("name", this.florist.name);
            formData.append("email", this.florist.email);
            formData.append("phone_number", this.florist.phone_number);
            formData.append("location", this.florist.location_id);
            formData.append("business_name", this.florist.business_name);
            // formData.append("image", this.selectedFile);
            // formData.append("phone_number", parseInt(this.florist.phone_number));

            if (this.selectedFile) {
                formData.append("image", this.selectedFile);
            }
            try {
                const response = await axiosInstance.put(
                    `/florists/${this.florist.id}`,
                    formData,
                    {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    }
                );

                console.log("Florist updated successfully:", response.data);
                this.$router.push("/florists");
            } catch (error) {
                console.error("Error updating florist:", error);
            }
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
