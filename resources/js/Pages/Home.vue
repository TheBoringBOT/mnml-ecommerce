<template>
    <HeroSlider/>
    <GuestLayout>
        <ContentWrapper class="my-16">
            <ProductGrid
                    showButton="true"
                    title="Some of our Favorites"
                    :products="products"
                    gridSize="grid-cols-1 md:grid-cols-2
            lg:grid-cols-4"
            /></ContentWrapper>
    </GuestLayout>
</template>
<script>
import GuestLayout from "@/Layouts/GuestLayout";
import ContentWrapper from "@/Layouts/ContentWrapper";
import {Head, Link} from "@inertiajs/inertia-vue3";
import HeroSlider from "@/components/Sliders/HeroSlider";
import ProductGrid from "@/components/Products/Grid/Grid";

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
            const shuffledProducts = _.shuffle(useStore().state.products);
            return shuffledProducts.slice(0, 8);
        },

        product(props) {
            return this.products.find(
                (product) => product.slug === props.productSlug
            );
        },
    },
};
</script>
