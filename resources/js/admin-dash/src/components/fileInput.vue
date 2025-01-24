<template>
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
</template>

<script>
export default {
    props: {
        value: File, // For v-model two-way binding
        initialImage: { // URL of the existing image
            type: String,
            default: "",
           
        },
    },
    data() {
        return {
            selectedFile: null, // Stores the selected file
            previewImage: this.initialImage, // Initialize with the existing image
        };
    },
    watch: {
        selectedFile(newFile) {
            this.$emit("input", newFile); // Emit the selected file to the parent
        },
    },
    methods: {
        handleImageUpload(event) {
            const file = event.target.files[0];
            if (file) {
                this.previewImage = URL.createObjectURL(file); // Preview image before upload
            } else {
                this.previewImage = "";
            }
        },
    },
};
</script>
