// vuex store
import axios from "axios/index";

export default {
    modules: {},
    state() {
        return {
            products: [],
            categories: [],
            cart: [],
            order: {},
            sort: {sort: "Default", order: null, category: "All"},
        };
    },
    mutations: {
        updateCategories(state, categories) {
            state.categories = categories;
        },
        updateProducts(state, products) {
            state.products = products;
        },
        sortProducts(state, sort) {
            state.products = _.orderBy(state.products, sort[0], sort[1]);
            state.sort = {sort: sort[0], order: sort[1], category: "All"};
        },

        addToCart(state, {product, quantity}) {
            console.table(quantity);
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
                // if customer is adding item with more then 1 quantity
                // then add this to current number in cart
                quantity !== 1
                    ? (state.cart[productIdInCartIndex].quantity =
                    state.cart[productIdInCartIndex].quantity + quantity)
                    : state.cart[productIdInCartIndex].quantity++;
                return;
            }

            product.quantity = quantity;
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
        initialiseStore({commit}) {
            // check if any store data is stored in local storage
            if (localStorage.getItem("inCart")) {
                // Update cart if local storage has any cart data
                commit(
                    "updateCart",
                    JSON.parse(localStorage.getItem("inCart"))
                );
            }

            // get the products
            return axios
                .get("/api/products")
                .then((response) => {
                    console.table(response.data);
                    commit("updateProducts", response.data[0].products);
                    commit("updateCategories", response.data[0].categories);
                })
                .catch((error) => console.log(error));
        },

        clearCart({commit}) {
            commit("updateCart", []);
        },
    },
};
