<template>
    <Head>
        <title>Checkout</title>
        <meta name="description" content="Checkout at Sirène"/>
    </Head>
    <!-- demo notification -->
    <div
            :class="showNotice ? 'block' : 'hidden'"
            class="fixed z-50 bottom-0 right-0 lg:bottom-5 lg:right-5 bg-red-500 text-sm font-medium text-white text-center lg:text-left text-medium w-full lg:max-w-[400px]"
    >
        <div class="p-5">
            <span
                    @click="closeNotice"
                    class="cursor-pointer z-10 absolute top-3 right-3 opacity-50 hover:opacity-100"
            >
                X
            </span>

            <p class="font-semibold">Test payment with:</p>
            <div class="flex flex-col space-y-1 mt-2">
                <p>Number: 4242424242424242</p>
                <p>CVC: Any 3 digits</p>
                <p>Date: Any future date</p>
            </div>
        </div>
    </div>
    <div class="w-full mx-auto bg-white">
        <div
                class="flex justify-between items-center bg-white h-16 lg:hidden w-full px-5"
        >
            <BackButton class="relative m-0 mx-0 p-0"/>

            <h1 class="text-md font-medium">Checkout</h1>
        </div>
        <div
                v-if="cart.length"
                class="mx-auto w-full grid grid-cols-1 lg:grid-cols-4 min-h-screen"
        >
            <!-- customer details / payment details-->
            <div
                    class="lg:col-span-2 px-5 lg:px-10 relative row-start-2 lg:row-start-1"
            >
                <div class="max-w-[500px] mx-auto lg:max-w-full">
                    <div
                            class="max-w-[500px] flex flex-col ml-auto lg:mr-8 pt-8 lg:pt-0"
                    >
                        <div class="hidden lg:flex">
                            <ContentSpacerTop/>
                            <BackButton/>
                        </div>
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
            </div>

            <!-- checkout items + total -->
            <div
                    class="bg-neutral-50 border-b border-t lg:border-l border-gray-200 w-full mx-auto overflow-auto lg:col-span-2 px-5 lg:px-10 text-gray-900 font-medium h-fit lg:h-full"
            >
                <div class="max-w-[500px] mx-auto lg:max-w-full">
                    <ContentSpacerTop class="hidden lg:block"/>
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
    data() {
        return {
            showNotice: true,
        };
    },

    methods: {
        closeNotice() {
            this.showNotice = !this.showNotice;
        },
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
