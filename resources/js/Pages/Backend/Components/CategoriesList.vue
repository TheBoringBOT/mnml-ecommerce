<template>
    <div class="flex items-center flex-wrap w-full space-x-5">
        <Link
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
