<template>
    <v-card class="mx-auto pt-4 rounded-xl" prepend-icon="$fa:fas fa-list" subtitle="Create Products" width="1400"
        color="primary" outlined>
        <template v-slot:title>
            <span class="font-weight-bold text-h5"> Create Products</span>
            <div class="d-flex justify-end">
                <v-btn size="large" color="secondary" class="rounded-xl mx-2">Save</v-btn>
                <v-btn size="large" color="secondary" class="rounded-xl mx-2">Back</v-btn>
            </div>
        </template>

        <v-card-text class="bg-surface-light pt-6 mt-4 rounded-xl">
            <!-- 'florist_id',
            'image',
            'name',
            'price',
            'description',
            'popular_id',
            'category_id',
            'special_occassion_id' -->
               
                <v-col cols="12" sm="8" md="6">
                 <label>Name</label>
                    <v-text-field
                      dense
                      clearable
                    ></v-text-field>
                    <v-spacer></v-spacer>
                    <label>Price</label>
                    <v-text-field
                      dense
                      clearable
                    ></v-text-field>
                    <v-spacer></v-spacer>
                    <label>Description</label>
                    <v-text-field
                      dense
                      clearable
                    ></v-text-field>
                    <v-spacer></v-spacer>
                    <label>Florist</label>
                    <v-select  :items="['']"  max-width="600"></v-select>
                    <v-spacer></v-spacer>
                    <label>Popular</label>
                    <v-select  :items="['']"  max-width="600"></v-select>
                    <v-spacer></v-spacer>
                    <label>Category</label>
                    <v-select  :items="['']"  max-width="600"></v-select>
                    <v-spacer></v-spacer>
                    <label>Special Occassion</label>
                    <v-select  :items="['']"  max-width="600"></v-select>
                    <v-spacer></v-spacer>
                    <v-file-input label="Image"></v-file-input>
                  </v-col>
                
               
                
         
        </v-card-text>
    </v-card>
</template>
