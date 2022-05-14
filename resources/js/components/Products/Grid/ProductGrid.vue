<template>
    <div class="flex flex-col my-16">
        <div
                v-if="title"
                v-text="title"
                class="w-full text-left text-lg py-5 tracking-wide font-semibold"
        ></div>

        <div class="grid auto-rows-auto gap-8" :class="gridSize">
            <ProductGridItem v-for="product in products" :product="product"/>
        </div>
    </div>
</template>

<script>
import ProductGridItem from "./ProducGridItem";

export default {
    props: ["products", "gridSize", "title"],
    components: {
        ProductGridItem,
    },
};
</script>
