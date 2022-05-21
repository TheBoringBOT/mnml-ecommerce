<template>
    <ContentWrapper>
        <!-- product -->
        <div
                class="grid grid-cols-1 md:grid-cols-2 grid-rows-1 gap-10 tracking-wide animate-pulse"
        >
            <!-- IMAGE -->
            <div
                    class="flex flex-col items-center justify-center bg-skeleton w-full pt-[100%]"
            ></div>
            <!-- product summary -->
            <div class="flex flex-col items-start justify-start">
                <div class="my-auto lg:my-0 lg:pt-24 w-full">
                    <div class="flex flex-col space-y-4">
                        <!-- name -->
                        <h1
                                class="h-8 w-48 bg-skeleton text-3xl font-bold tracking-wide leading-tight capitalize"
                        ></h1>
                        <!-- price -->
                        <span
                                class="text-brand font-bold text-2xl h-4 w-32 bg-skeleton"
                        ></span>
                    </div>
                    <!-- description -->
                    <div class="flex flex-col mt-10">
                        <span
                                class="text-brand font-bold text-2xl h-4 w-2/3 bg-skeleton"
                        ></span>
                        <span
                                class="text-brand font-bold text-2xl h-4 w-2/3 bg-skeleton my-5"
                        ></span>
                        <span
                                class="text-brand font-bold text-2xl h-4 w-1/3 bg-skeleton"
                        ></span>

                        <!-- further details -->
                        <div class="flex flex-col mt-10 space-y-2 text-sm">
                            <!-- Category -->
                            <div
                                    class="flex items-center space-x-2 flex-wrap h-12 w-1/4 bg-skeleton"
                            ></div>

                            <!-- share product -->
                            <div class="w-32 w-1/5 bg-skeleton mt-10"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </ContentWrapper>

    <!-- product more detail tabs -->
    <TabsWrapperSkeleton/>

    <ContentWrapper class="my-16">
        <!-- related products -->
        <ProductGridSkeleton
                :products="4"
                gridSize="grid-cols-1 md:grid-cols-2 lg:grid-cols-4"
                showButton="true"
        />
    </ContentWrapper>
</template>
<script>
import ContentWrapper from "@/Layouts/ContentWrapper";
import TabsWrapperSkeleton from "@/components/Tabs/Skeleton/TabsWrapperSkeleton";
import ProductGridSkeleton from "@/components/Products/Grid/Skeleton/GridSkeleton";

export default {
    components: {
        ContentWrapper,
        ProductGridSkeleton,
        TabsWrapperSkeleton,
    },

    props: ["productSlug", "categories", "seo"],
    data(props) {
        return {
            largeImgSrc: null,
            quantity: 1,
        };
    },

    methods: {
        changeQuantity(action) {
            //  + or - then choose action
            switch (action) {
                case "+":
                    this.quantity++;
                    break;
                case "-":
                    // stop minus at 1
                    if (this.quantity === 1) return;
                    this.quantity--;
                    break;
            }
        },
    },
    computed: {
        products(props) {
            // removes the current page product from array
            const productsRemoveCurrent = _.filter(
                this.$store.state.products,
                (product) => product.slug !== props.productSlug
            );
            // shuffles array to always show different products
            const shuffledProducts = _.shuffle(productsRemoveCurrent);
            // return only the first (0, {number}) products
            return shuffledProducts.slice(0, 4);
        },

        product(props) {
            // get the product matching the current slug
            const product = this.$store.state.products.find(
                (product) => product.slug === props.productSlug
            );

            return product;
        },
    },
};
</script>

<style scoped>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Firefox */
input[type="number"] {
    -moz-appearance: textfield;
}
</style>
