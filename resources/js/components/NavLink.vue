<script setup>
import {computed} from "vue";
import {Link} from "@inertiajs/inertia-vue3";

const props = defineProps(["href", "active"]);

const classes = computed(() =>
    props.active
        ? "inline-flex items-center px-1 pt-1  text-sm font-bold leading-5 text-black focus:outline-none  transition  duration-150 ease-in-out"
        : "inline-flex items-center px-1 pt-1  text-sm font-semibold leading-5 text-black-2 hover:text-gray-700  focus:outline-none focus:text-black focus:border-black transition duration-150 ease-in-out"
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot/>
    </Link>
</template>
