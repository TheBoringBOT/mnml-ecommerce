<template>
    <section class="tabs w-full bg-gray-100 animate-pulse mx-auto mt-10 h-64">
        <div class="bg-white w-full py-5 hidden lg:block">
            <ContentWrapper>
                <ul
                        class="flex flex-wrap items-start space-y-5 md:space-y-0 md:space-x-5 lg:items-center max-w-7xl"
                >
                    <li class="bg-gray-100 h-8 w-48"></li>
                    <li class="bg-gray-100 h-8 w-48"></li>
                </ul>
            </ContentWrapper>
        </div>
    </section>
</template>

<script>
import ContentWrapper from "@/Layouts/ContentWrapper";

export default {
    components: {
        ContentWrapper,
    },
};
</script>
