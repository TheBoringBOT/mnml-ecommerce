<template>
    <div class="flex flex-col space-y-5">
        <div class="flex relative pt-[100%] overflow-hidden bg-skeleton"></div>
        <div class="flex justify-between items-center">
            <span class="h-4 w-16 bg-skeleton"></span>
            <span class="h-4 w-10 bg-skeleton"></span>
        </div>
    </div>
</template>

<script>
export default {
    props: ["product"],
};
</script>

<style scoped></style>
