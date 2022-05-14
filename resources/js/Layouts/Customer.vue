<template>
    <div class="min-h-screen flex pt-6 sm:pt-0 w-full mx-auto text-black">
        <CustomerNav/>

        <div class="py-24 w-full">
            <slot/>
        </div>
    </div>
</template>

<script>
import BreezeApplicationLogo from "@/Components/ApplicationLogo.vue";
import CustomerNav from "@/Components/Navigation/CustomerNav";
import {Link} from "@inertiajs/inertia-vue3";
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