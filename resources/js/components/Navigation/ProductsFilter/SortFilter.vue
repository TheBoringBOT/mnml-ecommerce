<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <Menu as="div" class="relative inline-block text-left z-10">
        <div>
            <MenuButton
                class="flex items-center justify-between w-[170px] w-full border-0 px-4 py-2 text-sm font-medium border-b border-black"
            >
                <span class="block text-sm">Sort:</span>
                <span v-text="currentSort"></span>
            </MenuButton>
        </div>

        <transition
            enter-active-class="transition ease-out duration-100"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95"
        >
            <MenuItems
                class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
            >
                <div class="py-1">
                    <MenuItem v-slot="{ active }">
                        <span
                            @click="
                                $store.commit('sortProducts', ['price', 'asc'])
                            "
                            class="hover:bg-gray-100 cursor-pointer block px-4 py-2 text-sm"
                            >Price - Low to high</span
                        >
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                        <span
                            @click="
                                $store.commit('sortProducts', ['price', 'desc'])
                            "
                            class="hover:bg-gray-100 cursor-pointer block px-4 py-2 text-sm"
                            >Price - High to Low</span
                        >
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                        <span
                            @click="
                                $store.commit('sortProducts', ['id', 'desc'])
                            "
                            class="hover:bg-gray-100 cursor-pointer block px-4 py-2 text-sm"
                            >New Items</span
                        >
                    </MenuItem>
                </div>
            </MenuItems>
        </transition>
    </Menu>
</template>

<script>
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import { useStore } from "vuex";

export default {
    components: {
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
    },
    computed: {
        currentSort() {
            const current = useStore().state.sort;

            console.table(current);
            let text = "";

            switch (current.order) {
                case "asc":
                    text = "Price Up";
                    break;
                case "desc":
                    text = current.sort === "id" ? "New Items" : "Price Down";
                    break;
                default:
                    text = "Default";
            }
            return text;
        },
    },
};
</script>
