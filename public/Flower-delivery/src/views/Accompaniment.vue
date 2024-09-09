<template>
    <v-card-text >
        <v-card-title class="bg-surface-light pt-2 d-flexjustify-space-between align-center "
         >
         <v-dialog max-width="500">
            <template v-slot:activator="{ props: activatorProps }">
              <v-btn
                v-bind="activatorProps"
                color="purple darken-2"
                text="Card Message"
                 class="elevation-2 rounded-btn white--text"
              ></v-btn>
            </template>
          
            <template v-slot:default="{ isActive }">
              <v-card title="Card Message">
                <v-text-field
                 max-width="300"
                 border="none"
               density="compact"
               label="Subject "
               variant="solo"
             ></v-text-field>
                    <v-container fluid>
                      <v-textarea
                        :model-value="value"
                        :rules="rules"
                        label="Text"
                        counter
                      ></v-textarea>
                    </v-container>
                    <v-text-field
                    max-width="200"
                    border="none"
                  density="compact"
                  label="From "
                  variant="solo"
                ></v-text-field>
          
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn text="Delete" color="error" ></v-btn>
                  <v-btn
                    text="Save"
                     color="success"
                    @click="isActive.value = false"
                  ></v-btn>
                </v-card-actions>
              </v-card>
            </template>
          </v-dialog>
            <v-btn 
            color="purple darken-3"
            text="Chocolate"
            padding="3"
            class="ml-6"
            ></v-btn>
            <v-btn 
           color="purple darken-3"
            text="Teddy bear"
            class="ml-6"
            ></v-btn>
            <v-btn 
          color="purple darken-3"
            text="Wine"
            class="ml-5"
            ></v-btn>

        </v-card-title>
       <v-row class="d-flex justify-center"  >
        <v-col cols="10" md="4"
       v-for="accompaniment in store":key= item>
    <v-card
      class="mx-auto"
      max-width="400"
      elevation="3"
      
    >
      <v-img
        class="align-end white--text"
        id="hoverable"
        height="400"
        padding="3"
        :src=accompaniment.image
        cover
      >
      </v-img>
      <v-card-subtitle class="bg-dark-opacity"   >
        <span class="me-1">{{accompaniment.productPopular}}</span>
  
        <v-icon
          color="error"
          icon="mdi-fire-circle"
          size="small"
        ></v-icon>
      </v-card-subtitle>
  
      <v-card-text  class="text-center py-3">
        <div class="font-weight-bold text-lg">{{accompaniment.name}}</div>
        <div class="my-2 text-subtitle-1">
         ${{ accompaniment.price }}
        </div>
        <div class="description">
          {{ accompaniment.description }}:<br>
      
        </div>
      </v-card-text>
      
      <v-card-text>
    </v-card-text>
      
      <v-card-actions>
        <v-btn  class="elevation-2 rounded-btn white--text"   text="Cart" color="purple darken-3" @click="addToCart(accompaniment)" block></v-btn>
<!--   
        <v-btn color="orange" text="Wishlist" @click="addToFavorites(accompaniment)"></v-btn> -->
      </v-card-actions>
    </v-card>
    </v-col>
    </v-row>
    </v-card-text>
   
  </template>
  <script>
//  import accompaniments from '@/store/modules/accompaniments';
import accompaniments from '@/store/modules/accompaniments';
import { mapActions,mapGetters } from 'vuex';
 export default{
  data(){
    return{
    accompaniments:[1,2],
    subtotal: 0,
   
    cartItems:[],
    favoriteItems:[],

  }
},
  methods:{
    ...mapActions([
      "addToCart",
      // "addToFavorites",
      "fetchAccompaniment"
    ]),
  },
  computed:{
    ...mapGetters({
  store:'store'

  }),
   
  },
  created(){
       this.fetchAccompaniment ()
    }
}
</script>
<style scoped>
#hoverable:hover{
  transform: translateY(-8px);
  box-shadow: 0px 20px 30px rgba(0, 0, 0, 0.1);
}
</style>