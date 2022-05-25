<template>
    <div
            class="flex flex-col md:flex-row text-center justify-center md:text-left md:justify-between items-center space-y-5 md:space-y-0 mb-5"
    >
        <CategoriesFilter :categories="categories"/>

        <SortFilter/>
    </div>
</template>

<script>
import CategoriesFilter from "./CategoriesFilter";
import SortFilter from "./SortFilter";
import {useStore} from "vuex";

export default {
    components: {
        CategoriesFilter,
        SortFilter,
    },
    computed: {
        categories() {
            return useStore().state.categories;
        },
    },
};
</script>
