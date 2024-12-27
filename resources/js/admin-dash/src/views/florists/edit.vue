<template>
  <v-card class="mx-auto pt-4 rounded-xl" width="1400" color="primary" outlined>
    <template v-slot:title>
      <span class="font-weight-bold text-h5">Create Florists</span>
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
    
    </v-card-text>
</template>
