<template>
    <div class="flex h-screen bg-slate-100">
        <Sidebar />

        <!-- main content area -->
        <div
            class="flex-1 justify-center items-center mx-auto overflow-y-auto max-h-screen"
        >
            <Topbar />

            <div class="p-10">
                <div
                    class="min-h-[300vh] flex w-full justify-center items-center min-h-[80vh] border-2 border-dashed border-gray-300 rounded-xl"
                >
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Sidebar from "./Partials/Sidebar";
import Topbar from "./Partials/Topbar";

export default {
    components: {
        Sidebar,
        Topbar,
    },
};
</script>
