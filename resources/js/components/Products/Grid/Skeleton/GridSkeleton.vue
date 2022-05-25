<template>
    <div class="flex flex-col animate-pulse">
        <div v-if="showButton" class="flex justify-between items-center pb-5">
            <span
                    class="h-4 w-32 bg-skeleton text-left text-lg tracking-wide font-semibold capitalize"
            ></span>
            <span
                    class="h-4 w-8 bg-skeleton text-left text-lg tracking-wide font-semibold capitalize"
            ></span>
        </div>
        <div class="grid auto-rows-auto gap-4 lg:gap-8" :class="gridSize">
            <GridItemSkeleton
                    v-for="product in parseInt(products)"
                    :product="product"
            />
        </div>
    </div>
</template>

<script>
import GridItemSkeleton from "./GridItemSkeleton";

export default {
    props: ["products", "gridSize", "showButton"],
    components: {
        GridItemSkeleton,
    },
};
</script>
