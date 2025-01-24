<template>
    <v-autocomplete
              :items="item"
              item-title="business_name"
              append-inner-icon="mdi-microphone"
              class="justify-start"
              density="comfortable"
              placeholder="Search florists"
              prepend-inner-icon="mdi-magnify"
              style="max-width: 350px"
              theme="light"
              variant="solo"
              auto-select-first
              rounded
            ></v-autocomplete>
</template>
<script>

</script>