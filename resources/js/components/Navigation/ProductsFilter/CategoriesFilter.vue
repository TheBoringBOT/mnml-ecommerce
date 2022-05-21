<template>
    <div class="flex items-center space-x-5">
        <ul
                class="flex space-x-5 flex-wrap justify-center text-center md:justify-start md:text-left text-grey"
        >
            <li>
                <Link
                        href="/products"
                        :class="{
                        'text-brand font-medium': $page.url === '/products',
                    }"
                >
                    All</Link
                    >
            </li>
            <li v-for="category in categories">
                <Link
                        :href="`/category/${category.id}`"
                        :class="{
                        'text-brand font-medium':
                            $page.url === '/category/' + category.id,
                    }"
                        v-text="category.name"
                ></Link>
            </li>
        </ul>
    </div>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";

export default {
    props: ["categories"],
    components: {
        Link,
    },

    methods: {},
};
</script>