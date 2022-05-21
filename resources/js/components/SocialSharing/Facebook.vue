<template>
    <ShareNetwork
            class="hover:text-brand-hover transition-all duration-300"
            network="facebook"
            :url="shareInfo.url"
            :title="shareInfo.title"
            :description="shareInfo.description"
    >
        <svg
                width="16"
                height="16"
                id="Layer_1"
                data-name="Layer 1"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 10 10"
        >
            <defs></defs>
            <title>Facebook icon</title>
            <path
                    fill="currentColor"
                    d="M7.64,4.73H6.06V10H3.83V4.73H2.36V3H3.76v-1A2.05,2.05,0,0,1,5.8,0H7.64V1.71H6.79a.73.73,0,0,0-.72.72V3H7.64Z"
            ></path>
        </svg>
    </ShareNetwork>
</template>

<script>
export default {
    props: ["shareInfo", "size"],
};
</script>