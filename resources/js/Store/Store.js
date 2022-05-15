// vuex store
import axios from "axios/index";

export default {
    modules: {},
    state() {
        return {
            products: [],
            cart: [],
            order: {},
        };
    },
    mutations: {
        updateProducts(state, products) {
            state.products = products;
        },
        addToCart(state, product) {
            console.table(product);
            // get current id of item in cart
            const productAvailability = product.available;

            let productIdInCartIndex = state.cart.findIndex(
                (item) => item.slug === product.slug
            );

            // check if product if exists in cart and add quantity
            if (productIdInCartIndex !== -1) {
                // If the amount in cart is equal to the availability of the product then don't add more
                // TODO  add toast to show no more available
                if (
                    productAvailability ===
                    state.cart[productIdInCartIndex].quantity
                ) {
                    return;
                }
                state.cart[productIdInCartIndex].quantity++;
                return;
            }

            product.quantity = 1;
            try {
                state.cart.push(product);
            } catch (err) {
                console.log(err);
            }
        },

        increaseQuantity(state, product) {
            state.cart[product].quantity++;
        },
        decreaseQuantity(state, product) {
            //removes product via splice if only one quantity
            if (state.cart[product].quantity === 1) {
                state.cart.splice(product, 1);
                return;
            }
            state.cart[product].quantity--;
        },

        removeFromCart(state, store) {
            state.cart.splice(store, 1);
        },
        updateOrder(state, order) {
            state.order = order;
        },
        updateCart(state, cart) {
            state.cart = cart;
        },
    },
    actions: {
        initialiseStore({ commit }) {
            // check if any store data is stored in local storage
            if (localStorage.getItem("store")) {
                // Update cart if local storage has any cart data
                commit("updateCart", JSON.parse(localStorage.getItem("store")));
            }
            // get the products
            return axios
                .get("/api/products")
                .then((response) => {
                    commit("updateProducts", response.data);
                })
                .catch((error) => console.log(error));
        },
        // getProducts({commit}) {
        //     //fetch the product from the api api/products
        //     //TODO: update catch error with something better for customer
        //     axios
        //         .get("/api/products")
        //         .then((response) => {
        //             commit("updateProducts", response.data);
        //         })
        //         .catch((error) => console.log(error));
        // },
        // clear/empty out the cart
        clearCart({ commit }) {
            commit("updateCart", []);
        },
    },
};
