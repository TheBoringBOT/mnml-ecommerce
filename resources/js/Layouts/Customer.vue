<script>
import BreezeApplicationLogo from "@/Components/ApplicationLogo.vue";
import CustomerNav from "@/Components/Navigation/CustomerNav";
import { Link } from "@inertiajs/inertia-vue3";
import CartNotification from "@/components/Checkout/CartNotification";

export default {
    components: {
        Link,
        BreezeApplicationLogo,
        CartNotification,
        CustomerNav,
    },
};
</script>

<template>
    <div class="min-h-screen flex pt-6 sm:pt-0 w-full max-w-7xl mx-auto">

        <CustomerNav />

        <div class="mt-6 px-6 py-4 w-full">
            <slot />
        </div>
    </div>
</template>
