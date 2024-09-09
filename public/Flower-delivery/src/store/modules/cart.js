const state = {
    // cartItems:[],
    // totalCartAmount:0,
    cartItems: JSON.parse(localStorage.getItem("cartItems")) || [],
    totalCartAmount: JSON.parse(localStorage.getItem("totalCartAmount")) || 0,
};
const getters = {
    cart: (state) => state.cartItems,
    countcartitems: (state) => state.cartItems.length,
    totalCartAmount: (state) => state.totalCartAmount,
    subTotal: (state) =>
        state.cartItems.reduce((acc, item) => acc + item.price * item.quantity, 0),
};

const actions = {
    addToCart(context, payload) {
        const cartItems = context.state.cartItems;

        let index = cartItems.findIndex((product) => product.id === payload.id);
        if (index !== -1) {
            cartItems[index].quantity += 1;
            alert("Product quantity increased!");
        } else {
            payload.quantity = 1;
            cartItems.push(payload);
            alert("product added to cart!");
        }
        context.commit("UPDATE_TOTAL_CART_AMOUNT");
        context.commit("SAVE_CART_TO_STORAGE");
        //cartItems.push(payload)
        // console.log(cartItems)
    },

    incrementQ(context, payload) {
        const cartItems = context.state.cartItems;
        let index = cartItems.findIndex((product) => product.id === payload.id);
        if (index !== -1) {
            cartItems[index].quantity += 1;
            alert("Product quantity increased!");
        } else {
            // product.quantity += 1
            // cartItems.push(product)
            return "product not found";
        }

        context.commit("UPDATE_TOTAL_CART_AMOUNT");
        context.commit("SAVE_CART_TO_STORAGE");
    },

    decrementQ(context, payload) {
        const cartItems = context.state.cartItems;
        let index = cartItems.findIndex((product) => product.id === payload.id);
        if (index !== -1) {
            cartItems[index].quantity -= 1;
            alert("Product quantity decreased!");
        } else {
            // payload.quantity -= 1
            // cartItems.push(payload)
            alert("product not found");
        }
        context.commit("UPDATE_TOTAL_CART_AMOUNT");
        context.commit("SAVE_CART_TO_STORAGE");
    },

    removeFromCart(context, payload) {
        let cart = context.state.cartItems;
        console.log("cart items: ", cart);
        console.log("Current: ", payload);

        let totalCartAmount = state.totalCartAmount;

        for (let item of cart) {
            console.log(item.id);
            if (item.id === payload.id) {
                totalCartAmount -= payload.productAmount;
                context.commit("UPDATE_TOTAL_CART_AMOUNT", Number(totalCartAmount));
                cart.splice(cart.indexOf(item), 1);
                console.log("Updated: ", cart);
                console.log("Amount: ", Number(totalCartAmount));
                context.commit("UPDATE_TOTAL_CART_AMOUNT", Number(totalCartAmount));
                context.commit("SAVE_CART_TO_STORAGE");
            }
        }
        // cart.pop(payload)
        // context.commit('UPDATE_CART',cart)

        // var total=context.state.totalCartAmount
        // total-=payload.itemPrice
        // context.commit('UPDATE_TOTAL_CART_AMOUNT', total)
    },
    increaseQuantity({ commit }, product) {
        commit("INCREASE_QUANTITY", product);
    },
    decreaseQuantity({ commit }, product) {
        commit("DECREASE_QUANTITY", product);
    },
};
const mutations = {
    // ADD_TO_CART(state,product){
    //     state.cartItems.push({

    //     })
    // },
    // UPDATE_CART(state,payload){
    //     state.cartItems=payload;
    // },
    UPDATE_TOTAL_CART_AMOUNT(state, payload) {
        state.totalCartAmount = state.cartItems.reduce(
            (sum, item) => sum + item.price * item.quantity,
            0
        );
        // state.totalCartAmount=payload;
    },
    SAVE_CART_TO_STORAGE(state) {
        localStorage.setItem("cartItems", JSON.stringify(state.cartItems));
        localStorage.setItem(
            "totalCartAmount",
            JSON.stringify(state.totalCartAmount)
        );
    },
    // INCREASE_QUANTITY(state, product) {
    //     state.cartItems[product].quantity++;
    //   },
    // DECREASE_QUANTITY(state, index) {
    //     if (state.cartItems[index].quantity > 1) {
    //       state.cartItems[index].quantity--;
    //     }
    // },
};
const methods = {
    calculateTotal(itemPrice) {
        this.totalCartAmount += itemPrice;
    },
    addToCart(product) {
        this.$store.cartItems.push(product);

        this.calculateTotal(product.itemPrice);
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
    methods,
};
