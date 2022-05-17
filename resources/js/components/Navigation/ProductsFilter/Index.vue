<template>
    <div class="flex justify-between items-center pt-10">
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
