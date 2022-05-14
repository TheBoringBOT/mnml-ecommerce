<template>
    <div class="flex items-center space-x-5 mt-3">
        <span class="font-semibold text-black">Share:</span>
        <div class="flex items-center justify-start space-x-5">
            <Facebook :shareInfo="shareInfo"/>
            <Twitter :shareInfo="shareInfo"/>
            <Pinterest :shareInfo="shareInfo"/>
        </div>
    </div>
</template>

<script>
import Facebook from "./Facebook";
import Twitter from "./Twitter";
import Pinterest from "./Pinterest";

export default {
    //expecting an object for shareInfo with
    // url, title, description,
    props: ["shareInfo"],
    components: {
        Facebook,
        Twitter,
        Pinterest,
    },
};
</script>
