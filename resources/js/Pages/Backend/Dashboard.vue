<template>
    <DashboardLayout>
        <slot/>
    </DashboardLayout>
</template>

<script>
import DashboardLayout from "@/components/Backend/Layout";

export default {
    components: {
        DashboardLayout,
    },
};
</script>
