<template>
    <CustomerNav/>
    <main
            :class="bgGrey && 'bg-off-white'"
            class="pt-6 w-full mx-auto text-black"
    >
        <slot/>
    </main>
    <Footer/>
</template>

<script>
import BreezeApplicationLogo from "@/Components/ApplicationLogo.vue";
import CustomerNav from "@/Components/Navigation/CustomerNav";
import Footer from "@/Components/Footer";
import {Link} from "@inertiajs/inertia-vue3";

export default {
    props: ["bgGrey"],
    components: {
        Link,
        BreezeApplicationLogo,
        CustomerNav,
        Footer,
    },
};
</script>
