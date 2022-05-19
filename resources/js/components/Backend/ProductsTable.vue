<template>
    <section
        class="bg-gray-100 flex flex-col items-start justify-center overflow-hidden my-10"
    >
        <h2 class="text-3xl text-gray-500">Products</h2>
        <div class="w-full overflow-x-auto">
            <div class="shadow-md rounded my-6">
                <table class="min-w-max w-full table-auto bg-white">
                    <thead>
                        <tr
                            class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal"
                        >
                            <th class="py-3 px-6 text-left">Product</th>
                            <th
                                class="hidden lg:table-cell py-3 px-6 text-left"
                            >
                                Images
                            </th>
                            <th
                                class="hidden lg:table-cell py-3 px-6 text-center"
                            >
                                Price USD
                            </th>
                            <th
                                class="hidden lg:table-cell py-3 px-6 text-center"
                            >
                                In Stock
                            </th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        <tr
                            v-for="product in products"
                            class="border-b border-gray-200 hover:bg-gray-100"
                        >
                            <!-- product name -->
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <span
                                        class="font-medium"
                                        v-text="product.name"
                                    ></span>
                                </div>
                            </td>
                            <!-- Images -->
                            <td
                                class="hidden lg:table-cell py-3 px-6 text-left"
                            >
                                <div class="flex items-center">
                                    <div
                                        v-for="image in product.images"
                                        class="mr-2"
                                    >
                                        <img
                                            class="w-6 h-6 rounded"
                                            :src="
                                                getSmallImage(image.image_url)
                                            "
                                        />
                                    </div>
                                </div>
                            </td>

                            <!-- Price -->
                            <td
                                class="hidden lg:table-cell py-3 px-6 text-center"
                            >
                                <div class="flex items-center justify-center">
                                    <span
                                        class="text-2xl"
                                        v-text="formatCurrency(product.price)"
                                    ></span>
                                </div>
                            </td>
                            <!-- in stock -->
                            <td
                                class="hidden lg:table-cell py-3 px-6 text-center"
                            >
                                <div class="flex items-center justify-center">
                                    <span
                                        class="text-2xl"
                                        v-text="product.available"
                                    ></span>
                                </div>
                            </td>
                            <!-- actions -->
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <Link
                                        :href="`/product/${product.slug}`"
                                        class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                            />
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                            />
                                        </svg>
                                    </Link>
                                    <Link
                                        :href="`/dashboard/product/edit/${product.id}`"
                                        class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                                            />
                                        </svg>
                                    </Link>
                                    <div
                                        class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                            />
                                        </svg>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    props: ["products"],
    components: {
        Link,
    },

    methods: {
        getSmallImage(image) {
            return image.replace(/[lg_]\g/, "md");
        },

        formatCurrency(amount) {
            amount = amount / 100;
            return amount.toLocaleString("en-US", {
                style: "currency",
                currency: "USD",
            });
        },
    },
};
</script>
