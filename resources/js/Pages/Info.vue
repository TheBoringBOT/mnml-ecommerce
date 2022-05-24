<template>
    <GuestLayout backgroundWhite="true">
        <Head>
            <title>Info</title>
            <meta
                name="description"
                content="Get information on shipping, orders, returns, and how to contact our support staff."
            />
        </Head>
        <ContentSpacerTop />

        <ContentWrapper class="bg-white">
            <div class="flex flex-col lg:px-10">
                <!-- page title -->
                <h1 class="text-3xl">Information</h1>

                <div class="flex flex-col space-y-16 mt-16">
                    <!-- Ordering -->
                    <div
                        class="border-b border-gray-200 pb-10 flex flex-col lg:flex-row lg:justify-between lg:gap-10 space-y-5 lg:space-y-0 align-baseline"
                    >
                        <span class="lg:w-1/3 text-2xl leading-none"
                            >Ordering</span
                        >
                        <p class="lg:w-2/3 text-grey">
                            Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit. Dictum nisl eget consectetur pretium at vel
                            quam placerat. Facilisi sapien integer sed id
                            aliquam, bibendum adipiscing. Et sed scelerisque
                            augue convallis. Volutpat tellus vestibulum ac
                            placerat lobortis id. Bibendum pellentesque
                            tristique ac, urna facilisis vel. Eget ipsum massa
                            laoreet donec. Viverra id volutpat donec placerat
                            elit ut est tortor ac. In vestibulum, interdum sit
                            faucibus.
                        </p>
                    </div>
                    <!-- Shipping -->
                    <div
                        class="border-b border-gray-200 pb-10 flex flex-col lg:flex-row lg:justify-between lg:gap-10 space-y-5 lg:space-y-0 align-baseline"
                    >
                        <span class="lg:w-1/3 text-2xl leading-none"
                            >Shipping</span
                        >
                        <p class="lg:w-2/3 text-grey">
                            Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit. Dictum nisl eget consectetur pretium at vel
                            quam placerat. Facilisi sapien integer sed id
                            aliquam, bibendum adipiscing. Et sed scelerisque
                            augue convallis.
                        </p>
                    </div>
                    <!-- Returns -->
                    <div
                        class="border-b border-gray-200 pb-10 flex flex-col lg:flex-row lg:justify-between lg:gap-10 space-y-5 lg:space-y-0 align-baseline"
                    >
                        <span class="lg:w-1/3 text-2xl leading-none"
                            >Returns</span
                        >
                        <p class="lg:w-2/3 text-grey">
                            Lorem ipsum dolor sit amet, consectetur adipiscing
                            elit. Dictum nisl eget consectetur pretium at vel
                            quam placerat. Facilisi sapien integer sed id
                            aliquam, bibendum adipiscing. Et sed scelerisque
                            augue convallis.
                        </p>
                    </div>

                    <!-- help -->
                    <div
                        class="flex flex-col lg:flex-row lg:justify-between lg:gap-10 space-y-5 lg:space-y-0 align-baseline"
                    >
                        <span class="lg:w-1/3 text-2xl leading-none"
                            >Customer Support</span
                        >
                        <div
                            class="lg:w-2/3 text-grey flex flex-col lg:flex-row justify-between space-y-10 lg:space-y-0"
                        >
                            <div class="flex flex-col space-y-2">
                                <span class="font-semibold"
                                    >Product Queries</span
                                >
                                <span> Monday to Friday: 8am to 5pm </span>
                                <span>0378-29389102</span>
                                <span>info@example.org</span>
                            </div>
                            <div class="flex flex-col space-y-2">
                                <span class="font-semibold"
                                    >Employment Opportunities</span
                                >
                                <span> Monday to Friday: 8am to 5pm </span>
                                <span>0928-398444-33</span>
                                <span>info@example.org</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ContentSpacerTop />
        </ContentWrapper>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout";
import ContentWrapper from "@/Layouts/ContentWrapper";
import { Head, Link } from "@inertiajs/inertia-vue3";
import ContentSpacerTop from "@/Layouts/ContentSpacerTop";
</script>
