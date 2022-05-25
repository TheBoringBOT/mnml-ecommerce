<template>
    <h3
            v-if="title"
            v-text="title"
            class="font-semibold capitalize text-2xl"
    ></h3>
    <swiper
            :slidesPerView="1"
            :spaceBetween="30"
            :loop="true"
            :pagination="{
            clickable: true,
        }"
            :navigation="images.length !== 1"
            :modules="modules"
            class="mySwiper"
    >
        <swiper-slide
                class="product-slider"
                v-for="slide in images"
                :class="images.length === 1 && 'pointer-events-none'"
        >
            <img :src="getXLImage(slide.image_url)" alt="slide.name"/>
        </swiper-slide>
    </swiper>
</template>
<script>
// Import Swiper Vue.js components
import {Swiper, SwiperSlide} from "swiper/vue";

// Import Swiper styles
import "swiper/css";

import "swiper/css/pagination";
import "swiper/css/navigation";

// import required modules
import {Pagination, Navigation} from "swiper";

export default {
    props: ["title", "images"],
    components: {
        Swiper,
        SwiperSlide,
    },
    setup() {
        return {
            modules: [Pagination, Navigation],
        };
    },
};
</script>

<style scoped>
.swiper {
    width: 100%;
    height: 100%;
}

.swiper-slide {
    text-align: center;
    font-size: 18px;
    background: #e8e9eb;
    padding-top: 100%;

    /* Center slide text vertically */
    display: -webkit-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    -webkit-justify-content: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    -webkit-align-items: center;
    align-items: center;
}

.swiper-slide img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 0;
}
</style>
