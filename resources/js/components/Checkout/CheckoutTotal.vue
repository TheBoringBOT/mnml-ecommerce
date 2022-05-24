<template>
    <div class="flex flex-col text-gray-800 text-sm">
        <hr class="bg-gray-300 w-full"/>
        <div class="flex flex-col space-y-3 py-5">
            <div class="flex justify-between items-center">
                <!-- subtotal -->
                <span>Subtotal</span>
                <span v-text="cartTotal"></span>
            </div>
            <div class="flex justify-between items-center">
                <!-- shipping -->
                <span>Shipping</span>
                <span>Free of charge</span>
            </div>
        </div>
        <hr class="bg-gray-300 w-full"/>
        <div class="flex justify-between items-center py-5">
            <!-- subtotal -->
            <span class="text-base">Total</span>
            <div class="flex items-center space-x-3">
                <small>USD</small>
                <span class="font-semibold text-xl" v-text="cartTotal"></span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["cartTotal"],
};
</script>
