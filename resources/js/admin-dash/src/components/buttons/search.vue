<template>
    <v-autocomplete
        v-model="searchQuery"
        :items="filteredItems"
        item-title="name"
        append-inner-icon="mdi-microphone"
        class="justify-start"
        density="comfortable"
        placeholder="Search users"
        prepend-inner-icon="mdi-magnify"
        style="max-width: 350px"
        theme="light"
        variant="solo"
        auto-select-first
        rounded
      @update:modelValue="emitSearch"
    ></v-autocomplete>
</template>

<script setup>
import { ref, computed, defineProps, defineEmits } from "vue";

const props = defineProps({
    items: {
        type: Array,
        required: true,
    },
});

const searchQuery = ref("");
const emit = defineEmits(["update:filteredItems"]);

const filteredItems = computed(() => {
    return props.items.filter((item) =>
        item.name.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
});

const emitSearch = () => {
    emit("update:filteredItems", filteredItems.value);
};
</script>

<style scoped>

</style>
