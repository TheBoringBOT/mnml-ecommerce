<template>
    <Transition>
        <div
                class="py-10 min-h-[200px]"
                :class="currentTitle !== title && 'hidden'"
                v-show="title === currentTitle"
        >
            <h3 class="text-black font-semibold text-2xl mb-5 uppercase">
                {{ title }}
            </h3>
            <p class="text-grey">
                <slot/>
            </p>
        </div>
    </Transition>
</template>

<script>
import {inject} from "vue";

export default {
    props: ["title"],
    setup() {
        const currentTitle = inject("currentTitle");
        return {
            currentTitle,
        };
    },
};
</script>
<style scoped>
/* we will explain what these classes do next! */
.v-enter-active,
.v-leave-active {
    transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>
