<template>
    <GuestLayout>
        <Head>
            <title>{{ seo.title }}</title>
            <meta name="description" :content="seo.description"/>
        </Head>
        <ContentSpacerTop/>

        <template v-if="product">
            <ContentWrapper>
                <!-- product -->
                <div
                        class="grid grid-cols-1 md:grid-cols-2 grid-rows-1 gap-10 tracking-wide"
                >
                    <!-- product images -->
                    <div class="flex flex-col items-center justify-center">
                        <!-- large image -->
                        <ProductSlider :images="product.images"/>
                    </div>
                    <!-- product summary -->
                    <div
                            class="flex flex-col items-start justify-start text-brand lg:px-16 xl:px-20"
                    >
                        <div class="my-auto lg:my-0 lg:pt-24">
                            <div class="flex flex-col">
                                <!-- name -->
                                <h1
                                        class="text-3xl font-bold tracking-wide leading-tight capitalize"
                                        v-text="product.name"
                                ></h1>
                                <!-- price -->
                                <span
                                        class="font-semibold mt-3 text-2xl"
                                        v-text="formatCurrency(product.price)"
                                ></span>
                            </div>
                            <div class="flex flex-col mt-10">
                                <!--reviews  ? -->

                                <!-- description -->
                                <p
                                        class="text-grey text-base tracking-wide"
                                        v-text="product.description"
                                ></p>
                                <!-- buy / choose quantity -->
                                <div
                                        class="flex flex-wrap items-center text-lg mt-10"
                                >
                                    <!-- quantity -->
                                    <div
                                            class="inline-block w-full lg:w-1/3 border border-gray-300 px-5 h-12 text-center"
                                    >
                                        <div
                                                class="flex items-center h-12 justify-around"
                                        >
                                            <!--<span>Quantity</span>-->

                                            <div class="flex items-center px-2">
                                                <button
                                                        :class="
                                                        quantity === 1
                                                            ? 'pointer-events-none opacity-50'
                                                            : 'cursor-pointer p-3 -m-3'
                                                    "
                                                        @click="changeQuantity('-')"
                                                >
                                                    <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="16"
                                                            height="16"
                                                            fill="currentColor"
                                                            viewBox="0 0 16 16"
                                                    >
                                                        <path
                                                                d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"
                                                        />
                                                    </svg>
                                                </button>
                                                <input
                                                        class="border-0 w-10 text-center appearance-none text-sm font-semibold pointer-events-none bg-off-white"
                                                        :value="quantity"
                                                        min="1"
                                                        maxlength="2"
                                                        inputmode="numeric"
                                                        type="string"
                                                        @keydown="
                                                        (e) =>
                                                            e.prevent.default()
                                                    "
                                                />
                                                <button
                                                        :class="
                                                        product.available ===
                                                        quantity
                                                            ? 'pointer-events-none opacity-50'
                                                            : 'cursor-pointer p-3 -m-3'
                                                    "
                                                        @click="changeQuantity('+')"
                                                >
                                                    <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="16"
                                                            height="16"
                                                            fill="currentColor"
                                                            viewBox="0 0 16 16"
                                                    >
                                                        <path
                                                                d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"
                                                        />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- add to bag -->
                                    <button
                                            @click="
                                            $store.commit('addToCart', {
                                                product,
                                                quantity,
                                            })
                                        "
                                            type="button"
                                            class="w-full lg:w-2/3 capitalize tracking-wider font-normal h-12 inline-block items-center px-10 lg:px-12 border border-brand hover:bg-brand-hover transition-all duration-300 bg-brand text-white text-center text-sm lg:text-base whitespace-nowrap"
                                    >
                                        Add to bag
                                    </button>
                                </div>

                                <!-- further details -->
                                <div
                                        class="flex flex-col space-y-2 mt-10 text-sm"
                                >
                                    <!-- SKU -->
                                    <div class="flex items-center space-x-2">
                                        <span class="font-medium">SKU:</span>
                                        <span v-text="product.sku"></span>
                                    </div>
                                    <!-- Category -->
                                    <div
                                            class="flex items-center space-x-2 flex-wrap"
                                    >
                                        <span class="font-medium"
                                        >Category:</span
                                        >

                                        <Link
                                                :href="/category/ + category.id"
                                                class="text-grey hover:text-brand transition-all"
                                                v-for="(category,
                                            index) in product.categories"
                                                v-text="
                                                category.name +
                                                (index !==
                                                    product.categories.length -
                                                        1 && ',')
                                            "
                                        ></Link>
                                    </div>
                                </div>

                                <!-- share product -->
                                <!-- TOD fix the url for share -->
                                <ShareGroup
                                        :shareInfo="{
                                        url: productUrl,
                                        title: product.name,
                                        description: product.description,
                                    }"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </ContentWrapper>

            <!-- product more detail tabs -->

            <!--tabs-->
            <TabsWrapper>
                <Tab title="Product Story">{{ product?.description }}</Tab>
                <Tab title="More Info">
                    <ul class="text-black-2">
                        <li>
                            Care:
                            <p class="text-grey">{{ product?.care }}</p>
                        </li>
                        <li>
                            Materials:
                            <p class="text-grey">{{ product?.materials }}</p>
                        </li>
                    </ul>
                </Tab>
            </TabsWrapper>

            <div class="bg-white">
                <ContentWrapper class="py-16 bg-white">
                    <!-- related products -->
                    <ProductGrid
                            :products="products"
                            gridSize="grid-cols-1 md:grid-cols-2 lg:grid-cols-4"
                            title="You may also like"
                    />
                </ContentWrapper>
            </div>
        </template>
        <template v-else>
            <ProductSkeleton/>
        </template>
    </GuestLayout>
</template>
<script>
import GuestLayout from "@/Layouts/GuestLayout";
import ContentWrapper from "@/Layouts/ContentWrapper";
import {Head, Link} from "@inertiajs/inertia-vue3";
import TabsWrapper from "@/components/Tabs/TabsWrapper";
import Tab from "@/components/Tabs/Tab";
import ShareGroup from "@/components/SocialSharing/ShareGroup";
import ProductGrid from "@/components/Products/Grid/Grid";
import ProductSlider from "@/components/Sliders/ProductSlider";
import ProductSkeleton from "./Skeleton/ShowSkeleton";
import ContentSpacerTop from "@/Layouts/ContentSpacerTop";

export default {
    components: {
        ProductGrid,
        Head,
        Link,
        GuestLayout,
        ContentSpacerTop,
        ContentWrapper,
        TabsWrapper,
        Tab,
        ShareGroup,
        ProductSlider,
        ProductSkeleton,
    },

    props: ["productSlug", "categories", "seo"],
    data(props) {
        return {
            largeImgSrc: null,
            quantity: 1,
            productUrl: window.location,
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