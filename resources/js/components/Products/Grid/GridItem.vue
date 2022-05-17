<template>
    <Link :href="/product/ + product.slug" class="flex flex-col space-y-5">
        <figure class="flex relative pt-[100%] overflow-hidden">
            <img
                class="grow absolute top-0 left-0 h-full w-full"
                src="https://indigo.qodeinteractive.com/wp-content/uploads/2017/01/home-4-shop-img-6-768x768.jpg"
                alt=""
            />
        </figure>
        <div class="flex justify-between items-center">
            <span class="font-semibold uppercase" v-text="product.name"></span>
            <span
                class="text-grey"
                v-text="formatCurrency(product.price)"
            ></span>
        </div>
    </Link>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    props: ["product"],
    components: {
        Link,
    },
    methods: {
        formatCurrency(amount) {
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
.grow {
    transition: all 0.3s ease-in-out;
    will-change: transform;
    transform: translateZ(0);
    backface-visibility: hidden;
}

.grow:hover {
    transform: scale(1.05);
}
</style>
