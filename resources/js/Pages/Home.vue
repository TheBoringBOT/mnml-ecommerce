<template>
    <GuestLayout> </GuestLayout>
</template>
<script>
import GuestLayout from "@/Layouts/Customer";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { useStore } from "vuex";

export default {
    components: { Head, Link, GuestLayout },
    // props: ["products"],
    methods: {
        formatCurrency(amount) {
            amount = amount / 100;
            return amount.toLocaleString("en-US", {
                style: "currency",
                currency: "USD",
            });
        },
    },
    computed: {
        products() {
            console.log(useStore().state);
            return useStore().state.products;
        },
    },
};
</script>
