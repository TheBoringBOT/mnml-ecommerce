<template>
    <div class="flex items-center space-x-5">
        <ul class="flex space-x-5">
            <li @click="$store.commit('sortCategory', 'Port')">All</li>
            <li
                    v-for="category in categories"
                    v-text="category.name"
                    @click="$store.commit('sortCategory', { category: category })"
            ></li>
        </ul>
    </div>
</template>

<script>
export default {
    props: ["categories"],

    methods: {},
};
</script>
