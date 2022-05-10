<template>
    <Link
            class="inline-flex items-center bg-gray-200 border-0 py-1 px-3 focus:outline-none hover:bg-gray-300 rounded text-base mt-4 md:mt-0"
            href="/checkout"
    >
        Checkout<span
        class="inline-block ml-1"
        v-text="'(' + this.$store.state.cart.length + ' items)'"
></span>
    </Link>
</template>

<script>
import {Head, Link} from "@inertiajs/inertia-vue3";

export default {
    components: {
        Head,
        Link,
    },
};
</script>
