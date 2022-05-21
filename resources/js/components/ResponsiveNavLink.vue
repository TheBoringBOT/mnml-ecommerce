<script setup>
import {computed} from "vue";
import {Link} from "@inertiajs/inertia-vue3";

const props = defineProps(["href", "active"]);

const classes = computed(() =>
    props.active
        ? "block pl-3 pr-4 py-2 border-l-4 border-gray-200 text-base font-medium text-black bg-gray-100 focus:outline-none focus:text-black focus:bg-gray-100 focus:border-gray-200 transition duration-150 ease-in-out"
        : "block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out"
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot/>
    </Link>
</template>