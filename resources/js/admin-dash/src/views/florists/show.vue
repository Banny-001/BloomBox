<template>
    <v-main>
        <v-card
            class="mx-auto pt-2 mt-4 ml-2 rounded-xl"
            width="Auto"
            outlined
        >
            <template v-slot:title>
                <span class="font-weight-bold text-h5">View Florist</span>
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
                <v-form>
                    <v-row>
                        <v-col cols="6">
                            <label>Florist Name</label>
                            <v-text-field
                                v-model="florist.name"
                                outlined
                                readonly
                            ></v-text-field>
                        </v-col>
                        <v-col cols="6">
                            <label>Email</label>
                            <v-text-field
                                v-model="florist.email"
                                outlined
                                readonly
                                type="email"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="6">
                            <label>Phone Number</label>
                            <v-text-field
                                v-model="florist.phone_number"
                                outlined
                                readonly
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
                                readonly
                            ></v-autocomplete>
                        </v-col>
                        <v-col cols="6">
                            <label>Business Name</label>
                            <v-text-field
                                v-model="florist.business_name"
                                outlined
                                readonly
                            ></v-text-field>
                        </v-col>
                        <v-col cols="6">
                            <label>Florist Image</label>
                            <div v-if="previewImage">
                                <img
                                    :src="previewImage"
                                    alt="Florist Image"
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
            florist: {
                id: null,
                name: "",
                email: "",
                phone_number: "",
                location_id: "",
                image: "",
            },
            locations: [],
            loadingLocation: false,
            previewImage: "",
        };
    },
    async mounted() {
        const floristId = this.$route.params.id;
        await this.fetchFloristDetails(floristId);
        await this.fetchLocations();
    },
    methods: {
        async fetchFloristDetails(id) {
            try {
                const response = await axiosInstance.get(`/florists/${id}`);
                this.florist = response.data;
                console.log(response.data);
                if (this.florist.image) {
                    // this.previewImage = `${this.florist.image}`;
                    this.previewImage = this.getImageUrl(this.florist.image);
                }
            } catch (error) {
                //   console.error("Error fetching florist details:", error);
                // Optional: Redirect back if florist not found
                // this.$router.push("/florists");
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
        getImageUrl(imagePath) {
            const baseUrl = "http://127.0.0.1:8000/storage/";
            return `${baseUrl}${imagePath}`;
        },

        // handleImageUpload(event) {
        //       const file = event.target.files[0];
        //       if (file) {
        //           const reader = new FileReader();
        //           reader.onload = (e) => {
        //               this.previewImage = e.target.result;
        //           };
        //           reader.readAsDataURL(file);
        //           this.selectedFile = file;
        //       }
        //   },
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
