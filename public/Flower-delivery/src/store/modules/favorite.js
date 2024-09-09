const state={
    favoriteItems:[],
   

}
const getters={
   favorite:(state)=>state.favoriteItems,
  
}


const actions={
    addToFavorite(context,payload){
 const favorite=context.state.favoriteItems
        cart.push(payload)
        context.commit('UPDATE_FAVORITE',favorite)

    
    },
    // removeFromCart(context,payload){
    //     const cart=context.state.cartItems
    //     cart.pop(payload)
    //     context.commit('UPDATE_CART',cart)
        

        
    // }
}
const mutations={
    UPDATE_FAVORITE(state,payload){
        state.favoriteItems=payload;
    },
   
}
 const methods={
   
    addToFavorite(product){
        this.favoriteItems.push(product)
        
    }
}


export default{
    state,
    getters,
    actions,
    mutations
}