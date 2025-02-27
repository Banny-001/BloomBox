<template>
    <v-icon
        size="large"
        color="error"
        @click="confirmDelete"
    >
        mdi-delete
    </v-icon>

    <!-- Delete Confirmation Dialog -->
    <v-dialog v-model="dialog" max-width="400px">
        <v-card>
            <v-card-title class="headline">Confirm Delete</v-card-title>
            <v-card-text>
                Are you sure you want to delete this item?
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="error" text @click="deleteItem">Yes</v-btn>
                <v-btn text @click="dialog = false">Cancel</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script setup>
import { ref } from "vue";

const props = defineProps({
    item: Object, // The item to delete
    deleteAction: Function, // The function to call for deleting
});

const dialog = ref(false);

const confirmDelete = () => {
    dialog.value = true;
};

const deleteItem = () => {
    if (props.deleteAction && props.item) {
        props.deleteAction(props.item);
    }
    dialog.value = false;
};
</script>

<style scoped>
/* Optional styling */
</style>
