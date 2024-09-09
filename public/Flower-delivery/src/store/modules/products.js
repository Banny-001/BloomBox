import Products from '@/views/Products.vue'
import axios from 'axios'
const state={
    stockDetails:[ ],
    allProducts:[]
}
const getters={
  stock:(state)=>state.allProducts
}
const actions={

  // products:function(){
  //   let params=Object.assign({},
  //     this.products )
  //     axios.post('api/products',params)
  //     .then(function(response){
  //       console.log(response.data)
  //     })
  //     .catch(function(error){
  //       console.log(error)
  //     })
  // }
   async fetchProduct({commit}){
    try{
       const response =await axios.get(
       "http://127.0.0.1:8000/api/products"
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
    SET_ITEMS(state,allProducts){
        state.allProducts=allProducts
    }
}

export default{
    state,
    getters,
    actions,
    mutations
}