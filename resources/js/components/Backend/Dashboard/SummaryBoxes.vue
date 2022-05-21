<template>
    <section class="w-full flex flex-col">
        <h2 class="text-3xl text-gray-500 mb-5">Summary</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-gray-800">
            <!-- total revenue -->
            <div
                class="flex flex-col items-center justify-center bg-white h-28 rounded border border-gray-100 shadow-sm truncate"
            >
                <div
                    class="flex items-center justify-center truncate max-w-full px-2 my-auto"
                >
                    <span
                        class="text-5xl font-semibold"
                        v-text="formatCurrency(summaryData.salesTotal)"
                    ></span>
                </div>
                <span class="my-auto font-semibold">Total Sales</span>
            </div>

            <!-- orders Total -->
            <div
                class="flex flex-col items-center justify-center bg-white h-28 rounded border border-gray-100 shadow-sm"
            >
                <div
                    class="flex items-center justify-center truncate max-w-full px-2 my-auto"
                >
                    <span
                        class="text-5xl font-semibold"
                        v-text="summaryData.ordersTotal"
                    ></span>
                </div>
                <span class="my-auto font-semibold">Total Orders</span>
            </div>

            <!-- Customers total -->
            <div
                class="flex flex-col items-center justify-center bg-white h-28 rounded border border-gray-100 shadow-sm"
            >
                <div
                    class="flex items-center justify-center truncate max-w-full px-2 my-auto"
                >
                    <span
                        class="text-5xl font-semibold"
                        v-text="summaryData.customersTotal"
                    ></span>
                </div>
                <span class="my-auto font-semibold">Total Customers</span>
            </div>
            <!-- orders to send -->
            <div
                class="flex flex-col items-center bg-white justify-center h-28 rounded border border-gray-100 shadow-sm bg-green-500 text-white"
                :class="summaryData.ordersToSend > 0 && 'bg-red-500 text-white'"
            >
                <div
                    class="flex items-center justify-center truncate max-w-full px-2 my-auto"
                >
                    <span
                        class="text-5xl font-semibold"
                        v-text="summaryData.ordersToSend"
                    ></span>
                </div>
                <span class="my-auto font-semibold">Orders Processing</span>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: ["summaryData"],
    methods: {},
};
</script>
