<template>
    <Head>
        <title>
            {{ seoTitle }}
        </title>
        <meta name="description" :content="seoDescription"/>
    </Head>
    <GuestLayout>
        <ContentSpacerTop/>
        <ContentWrapper class="mb-16">
            <template v-if="products?.length">
                <!--<ProductsFilter/>-->
                <ProductGrid
                        :products="products"
                        gridSize="grid-cols-1 md:grid-cols-2 lg:grid-cols-4"
                />
            </template>

            <!-- skeleton loader -->
            <template v-else>
                <ProductGridSkeleton
                        products="12"
                        showButton="true"
                        gridSize="grid-cols-1 md:grid-cols-2 lg:grid-cols-4"
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
            return _.filter(useStore().state.products, function (x) {
                return _.includes(x.slug, keyword);
            });
        },
    },
};
</script>
