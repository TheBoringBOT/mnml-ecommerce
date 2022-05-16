<template>
    <div class="flex flex-col my-16">
        <div class="flex justify-between items-center">
            <span
                    v-if="title"
                    v-text="title"
                    class="w-full text-left text-lg pb-5 tracking-wide font-semibold uppercase"
            ></span>
            <Link
                    :href="route('products')"
                    v-if="showButton"
                    class="text-brand font-semibold whitespace-nowrap block"
            >View All</Link
                >
        </div>
        <div class="grid auto-rows-auto gap-8" :class="gridSize">
            <ProductGridItem v-for="product in products" :product="product"/>
        </div>
    </div>
</template>

<script>
import ProductGridItem from "./GridItem";
import {Link} from "@inertiajs/inertia-vue3";

export default {
    props: ["products", "gridSize", "title", "showButton"],
    components: {
        ProductGridItem,
        Link,
    },
};
</script>
