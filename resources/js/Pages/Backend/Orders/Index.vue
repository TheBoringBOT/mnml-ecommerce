<template>
    {{ ordersNotSent }}

    {{ ordersSent }}
</template>

<script>
export default {
    props: ["ordersNotSent", "ordersSent"],
};
</script>
