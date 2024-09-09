import Florists from "@/views/Florist.vue"
import axios from 'axios'
const state={
    shopDetails:[ ],
    allFlorists:[]
  }
  const getters={
  shop:(state)=>state.allFlorists
  }
  const actions={
    async fetchFlorist({commit}){
      try{
         const response =await axios.get(
            "http://127.0.0.1:8000/api/florists"
         );
         commit("SET_ITEMS",response.data);
         console.log("data",response.data)
      }catch (error){
          alert(error);
          console.error(error);
      }
    }
  }
  const mutations={
    SET_ITEMS(state,allFlorists){
        state.allFlorists=allFlorists
    }
  }
  
  export default{
    state,
    getters,
    actions,
    mutations
  }