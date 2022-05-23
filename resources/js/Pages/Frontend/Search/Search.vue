<template>
    <Head>
        <title>
            {{ seoTitle }}
        </title>
        <meta name="description" :content="seoDescription" />
    </Head>
    <GuestLayout>
        <ContentSpacerTop />
        <ContentWrapper class="mb-16">
            <template v-if="products?.length">
                <!--<ProductsFilter/>-->
                <div class="flex flex-col items-center justify-center h-full">
                    <h1 class="text-2xl font-semibold">
                        Search Results for: {{ keyword }}
                    </h1>
                    <div class="pt-16 pb-10">
                        <ProductGrid
                            :products="products"
                            gridSize="grid-cols-2 md:grid-cols-3 lg:grid-cols-4"
                        />
                    </div>
                </div>
            </template>

            <template v-else>
                <!-- if no products and no skeleton show no results -->
                <div v-if="!showSkeleton">
                    <div
                        class="flex flex-col items-center justify-center h-full"
                    >
                        <h1 class="text-2xl font-semibold">
                            No search results for: {{ keyword }}
                        </h1>
                        <div class="pt-16 pb-10">
                            <ProductGrid
                                :products="productsAlt"
                                gridSize="grid-cols-2 md:grid-cols-3 lg:grid-cols-4"
                                title="How about these?"
                            />
                        </div>
                    </div>
                </div>
                <!-- skeleton loader -->
                <ProductGridSkeleton
                    v-else
                    products="12"
                    showButton="true"
                    gridSize="grid-cols-2 md:grid-cols-3 lg:grid-cols-4"
                />
            </template>
        </ContentWrapper>
    </GuestLayout>
</template>

<script>
import GuestLayout from "@/Layouts/GuestLayout";
import ContentSpacerTop from "@/Layouts/ContentSpacerTop";
import ContentWrapper from "@/Layouts/ContentWrapper";
import ProductGrid from "@/components/Products/Grid/Grid";
import ProductGridSkeleton from "@/components/Products/Grid/Skeleton/GridSkeleton";
import ProductsFilter from "@/Components/Navigation/ProductsFilter/Index";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { useStore } from "vuex";

export default {
    props: ["keyword"],
    components: {
        Head,
        Link,
        GuestLayout,
        ContentSpacerTop,
        ContentWrapper,
        ProductGrid,
        ProductGridSkeleton,
        ProductsFilter,
    },
    data(props) {
        return {
            showSkeleton: true,
            seoTitle: props.keyword
                ? `Search ${props.keyword}| Sirène`
                : "Search | Sirène",
            seoDescription: "Search our product catalog",
        };
    },

    computed: {
        products(props) {
            const keyword = props.keyword;

            // search the products via the keyword
            // searching the product slug as its sure to be lowercase
            return _.filter(useStore().state.products, (x) => {
                this.showSkeleton = false;
                return _.includes(x.slug, keyword);
            });
        },
        productsAlt() {
            // shuffles array to always show different products
            const shuffledProducts = _.shuffle(this.$store.state.products);
            // return only the first (0, {number}) products
            return shuffledProducts.slice(0, 8);
        },
    },
};
</script>
