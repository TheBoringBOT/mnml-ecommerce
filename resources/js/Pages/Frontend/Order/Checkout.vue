<template>
    <!-- TODO: clean up this file into seperate components -->
    <Head>
        <title>Checkout</title>
        <meta name="description" content="Checkout at Sirène"/>
    </Head>
    <div class="w-full mx-auto bg-white">
        <div
                v-if="cart.length"
                class="max-w-[600px] mx-auto lg:max-w-full w-full grid grid-cols-1 lg:grid-cols-4 min-h-screen"
        >
            <!-- customer details / payment details-->
            <div
                    class="lg:col-span-2 px-10 relative row-start-2 lg:row-start-1"
            >
                <ContentSpacerTop/>
                <div class="max-w-[500px] flex flex-col ml-auto mr-8">
                    <BackButton/>
                    <div class="hidden lg:block pb-5">
                        <!--<ApplicationLogo />-->
                        <h1 class="text-lg font-semibold">Checkout</h1>
                    </div>
                    <!--<h3 class="text-2xl font-semibold text-black">Payment Info</h3>-->
                    <CheckoutForm
                            :cartTotal="cartTotal"
                            :customer="customer"
                            :paymentProcessing="paymentProcessing"
                    />
                    <hr class="w-full bg-gray-200 mt-5 mb-3"/>
                    <CheckoutFooter/>
                </div>
            </div>

            <!-- checkout items + total -->
            <div
                    class="lg:bg-neutral-50 border-b lg:border-l border-gray-200 w-full mx-auto overflow-auto lg:col-span-2 px-10 text-gray-900 font-medium h-fit lg:h-full"
            >
                <ContentSpacerTop/>
                <div class="lg:max-w-[400px] flex lg:mr-auto lg:ml-8">
                    <div class="flex flex-col w-full">
                        <CheckoutItems
                                :cart="cart"
                                :cartLineTotal="cartLineTotal"
                        />

                        <!-- totals + shipping -->
                        <CheckoutTotal :cartTotal="cartTotal"/>
                    </div>
                </div>
            </div>
        </div>

        <!--TODO add cart is empty element-->
        <div v-else>your cart is empty</div>
    </div>
</template>
<script>
import GuestLayout from "@/Layouts/GuestLayout";
import ContentWrapper from "@/Layouts/ContentWrapper";
import ContentSpacerTop from "@/Layouts/ContentSpacerTop";
import ApplicationLogo from "@/components/ApplicationLogo";
import BackButton from "@/components/Checkout/BackButton";
import CheckoutForm from "@/components/Checkout/Form";
import CheckoutItems from "@/components/Checkout/Items";
import CheckoutFooter from "@/components/Checkout/Footer";
import {Head, Link} from "@inertiajs/inertia-vue3";
import {loadStripe} from "@stripe/stripe-js";
import CheckoutTotal from "@/components/Checkout/CheckoutTotal";

export default {
    components: {
        CheckoutTotal,
        Link,
        Head,
        GuestLayout,
        ContentWrapper,
        ContentSpacerTop,
        CheckoutForm,
        CheckoutItems,
        ApplicationLogo,
        CheckoutFooter,
        BackButton,
    },
    data() {
        return {
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
                        "bg-white rounded border border-gray-300 shadow-sm focus:border-indigo-500 text-base outline-none text-gray-700 p-3 leading-8 transition-colors duration-200 ease-in-out",
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

<style scoped>
@media screen and (min-width: 1024px) {
    .bg-half:before {
        content: "";
        display: block;
        width: 300%;
        position: absolute;
        top: 0;
        left: -100%;
        bottom: 0;
        background: #fafafa;
        z-index: -1;
        -webkit-box-shadow: 0 -1px 0 #e1e1e1 inset;
        box-shadow: 0 -1px 0 #e1e1e1 inset;
    }
}
</style>
