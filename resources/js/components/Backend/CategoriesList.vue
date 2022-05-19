<template>
    <h2 class="text-3xl text-gray-500 mb-5">Categories</h2>
    <div class="flex items-center flex-wrap w-full space-x-5">
        <Link
            :href="'/dashboard/products'"
            :class="{
                'text-black bg-gray-300': $page.url === '/dashboard/products',
            }"
            class="rounded bg-black text-white px-2"
            >All</Link
        >

        <Link
            :href="`/dashboard/products/category/${category.id}`"
            :class="{
                'text-black bg-gray-300':
                    $page.url === '/dashboard/products/category/' + category.id,
            }"
            class="rounded bg-black text-white px-2"
            v-for="category in categories"
            v-text="category.name"
        />
    </div>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Link,
    },
    props: ["categories"],
};
</script>
