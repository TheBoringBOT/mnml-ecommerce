<script setup>
import {computed} from "vue";
import {Link} from "@inertiajs/inertia-vue3";

const props = defineProps(["href", "active"]);

const classes = computed(() =>
    props.active
        ? "inline-flex items-center px-1 pt-1  text-sm text-black font-medium leading-5  focus:outline-none  transition  duration-150 ease-in-out uppercase"
        : "inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-grey hover:text-black  focus:outline-none focus:text-black focus:border-black transition duration-150 ease-in-out capitalize"
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot/>
    </Link>
</template>
