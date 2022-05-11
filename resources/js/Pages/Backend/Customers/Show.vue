<template>
    {{ customer }}

    {{ ordersSent }}
    {{ ordersNotSent }}
</template>

<script>
export default {
    props: ["customer", "ordersSent", "ordersNotSent"],
};
</script>
