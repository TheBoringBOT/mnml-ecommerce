<template>
    <GuestLayout>
        <ContentSpacerTop/>
        <ContentWrapper>
            <ProductsFilter/>
            <ProductGrid
                    :products="products"
                    gridSize="grid-cols-1 md:grid-cols-2 lg:grid-cols-4"
            />
        </ContentWrapper>
    </GuestLayout>
</template>
<script>
import GuestLayout from "@/Layouts/GuestLayout";
import ContentSpacerTop from "@/Layouts/ContentSpacerTop";
import ContentWrapper from "@/Layouts/ContentWrapper";
import ProductGrid from "@/components/Products/Grid/Grid";
import ProductsFilter from "@/Components/Navigation/ProductsFilter/Index";
import {Head, Link} from "@inertiajs/inertia-vue3";
import {useStore} from "vuex";

export default {
    props: ["categoryId"],
    components: {
        Head,
        Link,
        GuestLayout,
        ContentSpacerTop,
        ContentWrapper,
        ProductGrid,
        ProductsFilter,
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
