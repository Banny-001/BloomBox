<template>
    <form>
        <h1>Shipping Address</h1>
        <v-row class="align-items=center">
            <v-col>
        <v-text-field label="Search your location"
        color="surface-light"
         max-width="auto"
         border="none" 
         append-inner-icon="mdi-magnify"
         density="compact">
        </v-text-field>
        </v-col>
        <v-col>
        <v-btn width="100" height="60">Search</v-btn>
       </v-col>
        </v-row>
        <!-- <v-text-field label=" First Name"> </v-text-field>
        <v-text-field label=" Last Name"> </v-text-field>
        <v-text-field label=" Email"> </v-text-field>
        <v-text-field label=" Address"> </v-text-field>
        <v-text-field label=" Additional Information"> </v-text-field>
        <v-text-field label=" Region"> </v-text-field>
        <v-text-field label=" City"> </v-text-field> -->
        <v-checkbox label="Set Default Address"></v-checkbox>
        <v-btn class="save-btn"color="success" block>Save</v-btn><br>
       <v-btn  class="continue-btn" color="primary" 
        to="/order" block >Order summary</v-btn>
       
     
      </form>
      
    
</template>
