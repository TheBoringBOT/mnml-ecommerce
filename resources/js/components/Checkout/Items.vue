<template>
    <div class="py-8 lg:py-0">
        <div
                class="grid grid-cols-6 mb-5"
                v-for="(item, index) in cart"
                :key="item.id"
        >
            <!-- item image -->
            <figure class="rounded col-span-1">
                <img
                        class="object-cover w-16 h-16 rounded shadow-sm border border-gray-200"
                        :src="getMDImage(item.images[0]?.image_url)"
                        :alt="item.name"
                />
            </figure>
            <!-- item name + quantity -->
            <div
                    class="col-span-5 flex-col items-start justify-center text-sm my-auto"
            >
                <div
                        class="flex flex-col items-start justify-center space-y-2 truncate mx-2"
                >
                    <div class="flex justify-between items-center w-full">
                        <span
                                class="max-w-[70%] truncate whitespace-nowrap font-medium"
                                v-text="item.name"
                        >
                        </span>
                        <!-- item price -->

                        <span v-text="cartLineTotal(item)"></span>
                    </div>
                    <div class="flex space-x-5 justify-center">
                        <div class="flex items-center space-x-5">
                            <span
                                    class="text-gray-700 text-xs"
                                    v-text="`Qty: ${item.quantity}`"
                            ></span>
                            <div class="flex items-center space-x-1 text-black">
                                <button
                                        class="p-2 -m-2"
                                        @click="
                                        $store.commit(
                                            'decreaseQuantity',
                                            index,
                                            item
                                        )
                                    "
                                >
                                    <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="14"
                                            height="14"
                                            fill="currentColor"
                                            viewBox="0 0 16 16"
                                    >
                                        <path
                                                d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"
                                        />
                                    </svg>
                                </button>
                                <button
                                        :class="[
                                        item.available === item.quantity &&
                                            'pointer-events-none opacity-50',
                                    ]"
                                        class="p-2 -m-2"
                                        @click="
                                        $store.commit(
                                            'increaseQuantity',
                                            index,
                                            item
                                        )
                                    "
                                >
                                    <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="14"
                                            height="14"
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
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["cart", "cartLineTotal"],
};
</script>
