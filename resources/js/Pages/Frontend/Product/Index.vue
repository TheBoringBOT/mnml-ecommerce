<template>
    <Head>
        <title>
            {{ seoTitle }}
        </title>
        <meta name="description" :content="seoDescription"/>
    </Head>
    <GuestLayout>
        <ContentWrapper class="pb-16 pt-24 lg:pt-28">
            <template v-if="products.length">
                <ProductsFilter/>
                <ProductGrid
                        :products="products"
                        gridSize="grid-cols-2 md:grid-cols-3 lg:grid-cols-4"
                />
            </template>

            <!-- skeleton loader -->
            <template v-else>
                <ProductGridSkeleton
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
import {Head, Link} from "@inertiajs/inertia-vue3";
import {useStore} from "vuex";

export default {
    props: ["categoryId", "categoryName"],
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
            seoTitle: props.categoryName
                ? "Category - " + props.categoryName + " | Sirène"
                : "Discover Our Products | Sirène",
            seoDescription: props.categoryName
                ? `Check out our ${props.categoryName} products. Created by our in-house team of designers at Sirène`
                : "Discover our products that are made by our in-house designers. Using only the finest materials practices to create magic.",
        };
    },

    computed: {
        products(props) {
            // this page is used for categories + shop index.
            // categoryId is only available on /category/{id} pages
            const categoryId = props.categoryId
                ? parseInt(props.categoryId)
                : null;
            const products = useStore().state.products;
            // if no category id return the first 16 products
            if (categoryId === null) return products.slice(0, 16);
            // if the category id is available then
            // filter the products with the category
            // using lodash filter
            return _.filter(products, {
                categories: [{id: categoryId}],
            });
        },
    },
};
</script>
