<template>
    <section
            class="bg-gray-100 flex flex-col items-start justify-center overflow-hidden my-10"
    >
        <h2 class="text-3xl text-gray-500">Orders</h2>
        <div class="w-full overflow-x-auto">
            <div class="shadow-md rounded my-6">
                <table class="min-w-max w-full table-auto bg-white">
                    <thead>
                        <tr
                                class="bg-gray-200 text-gray-600 capitalize text-sm leading-normal"
                        >
                            <th class="py-3 px-6 text-left">Order No.</th>
                            <th class="py-3 px-6 text-left">Transaction Id</th>
                            <th class="py-3 px-6 text-left">Date</th>
                            <th class="py-3 px-6 text-left">Customer</th>
                            <th class="py-3 px-6 text-center">Total</th>
                            <th class="py-3 px-6 text-center">Status</th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        <tr
                                v-for="order in orders"
                                class="border-b border-gray-200 hover:bg-gray-100"
                        >
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <!-- order id/number -->
                                <div class="flex items-center">
                                    <span
                                            class="font-medium"
                                            v-text="order.id"
                                    ></span>
                                </div>
                            </td>
                            <!-- transaction id -->
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span v-text="order.transaction_id"></span>
                                </div>
                            </td>
                            <!-- order created date -->
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span
                                            v-text="formatDate(order.created_at)"
                                    ></span>
                                </div>
                            </td>
                            <!-- Customer Name -->
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span v-text="order.customer.name"></span>
                                </div>
                            </td>
                            <!-- order total -->
                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center">
                                    <span
                                            v-text="formatCurrency(order.total)"
                                    ></span>
                                </div>
                            </td>
                            <!-- order status , sent // not sent -->
                            <td class="py-3 px-6 text-center">
                                <span
                                        @click="changeStatus(order.id)"
                                        :class="
                                        order.sent === 1
                                            ? 'bg-green-500 '
                                            : 'bg-red-500'
                                    "
                                        class="cursor-pointer py-1 px-3 rounded-full text-xs text-white font-semibold"
                                        v-text="
                                        order.sent === 1 ? 'Sent' : 'Not Sent'
                                    "
                                ></span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center">
                                    <!-- show order -->
                                    <Link
                                            :href="
                                            route(
                                                'dashboard.order.show',
                                                order.id
                                            )
                                        "
                                            class="cursor-pointer w-4 mr-2 transform hover:text-black hover:scale-110"
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

                                    <span
                                            @click="changeStatus(order.id)"
                                            :class="
                                            order.sent === 1
                                                ? 'text-green-500'
                                                : 'text-gray-300'
                                        "
                                            class="cursor-pointer w-4 mr-2 transform hover:text-black hover:scale-110"
                                    >
                                        <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="25"
                                                height="25"
                                                viewBox="0 0 20 20"
                                        >
                                            <g fill="none" fill-rule="evenodd">
                                                <rect
                                                        stroke="currentColo"
                                                        fill="currentColor"
                                                        x="3.5"
                                                        y="3.5"
                                                        width="13"
                                                        height="13"
                                                        rx="2"
                                                />
                                                <path
                                                        stroke="#FFF"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M6 10.157L8.572 13 14 7"
                                                />
                                            </g></svg
                                        ></span>
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
import {Link} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";
import {useToast} from "vue-toastification";

export default {
    props: ["orders"],
    components: {
        Link,
    },
    setup() {
        const toast = useToast();
        return {toast};
    },
    methods: {
        formatDate(date) {
            const options = {
                weekday: "long",
                year: "numeric",
                month: "long",
                day: "numeric",
            };
            return new Date(date).toLocaleDateString("en-US", options);
        },
        formatCurrency(amount) {
            amount = amount / 100;
            return amount.toLocaleString("en-US", {
                style: "currency",
                currency: "USD",
            });
        },
        changeStatus(orderId) {
            axios
                .post("/api/order/update/" + orderId)
                .then((response) => {
                    Inertia.reload({only: ["orders", "summaryData"]});
                    this.toast.info("Order Status Updated");
                })
                .catch((error) => {
                    this.toast.error(error.response);
                });
        },
    },
};
</script>
