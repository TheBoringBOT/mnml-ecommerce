<template>
    <GuestLayout>
        <!--if statement checking if cart is empty-->
        <div v-if="cart.length !== 0" class="w-full">
            <div class="lg:w-2/3 w-full mx-auto mt-8 overflow-auto">
                <table class="table-auto w-full text-left whitespace-no-wrap">
                    <thead>
                        <tr>
                            <th
                                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200 rounded-tl rounded-bl"
                            >
                                Item
                            </th>
                            <th
                                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200"
                            >
                                Quantity
                            </th>
                            <th
                                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200"
                            >
                                Price
                            </th>
                            <th
                                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-200"
                            >
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in cart" :key="item.id">
                            <td class="p-4" v-text="item.name"></td>
                            <td class="p-4">
                                <div
                                        class="flex justify-center w-1/5 space-x-4"
                                >
                                    <button
                                            @click="
                                            $store.commit(
                                                'decreaseQuantity',
                                                index
                                            )
                                        "
                                    >
                                        <svg
                                                class="fill-current text-gray-600 w-3"
                                                viewBox="0 0 448 512"
                                        >
                                            <path
                                                    d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"
                                            />
                                        </svg>
                                    </button>

                                    <span v-text="item.quantity"></span>
                                    <button
                                            :class="[
                                            item.available === item.quantity &&
                                                'pointer-events-none opacity-50',
                                        ]"
                                            @click="
                                            $store.commit(
                                                'increaseQuantity',
                                                index,
                                                item
                                            )
                                        "
                                    >
                                        <svg
                                                class="fill-current text-gray-600 w-3"
                                                viewBox="0 0 448 512"
                                        >
                                            <path
                                                    d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"
                                            />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                            <td class="p-4" v-text="cartLineTotal(item)"></td>
                            <td class="w-10 text-right">
                                <button
                                        class="flex ml-auto text-sm text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded"
                                        @click="
                                        $store.commit('removeFromCart', index)
                                    "
                                >
                                    Remove
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-4 font-bold">Total Amount</td>
                            <td
                                    class="p-4 font-bold"
                                    v-text="cartQuantity"
                            ></td>
                            <td class="p-4 font-bold" v-text="cartTotal"></td>
                            <td class="w-10 text-right"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <form
                    @submit.prevent="processPayment"
                    :validation-schema="validationSchema"
            >
                <div class="lg:w-2/3 w-full mx-auto mt-8">
                    <div class="flex flex-wrap -mx-2 mt-8">
                        <div class="p-2 w-1/3">
                            <div class="relative">
                                <label
                                        for="first_name"
                                        class="leading-7 text-sm text-gray-600"
                                >First Name</label
                                >
                                <Field
                                        type="text"
                                        id="first_name"
                                        name="first_name"
                                        required
                                        class="w-full bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                        v-model="customer.first_name"
                                        :disabled="paymentProcessing"
                                />
                                <ErrorMessage name="first_name"/>
                            </div>
                        </div>
                        <div class="p-2 w-1/3">
                            <div class="relative">
                                <label
                                        for="last_name"
                                        class="leading-7 text-sm text-gray-600"
                                >Last Name</label
                                >
                                <Field
                                        required
                                        type="text"
                                        id="last_name"
                                        name="last_name"
                                        class="w-full bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                        v-model="customer.last_name"
                                        :disabled="paymentProcessing"
                                />
                                <ErrorMessage name="last_name"/>
                            </div>
                        </div>
                        <div class="p-2 w-1/3">
                            <div class="relative">
                                <label
                                        for="email"
                                        class="leading-7 text-sm text-gray-600"
                                >Email Address</label
                                >
                                <Field
                                        required
                                        type="email"
                                        id="email"
                                        name="email"
                                        class="w-full bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                        v-model="customer.email"
                                        :disabled="paymentProcessing"
                                />
                                <ErrorMessage name="email"/>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-2 mt-4">
                        <div class="p-2 w-1/3">
                            <div class="relative">
                                <label
                                        for="address"
                                        class="leading-7 text-sm text-gray-600"
                                >Street Address</label
                                >
                                <Field
                                        required
                                        type="text"
                                        id="address"
                                        name="address"
                                        class="w-full bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                        v-model="customer.address"
                                        :disabled="paymentProcessing"
                                />
                                <ErrorMessage name="address"/>
                            </div>
                        </div>
                        <div class="p-2 w-1/3">
                            <div class="relative">
                                <label
                                        for="city"
                                        class="leading-7 text-sm text-gray-600"
                                >City</label
                                >
                                <Field
                                        required
                                        type="text"
                                        id="city"
                                        name="city"
                                        class="w-full bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                        v-model="customer.city"
                                        :disabled="paymentProcessing"
                                />
                                <ErrorMessage name="city"/>
                            </div>
                        </div>
                        <div class="p-2 w-1/6">
                            <div class="relative">
                                <label
                                        for="state"
                                        class="leading-7 text-sm text-gray-600"
                                >State</label
                                >
                                <Field
                                        required
                                        type="text"
                                        id="state"
                                        name="state"
                                        class="w-full bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                        v-model="customer.state"
                                        :disabled="paymentProcessing"
                                />
                                <ErrorMessage name="state"/>
                            </div>
                        </div>
                        <div class="p-2 w-1/6">
                            <div class="relative">
                                <label
                                        for="zip_code"
                                        class="leading-7 text-sm text-gray-600"
                                >Zip Code</label
                                >
                                <Field
                                        required
                                        type="text"
                                        id="zip_code"
                                        name="zip_code"
                                        class="w-full bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                        v-model="customer.zip_code"
                                        :disabled="paymentProcessing"
                                />
                                <ErrorMessage name="zip_code"/>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-2 mt-4">
                        <div class="p-2 w-full">
                            <div class="relative">
                                <label
                                        for="card-element"
                                        class="leading-7 text-sm text-gray-600"
                                >Credit Card Info</label
                                >
                                <div id="card-element"></div>
                            </div>
                        </div>
                    </div>
                    <div class="p-2 w-full">
                        <button
                                class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"
                                type="submit"
                                v-text="
                                paymentProcessing ? 'Processing...' : 'Pay Now'
                            "
                        ></button>
                    </div>
                </div>
            </form>
        </div>
        <!--TODO add cart is empty element-->
        <div v-else>your cart is empty</div>
    </GuestLayout>
</template>
<script>
import GuestLayout from "@/Layouts/Guest";
import {loadStripe} from "@stripe/stripe-js";
import {Field, Form, ErrorMessage} from "vee-validate";
import * as yup from "yup";

export default {
    components: {
        Field,
        Form,
        ErrorMessage,
        GuestLayout,
    },
    data() {
        //form validation using yup
        const validationSchema = yup.object({
            email: yup.string().required().email(),
            first_name: yup.string().required(),
            last_name: yup.string().required(),
            address: yup.string().required(),
            city: yup.string().required(),
            state: yup.string().required(),
            zip_code: yup.string().required(),
        });
        return {
            validationSchema,
            errors: [],
            stripe: {},
            cardElement: {},
            customer: {
                first_name: "",
                last_name: "",
                email: "",
                address: "",
                city: "",
                state: "",
                zip_code: "",
            },
            paymentProcessing: false,
        };
    },
    async mounted() {
        //  if the cart has items then mount stripe
        if (this.$store.state.cart.length !== 0) {
            this.stripe = await loadStripe(process.env.MIX_STRIPE_KEY);

            const elements = this.stripe.elements();
            this.cardElement = elements.create("card", {
                classes: {
                    base:
                        "bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 p-3 leading-8 transition-colors duration-200 ease-in-out",
                },
            });

            this.cardElement.mount("#card-element");
        }
    },
    methods: {
        // return cart amount
        cartLineTotal(item) {
            let amount = item.price * item.quantity;
            amount = amount / 100;

            return amount.toLocaleString("en-US", {
                style: "currency",
                currency: "USD",
            });
        },

        // process the payment
        async processPayment() {
            this.paymentProcessing = true;

            const {
                paymentMethod,
                error,
            } = await this.stripe.createPaymentMethod(
                "card",
                this.cardElement,
                {
                    billing_details: {
                        name:
                        this.customer.first_name +
                        " " +
                        this.customer.last_name,
                        email: this.customer.email,
                        address: {
                            line1: this.customer.address,
                            city: this.customer.city,
                            state: this.customer.state,
                            postal_code: this.customer.zip_code,
                        },
                    },
                }
            );

            //TODO change the error handling better for customer
            //TODO validate inputs before sending to controller
            if (error) {
                this.paymentProcessing = false;
                console.error(error);
            } else {
                console.log(paymentMethod);
                this.customer.payment_method_id = paymentMethod.id;
                this.customer.amount = this.$store.state.cart.reduce(
                    (acc, item) => acc + item.price * item.quantity,
                    0
                );
                this.customer.cart = JSON.stringify(this.$store.state.cart);

                axios
                    .post("/api/purchase", this.customer)
                    .then((response) => {
                        this.paymentProcessing = false;

                        //update vuex store
                        this.$store.commit("updateOrder", response.data);
                        this.$store.dispatch("clearCart");

                        // Redirect to order summary
                        this.$inertia.get("/summary");
                    })
                    .catch((error) => {
                        this.paymentProcessing = false;
                        console.error(error);
                    });
            }
        },
    },
    computed: {
        cart() {
            return this.$store.state.cart;
        },
        cartQuantity() {
            return this.$store.state.cart.reduce(
                (acc, item) => acc + item.quantity,
                0
            );
        },
        cartTotal() {
            let amount = this.$store.state.cart.reduce(
                (acc, item) => acc + item.price * item.quantity,
                0
            );
            amount = amount / 100;

            return amount.toLocaleString("en-US", {
                style: "currency",
                currency: "USD",
            });
        },
    },
};
</script>
