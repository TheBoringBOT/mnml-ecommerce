<template>
    <div class="pt-6 sm:pt-0 w-full mx-auto text-black">
        <CustomerNav/>

        <div class="w-full min-h-[calc(100vh_-_4rem)]">
            <slot/>
        </div>
        <Footer/>
    </div>
</template>

<script>
import BreezeApplicationLogo from "@/Components/ApplicationLogo.vue";
import CustomerNav from "@/Components/Navigation/CustomerNav";
import Footer from "@/Components/Footer";
import {Link} from "@inertiajs/inertia-vue3";

export default {
    components: {
        Link,
        BreezeApplicationLogo,
        CustomerNav,
        Footer,
    },
};
</script>
