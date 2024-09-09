import Accompaniment from "@/views/Accompaniment.vue"
import axios from 'axios'

const state={
  storeDetails:[ ],
  allItems:[]
}
const getters={
store:(state)=>state.allItems
}
const actions={
   async fetchAccompaniment({commit}){
    try{
         const response =await axios.get(
          "http://127.0.0.1:8000/api/accompaniments"
         );
         commit('SET_ITEMS',response.data);
         console.log('data:',response.data);
    }catch (error){
        alert(error);
        console.error(error);
    }
   }
}
const mutations={
  SET_ITEMS(state,allItems){
      state.allItems=allItems
  }
}

export default{
  state,
  getters,
  actions,
  mutations
}