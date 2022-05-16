<template>
    <GuestLayout>
        <ContentSpacerTop />
        <ContentWrapper>
            <!-- product -->
            <div
                class="grid grid-cols-1 lg:grid-cols-2 grid-rows-1 gap-10 tracking-wide"
                v-if="product"
            >
                <!-- product image -->
                <div class="flex items-center justify-center">
                    <!-- add carousel here -->
                    <img
                        src="https://indigo.qodeinteractive.com/wp-content/uploads/2017/01/home-4-shop-img-10.jpg"
                    />
                </div>
                <!-- product summary -->
                <div class="flex flex-col items-start justify-start">
                    <div class="my-auto">
                        <div class="flex flex-col">
                            <!-- name -->
                            <h1
                                class="text-3xl font-bold tracking-wide leading-tight uppercase"
                                v-text="product.name"
                            ></h1>
                            <!-- price -->
                            <span
                                class="text-brand font-bold text-2xl"
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
                            <div class="flex items-center text-lg mt-10">
                                <!-- quantity -->
                                <div
                                    class="inline-block border border-black px-5 h-14 text-center"
                                >
                                    <div
                                        class="flex items-center h-14 justify-around"
                                    >
                                        <span>Quantity</span>

                                        <div
                                            class="ml-5 flex items-center px-2"
                                        >
                                            <span>-</span>
                                            <input
                                                class="border-0 w-10 text-center appearance-none text-sm"
                                                value="1"
                                                min="1"
                                                maxlength="2"
                                                inputmode="numeric"
                                                type="string"
                                            />
                                            <span>+</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- add to bag -->
                                <button
                                    @click="$store.commit('addToCart', product)"
                                    type="button"
                                    class="uppercase tracking-wider font-normal h-14 inline-block items-center px-10 lg:px-12 border border-brand hover:bg-brand-hover transition-all duration-300 bg-brand text-white text-center text-sm lg:text-base whitespace-nowrap"
                                >
                                    Add to bag
                                </button>
                            </div>

                            <!-- further details -->
                            <div class="flex flex-col space-y-2 mt-10 text-sm">
                                <!-- SKU -->
                                <div class="flex items-center space-x-2">
                                    <span class="font-medium">SKU:</span>
                                    <span v-text="product.sku"></span>
                                </div>
                                <!-- Category -->
                                <div class="flex items-center space-x-2">
                                    <span class="font-medium">Category:</span>
                                    <Link
                                        :href="/products/ + category.name"
                                        class="text-grey hover:text-brand transition-all"
                                        v-for="(category,
                                        index) in product.categories"
                                        v-text="
                                            category.name +
                                            (index !==
                                                product.categories.length - 1 &&
                                                ',')
                                        "
                                    ></Link>
                                </div>
                            </div>

                            <!-- share product -->
                            <!-- TOD fix the url for share -->
                            <ShareGroup
                                :shareInfo="{
                                    url: '',
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

        <div class="w-full mt-10">
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
        </div>

        <ContentWrapper>
            <!-- related products -->
            <ProductGrid
                :products="products"
                gridSize="grid-cols-1 md:grid-cols-2 lg:grid-cols-4"
                title="YOU MAY ALSO LIKE"
            />
        </ContentWrapper>
    </GuestLayout>
</template>
<script>
import GuestLayout from "@/Layouts/GuestLayout";
import ContentWrapper from "@/Layouts/ContentWrapper";
import { Head, Link } from "@inertiajs/inertia-vue3";
import TabsWrapper from "@/components/Tabs/TabsWrapper";
import Tab from "@/components/Tabs/Tab";
import ShareGroup from "@/components/SocialSharing/ShareGroup";
import ProductGrid from "@/components/Products/Grid/Grid";
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
            return this.$store.state.products.find(
                (product) => product.slug === props.productSlug
            );
        },

        moreProducts(props) {
            console.table(
                this.products.find(
                    (product) => product.slug === props.productSlug
                )
            );
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
