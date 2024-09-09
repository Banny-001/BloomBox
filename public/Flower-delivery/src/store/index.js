import Vuex from 'vuex';
import products from './modules/products';
import cart from './modules/cart';
// import favorite from './modules/favorite';
import florist from './modules/florists';
import accompaniments from './modules/accompaniments';
import favorite from './modules/favorite';
import {createStore} from"vuex";
import axiosClient from '@/axios';

export default new Vuex.Store({
    state:{
        user:{
            data:{},
            token: sessionStorage.getItem("TOKEN"),
        },
    },
    getters:{},
    actions:{
        //register 
        // register({commit},user){
        //     return axiosClient.post('/register',user.value)
        //    .then(({data})=>{
        //       commit('setUser',data);
        //       return data;
        //    })
        // },
        //login
        // login({commit},user){
        //    return axiosClient.post('/account',user)
        //    .then(({data})=>{
        //       commit('setUser',data);
        //       console.log('Response: ', resp);
        //       return data;
        //    })
        //  },
         
    },
  

    // mutations:{
    //     logout:(state)=>{
    //         state.user.token=null;
    //         state.user.data={};
    //     },
    //     setUser:(state,userData)=>{
    //         state.user.token=userData.token;
    //         state.user.data=userData.user;
    //         //save token in sessions
    //         sessionStorage.setItem('TOKEN',userData.token);
    //     }
    // },
    modules:{
        products,
        accompaniments,
        cart,
        florist,
        favorite
      
    }
})