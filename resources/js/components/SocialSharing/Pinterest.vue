<template>
    <ShareNetwork
            class="hover:text-brand transition-all duration-300"
            network="pinterest"
            :url="shareInfo.url"
            :title="shareInfo.title"
            :description="shareInfo.description"
    >
        <svg
                width="16"
                height="16"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 10 10"
        >
            <title>Pinterest icon</title>
            <path
                    fill="currentColor"
                    d="M5.33,0A3.41,3.41,0,0,1,8.87,3.26c0,2.27-1.26,4-3.11,4a1.65,1.65,0,0,1-1.41-.72S4,7.82,4,8.07a6.19,6.19,0,0,1-1,1.91.08.08,0,0,1-.1,0,6.51,6.51,0,0,1,0-2.19l.75-3.08a2.2,2.2,0,0,1-.18-1c0-.84.5-1.5,1.11-1.5h.1a.77.77,0,0,1,.68.86,12.39,12.39,0,0,1-.53,2.07.89.89,0,0,0,.91,1.12c1.1,0,1.83-1.4,1.83-3.06a2.1,2.1,0,0,0,0-.31A2.15,2.15,0,0,0,5.07,1H4.93A2.73,2.73,0,0,0,2.24,3.81a1.66,1.66,0,0,0,.38,1.12.28.28,0,0,1,.09.32l-.12.47a.2.2,0,0,1-.27.09A2.22,2.22,0,0,1,1.14,3.6s0-.07,0-.1A3.81,3.81,0,0,1,5.25,0Z"
            ></path>
        </svg>
    </ShareNetwork>
</template>

<script>
export default {
    props: ["shareInfo"],
};
</script>
