<template>
    <div class="min-h-screen bg-white">
        <hr class="bg-gray-200 w-full" />
        <div class="flex flex-col justify-center items-center my-28">
            <ApplicationLogo class="w-[300px] text-gray-700" />
            <h1 class="text-3xl mt-8 font-medium text-gray-700">
                Your bag is empty
            </h1>
            <div class="relative w-full flex items-center justify-center mt-8">
                <Link
                    class="flex items-center font-medium text-gray-500 hover:text-black transition-all space-x-2"
                    :href="route('products')"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="7"
                        height="18"
                        viewBox="0 0 13 24"
                        fill="none"
                    >
                        <path
                            d="M3.0033 11.9998L12.6351 2.16811C13.121 1.6721 13.121 0.868036 12.6351 0.372012C12.1495 -0.124004 11.3611 -0.124004 10.8755 0.372012L0.36445 11.102C-0.121483 11.598 -0.121483 12.402 0.36445 12.8981L10.8763 23.628C11.1189 23.876 11.4376 24 11.7559 24C12.0742 24 12.3929 23.876 12.6356 23.628C13.1215 23.132 13.1215 22.3279 12.6356 21.8319L3.0033 11.9998Z"
                            fill="currentColor"
                        />
                    </svg>

                    <span> Continue Shopping</span></Link
                >
            </div>
        </div>
        <hr class="bg-gray-200 w-full" />
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import ApplicationLogo from "@/components/ApplicationLogo";
import BackButton from "@/components/Checkout/BackButton";
</script>
