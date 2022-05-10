<template>
    <BreezeAuthenticatedLayout>
        <section class="text-gray-700 body-font">
            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-wrap -m-4" v-if="!products.length">
                    <div class="lg:w-1/4 md:w-1/2 p-4 w-full mb-4">
                        <a class="block relative h-48 rounded overflow-hidden">
                            <img
                                alt="ecommerce"
                                class="object-cover object-center w-full h-full block"
                                src="https://dummyimage.com/420x260"
                            />
                        </a>
                        <div class="mt-4">
                            <h3
                                class="text-gray-500 text-xs tracking-widest title-font mb-1 uppercase inline-block mr-2"
                            >
                                N/A
                            </h3>
                            <h2
                                class="text-gray-900 title-font text-lg font-medium"
                            >
                                Loading
                            </h2>
                            <p class="mt-1">$0.00</p>
                        </div>
                    </div>
                </div>
                <div
                    class="grid gap-5 grid-cols-1 md:grid-cols-3 xl:grid-cols-4"
                    v-else
                >
                    <div
                        class="w-full p-4 bg-white p-2 rounded"
                        v-for="product in products"
                        :key="product.id"
                    >
                        <Link
                            class="block relative h-48 rounded overflow-hidden"
                            :href="/product/ + product.slug"
                        >
                            <img
                                alt="ecommerce"
                                class="object-cover object-center w-full h-full block"
                                src="https://dummyimage.com/420x260"
                            />
                        </Link>
                        <div class="mt-4">
                            <h3
                                class="text-gray-500 text-xs tracking-widest title-font mb-1 uppercase inline-block mr-2"
                                v-for="category in product.categories"
                                v-text="category.name"
                            ></h3>
                            <h2
                                class="text-gray-900 title-font text-lg font-medium text-ellipsis whitespace-nowrap overflow-hidden"
                                v-text="product.name"
                            ></h2>

                            <div class="flex flex-col space-y-5">
                                <div class="flex space-x-5 items-center">
                                    <span
                                        class="mt-1 text-lg"
                                        v-text="formatCurrency(product.price)"
                                    ></span>
                                </div>
                                <div class="flex space-x-5 items-center">
                                    <span
                                        v-if="product.available <= 0"
                                        class="text-red-600"
                                        >Sold Out</span
                                    >
                                    <div v-else class="text-sm">
                                        <span>Available:</span>

                                        <span v-text="product.available"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col py-5">
                                <button
                                    class="bg-black text-white rounded block w-full p-2"
                                >
                                    Edit
                                </button>
                                <button
                                    class="bg-transparent text-slate-500 pt-5 block w-full"
                                >
                                    Remove Product
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </BreezeAuthenticatedLayout>
</template>
<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { useStore } from "vuex";

export default {
    components: { Head, Link, BreezeAuthenticatedLayout },
    // props: ["products"],
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
            console.log(useStore().state);
            return useStore().state.products;
        },
    },
};
</script>
