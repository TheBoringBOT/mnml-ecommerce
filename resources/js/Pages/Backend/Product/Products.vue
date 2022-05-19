<template>
    <BreezeAuthenticatedLayout>
        <section class="text-gray-700 body-font">
            <div class="container px-5 mx-auto">
                <CategoriesList :categories="categories"/>

                <ProductsTable :products="products"/>
            </div>
        </section>
    </BreezeAuthenticatedLayout>
</template>
<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import {Head, Link} from "@inertiajs/inertia-vue3";
import {useStore} from "vuex";
import CategoriesList from "@/components/Backend/CategoriesList";
import ProductsTable from "@/components/Backend/ProductsTable";

export default {
    components: {
        ProductsTable,
        Head,
        Link,
        BreezeAuthenticatedLayout,
        CategoriesList,
    },
    props: ["products", "categories"],
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
        // products() {
        //     console.log(useStore().state);
        //     return useStore().state.products;
        // },
    },
};
</script>
