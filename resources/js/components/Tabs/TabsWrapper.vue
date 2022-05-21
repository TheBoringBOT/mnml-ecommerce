<template>
    <section
            class="tabs w-full bg-white mx-auto mt-10 border-b border-gray-100"
    >
        <div class="bg-off-white w-full py-5">
            <ContentWrapper>
                <ul
                        class="flex flex-wrap items-start space-y-5 md:space-y-0 md:space-x-5 lg:items-center max-w-7xl"
                >
                    <li
                            :class="
                            currentTitle === title
                                ? 'bg-brand text-white hover:bg-brand-hover'
                                : 'text-black bg-gray-100 hover:bg-gray-50'
                        "
                            class="w-full md:w-auto transition-all duration-300 cursor-pointer whitespace-nowrap px-10 py-2 uppercase"
                            v-for="title in tabTitles"
                            :key="title"
                            @click="currentTitle = title"
                    >
                        {{ title }}
                    </li>
                </ul>
            </ContentWrapper>
        </div>

        <ContentWrapper>
            <slot/>
        </ContentWrapper>
    </section>
</template>

<script>
import {ref, provide} from "vue";
import ContentWrapper from "@/Layouts/ContentWrapper";

export default {
    components: {
        ContentWrapper,
    },
    setup(props, {slots}) {
        const tabTitles = ref(slots.default().map((tab) => tab.props.title));
        const currentTitle = ref(tabTitles.value[0]);
        provide("currentTitle", currentTitle);
        return {
            tabTitles,
            currentTitle,
        };
    },
};
</script>