<template>
    <GuestLayout backgroundWhite="true">
        <Head>
            <title>About Us</title>
            <meta
                    name="description"
                    content="Learn about our brand vision and the team that designs our products"
            />
        </Head>
        <ContentSpacerTop/>

        <ContentWrapper class="bg-white">
            <div class="flex flex-col lg:px-10">
                <!-- page title -->
                <h1 class="text-3xl">Learn about {{ appName }}</h1>

                <div class="flex flex-col space-y-16 mt-16">
                    <!-- vision -->
                    <div
                            class="flex flex-col lg:flex-row lg:justify-between lg:gap-10 space-y-5 lg:space-y-0 align-baseline"
                    >
                        <span class="lg:w-1/3 text-2xl leading-none"
                        >The brand</span
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
                    <!-- Team -->
                    <div
                            class="flex flex-col lg:flex-row lg:justify-between lg:gap-10 space-y-5 lg:space-y-0 align-baseline"
                    >
                        <span class="lg:w-1/3 text-2xl leading-none"
                        >The design team</span
                        >
                        <div class="lg:w-2/3">
                            <div
                                    class="grid grid-cols-2 md:grid-cols-3 gap-3 lg:gap-16"
                            >
                                <div class="flex flex-col relative">
                                    <div class="pt-[100%] bg-off-white">
                                        <img
                                                class="absolute top-0 left-0 object-contain w-full"
                                                src="/images/1.png"
                                                alt="Ann Young"
                                        />
                                    </div>
                                    <div class="flex flex-col mt-2">
                                        <span
                                                class="text-grey text-sm leading-none"
                                        >Head Designer</span
                                        >
                                        <span>Ann Young</span>
                                    </div>
                                </div>
                                <div class="flex flex-col relative">
                                    <div class="pt-[100%] bg-off-white">
                                        <img
                                                class="absolute top-0 left-0 object-contain w-full"
                                                src="/images/3.png"
                                                alt="Marie Smith"
                                        />
                                    </div>
                                    <div class="flex flex-col mt-2">
                                        <span
                                                class="text-grey text-sm leading-none"
                                        >Pattern Maker</span
                                        >
                                        <span>Marie Smith</span>
                                    </div>
                                </div>
                                <div class="flex flex-col relative">
                                    <div class="pt-[100%] bg-off-white">
                                        <img
                                                class="absolute top-0 left-0 object-contain w-full"
                                                src="/images/2.png"
                                                alt="Tom Johns"
                                        />
                                    </div>
                                    <div class="flex flex-col mt-2">
                                        <span
                                                class="text-grey text-sm leading-none"
                                        >Color Specialist</span
                                        >
                                        <span>Tom Johns</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- location / contact -->
                    <div
                            class="flex flex-col lg:flex-row lg:justify-between lg:gap-10 space-y-5 lg:space-y-0 align-baseline"
                    >
                        <span class="lg:w-1/3 text-2xl leading-none"
                        >Our offices</span
                        >
                        <div
                                class="lg:w-2/3 text-grey flex flex-col lg:flex-row justify-between space-y-10 lg:space-y-0"
                        >
                            <div class="flex flex-col space-y-2">
                                <span class="font-semibold">Head Office</span>
                                <span> 102 Regents Ave, 13877 London, UK </span>
                                <span> Monday to Friday: 10am to 7pm </span>
                                <span>0378-29389102</span>
                                <span>info@example.org</span>
                            </div>
                            <div class="flex flex-col space-y-2">
                                <span class="font-semibold">US Office</span>
                                <span>
                                    89 Portland Way, 1092 New York, New York
                                </span>
                                <span> Monday to Friday: 8am to 5pm </span>
                                <span>0928-398444-33</span>
                                <span>info@example.org</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ContentSpacerTop/>
        </ContentWrapper>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout";
import ContentWrapper from "@/Layouts/ContentWrapper";
import {Head, Link} from "@inertiajs/inertia-vue3";
import ContentSpacerTop from "@/Layouts/ContentSpacerTop";
</script>
