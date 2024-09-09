<template>
      <v-row>
        <v-col cols="4" md="4"
        v-for="florist in shop":key=florist>

        <v-card 
          class="mx-auto"
          max-width="400"
        >
          <v-img
            class="align-end text-white"
            height="300"
            :src=florist.image
            cover
          >
          </v-img>
         
          <v-card-title class="pt-5">
           {{ florist.name }}
          </v-card-title> 
           
        
          <v-card-text>
            <v-icon left>mdi-account</v-icon>  {{ florist.business_name }}
            <v-col>
                <v-icon left>mdi-map-marker</v-icon> 
              {{ florist.location }}
              </v-col>
              <v-col>
               <a href="https://wa.me/708729680 ">
                
                <v-icon>mdi-whatsapp</v-icon>
                 Whatsapp
               </a>

              </v-col>
              <v-col>
                <v-icon left>mdi-map-marker</v-icon> 
              {{ florist.phone }}
              </v-col>
          </v-card-text>
       
            <v-dialog max-width="auto">
                <template v-slot:activator="{ props: activatorProps }">
                <v-btn
                    v-bind="activatorProps"
                    color="surface-variant"
                    text="Review"
                    variant="flat"
                ></v-btn>
                </template>
            
                <template v-slot:default="{ isActive }">
                <v-card title="Report">
                    <v-card-text>
                        <!-- <v-list-subheader>REPORTS</v-list-subheader> -->
                        <v-list class="d-flex-">
                            <v-col>
                                <v-icon left>mdi-account</v-icon> {{ florist.customer }}
                              </v-col>
                              <v-col>
                                <v-icon left>mdi-gift</v-icon> {{ florist.product }}
                              </v-col>
                              <v-col>
                                <v-icon left>mdi-star</v-icon>{{ florist.rating }}
                              </v-col>
                              <v-col>
                                <v-icon center>mdi-message-text</v-icon> {{ florist.review }}
                              </v-col>
                        </v-list>
                            
                    </v-card-text>
            
                    <v-card-actions>
                    <v-spacer></v-spacer>
            
                    <v-btn
                     color="#6A1B9A"
                        text="Close "
                        @click="isActive.value = false"
                    ></v-btn>
                    </v-card-actions>
                </v-card>
                </template>
            </v-dialog>
            </v-card>
            </v-col>
            </v-row>

           
  </template>
  <script>

  import { mapActions, mapGetters } from 'vuex';
  export default{
    data(){
      return{
        florists:[1,2],

      }
    },
    methods:{
      ...mapActions(
        [
          "fetchFlorist"
        ]
      )
    },
    computed:{
      ...mapGetters({
        shop:'shop'
      })
    },
    created() {
      this.fetchFlorist();
    }
  }
</script>
