<template>
    <Link
            :href="`/product/${product.slug}`"
            class="flex flex-col space-y-3 md:space-y-5"
    >
        <figure class="flex relative pt-[100%] overflow-hidden">
            <img
                    class="object-cover grow absolute top-0 left-0 h-full w-full"
                    :src="`${product.images.length && product.images[0].image_url}`"
                    :alt="product.name"
            />
        </figure>
        <div class="flex flex-col md:flex-row justify-between items-center">
            <span
                    class="font-medium capitalize text-xs md:text-base truncate lg:max-w-[70%]"
                    v-text="product.name"
            ></span>
            <span
                    class="text-grey text-xs md:text-base truncate max-w-[99%]"
                    v-text="formatCurrency(product.price)"
            ></span>
        </div>
    </Link>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";

export default {
    props: ["product"],
    components: {
        Link,
    },
};
</script>

<style scoped>
/* basic hover scale effect for image */
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
