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
                    <CheckoutForm :cartTotal="cartTotal"/>
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
        <EmptyCartNotification v-else/>
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
import CheckoutTotal from "@/components/Checkout/CheckoutTotal";
import EmptyCartNotification from "@/components/Checkout/EmptyCartNotification";

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
        EmptyCartNotification,
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
