<template>
    <nav
            class="fixed top-0 left-0 right-0 w-full z-[100] bg-white text-primary-clr border-b border-gray-100"
    >
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                    class="flex justify-between md:grid md:grid-cols-3 md:grid-rows-1 h-20"
            >
                <!-- left -->

                <div
                        class="hidden md:flex items-center justify-start space-x-5 col-end-auto"
                >
                    <BreezeNavLink
                            :href="route('products')"
                            :active="route().current('products')"
                    >
                        Items
                    </BreezeNavLink>
                    <BreezeNavLink
                            :href="route('about')"
                            :active="route().current('about')"
                    >
                        About
                    </BreezeNavLink>
                    <BreezeNavLink
                            :href="route('about')"
                            :active="route().current('about')"
                    >
                        Contact
                    </BreezeNavLink>
                </div>
                <!-- Logo -->
                <div class="flex justify-center">
                    <div class="shrink-0 flex items-center col-end-auto">
                        <Link :href="route('home')">
                            <BreezeApplicationLogo
                                    class="block h-9 w-auto text-brand hover:text-brand-hover cursor-pointer transition-all duration-300"
                            />
                        </Link>
                    </div>
                </div>

                <!-- right -->
                <div
                        class="hidden md:flex md:items-center md:ml-6 items-center justify-end space-x-5 col-end-auto"
                >
                    <!--<BreezeNavLink-->
                    <!--:href="route('home')"-->
                    <!--:active="route().current('home')"-->
                    <!--&gt;-->
                    <!--Home-->
                    <!--</BreezeNavLink>-->

                    <BreezeNavLink
                            class="fill-black-2 hover:fill-black transition-all"
                            :href="route('login')"
                            :active="route().current('login')"
                    >
                        <svg width="18" height="20" viewBox="0 0 29.06 29.06">
                            <path
                                    d="M5.55,15.91a7.36,7.36,0,0,1,0-10.39,7.28,7.28,0,0,1,5.19-2.13,7.4,7.4,0,0,1,7.37,7.37,7.29,7.29,0,0,1-7.33,7.33,7.35,7.35,0,0,1-5.2-2.17M29.06,26.67,19.43,17a10.59,10.59,0,0,0,2-6.29,10.7,10.7,0,1,0-10.7,10.7,10.59,10.59,0,0,0,6.28-2l9.63,9.63Z"
                            ></path>
                        </svg>
                    </BreezeNavLink>
                    <BreezeNavLink
                            class="relative fill-black-2 hover:fill-black transition-all"
                            :href="route('order.checkout')"
                            :active="route().current('order.checkout')"
                    >
                        <span
                                v-if="this.$store.state.cart.length !== 0"
                                class="absolute -right-[5px] top-0 bg-black text-white rounded-full h-[17px] w-[17px] font-bold text-monospace flex items-center justify-center text-[11px]"
                                v-text="this.$store.state.cart.length"
                        ></span>
                        <figure>
                            <svg width="18" height="20" viewBox="0 0 35 48.03">
                                <path
                                        d="M31.62,44.65H3.38V16.3h3.4V23h3.38V16.3H24.84V23h3.38V16.3h3.4ZM10.16,10.72a7.34,7.34,0,1,1,14.68,0v2.2H10.16Zm18.06,2.2v-2.2a10.72,10.72,0,1,0-21.43,0v2.2H0V48H35V12.92Z"
                                ></path>
                            </svg>
                        </figure>
                    </BreezeNavLink>
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center md:hidden">
                    <button
                            @click="
                            showingNavigationDropdown = !showingNavigationDropdown
                        "
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                    >
                        <svg
                                class="h-6 w-6"
                                stroke="currentColor"
                                fill="none"
                                viewBox="0 0 24 24"
                        >
                            <path
                                    :class="{
                                    hidden: showingNavigationDropdown,
                                    'inline-flex': !showingNavigationDropdown,
                                }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                    :class="{
                                    hidden: !showingNavigationDropdown,
                                    'inline-flex': showingNavigationDropdown,
                                }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div
                :class="{
                block: showingNavigationDropdown,
                hidden: !showingNavigationDropdown,
            }"
                class="md:hidden pl-3"
        >
            <div class="pt-2 pb-3 space-y-1">
                <BreezeResponsiveNavLink
                        :href="route('home')"
                        :active="route().current('home')"
                >
                    Home
                </BreezeResponsiveNavLink>
            </div>
            <div class="pt-2 pb-3 space-y-1">
                <BreezeResponsiveNavLink
                        :href="route('products')"
                        :active="route().current('products')"
                >
                    Products
                </BreezeResponsiveNavLink>
            </div>
            <div class="pt-2 pb-3 space-y-1">
                <BreezeResponsiveNavLink
                        :href="route('about')"
                        :active="route().current('about')"
                >
                    About
                </BreezeResponsiveNavLink>
            </div>
            <div class="pt-2 pb-3 space-y-1">
                <BreezeResponsiveNavLink
                        :href="route('search')"
                        :active="route().current('search')"
                >
                    Cart
                </BreezeResponsiveNavLink>
            </div>

            <div class="pt-2 pb-3 space-y-1">
                <BreezeResponsiveNavLink
                        :href="route('order.checkout')"
                        :active="route().current('order.checkout')"
                >
                    cart
                </BreezeResponsiveNavLink>
            </div>
        </div>
    </nav>
</template>

<script>
import BreezeApplicationLogo from "@/Components/ApplicationLogo.vue";
import BreezeDropdown from "@/Components/Dropdown.vue";
import BreezeDropdownLink from "@/Components/DropdownLink.vue";
import BreezeNavLink from "@/Components/NavLink.vue";
import BreezeResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import {Link} from "@inertiajs/inertia-vue3";

export default {
    components: {
        BreezeApplicationLogo,
        BreezeDropdown,
        BreezeDropdownLink,
        BreezeNavLink,
        BreezeResponsiveNavLink,
        Link,
    },

    data() {
        return {
            showingNavigationDropdown: false,
        };
    },
};
</script>
