<template>
    <Head>
        <title>High-quality designer products</title>
        <meta
                name="description"
                content="At Sirène we create beautiful functional products with out world-class design team. Established in 09"
        />
    </Head>
    <HeroSlider/>
    <GuestLayout backgroundWhite="true">
        <ContentWrapper class="my-16">
            <template v-if="products.length">
                <ProductGrid
                        showButton="true"
                        title="Some of our Favorites"
                        :products="products"
                        gridSize="grid-cols-2 md:grid-cols-3
            lg:grid-cols-3 gap-16"
                />
            </template>
            <template v-else>
                <!-- skeleton loader -->
                <ProductGridSkeleton
                        products="6"
                        showButton="true"
                        gridSize="grid-cols-2 md:grid-cols-3 lg:grid-cols-3"
                />
            </template>
        </ContentWrapper>
    </GuestLayout>
</template>
<script>
import GuestLayout from "@/Layouts/GuestLayout";
import ContentWrapper from "@/Layouts/ContentWrapper";
import {Head, Link} from "@inertiajs/inertia-vue3";
import HeroSlider from "@/components/Sliders/HeroSlider";
import ProductGrid from "@/components/Products/Grid/Grid";
import ProductGridSkeleton from "@/components/Products/Grid/Skeleton/GridSkeleton";
import {useStore} from "vuex";
import ProductSlider from "@/components/Sliders/ProductSlider";

export default {
    components: {
        ProductSlider,
        Head,
        Link,
        GuestLayout,
        ContentWrapper,
        HeroSlider,
        ProductGrid,
        ProductGridSkeleton,
    },
    props: ["productSlug", "categories"],
    methods: {
        formatCurrency(amount) {
            amount = amount / 100;
            return amount.toLocaleString("en-US", {
                style: "currency",
                currency: "USD",
            });
        },
    },
    computed: {
        products() {
            // shuffle products
            const shuffledProducts = _.shuffle(useStore().state.products);
            //and return 6 items
            return shuffledProducts.slice(0, 6);
        },

        product(props) {
            return this.products.find(
                (product) => product.slug === props.productSlug
            );
        },
    },
};
</script>
