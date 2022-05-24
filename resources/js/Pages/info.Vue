<template>
    <GuestLayout class="bg-white">
        <Head>
            <!--<title>{{ seo.title }}</title>-->
            <!--<meta name="description" :content="seo.description" />-->
        </Head>
        <ContentSpacerTop />

        <ContentWrapper>

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
