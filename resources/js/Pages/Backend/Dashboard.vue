<template>
    <Head title="Dashboard"/>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <SummaryBoxes :summaryData="summaryData"/>
        <OrdersTable :orders="orders"/>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import SummaryBoxes from "@/components/Backend/Dashboard/SummaryBoxes";
import OrdersTable from "@/components/Backend/OrdersTable";
import {Head} from "@inertiajs/inertia-vue3";
import Products from "@/Pages/Backend/Product/Products";

export default {
    props: ["orders", "customers", "summaryData"],
    components: {
        Products,
        BreezeAuthenticatedLayout,
        Head,
        SummaryBoxes,
        OrdersTable,
    },
};
</script>