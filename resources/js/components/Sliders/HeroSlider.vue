<template>
    <swiper
        :direction="'vertical'"
        :effect="'fade'"
        :autoplay="{
            delay: 2500,
            disableOnInteraction: false,
        }"
        :pagination="{
            clickable: true,
        }"
        :modules="modules"
        class="mySwiper"
    >
        <swiper-slide v-for="slider in sliders">
            <div class="relative w-full h-full">
                <!-- overlay-->
                <div
                    class="bg-black/30 w-full h-full absolute left-0 top-0 z-10"
                ></div>
                <!--img-->
                <img :src="slider.img" alt="" class="absolute left-0 top-0" />
                <!-- text content -->
                <div
                    class="relative flex flex-col items-center text-center md:text-left md:items-start space-y-10 z-20 w-full lg:w-2/3 h-full justify-center text-white p-10"
                >
                    <h1
                        class="text-5xl lg:text-7xl font-bold"
                        v-text="slider.title"
                    ></h1>
                    <!--<p v-text="slider.subtitle"></p>-->
                    <Link
                        :href="slider.url"
                        class="bg-brand text-white px-8 py-2 text-lg"
                        >View Now</Link
                    >
                </div>
            </div>
        </swiper-slide>
    </swiper>
</template>

<script>
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from "swiper/vue";

// Import Swiper styles
import "swiper/css";
import "swiper/css/effect-fade";

import "swiper/css/pagination";

// import required modules
import { EffectFade, Pagination, Autoplay } from "swiper";
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Swiper,
        SwiperSlide,
        Link,
    },
    data() {
        return {
            sliders: [
                {
                    title: " Womens Clothing",
                    url: route("products"),
                    img:
                        "https://images.unsplash.com/photo-1515955656352-a1fa3ffcd111?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80",
                },
                {
                    title: " Dudes Shoes",
                    url: route("products"),

                    img:
                        "https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80",
                },
                {
                    title: " Womens Clothing",
                    url: route("products"),

                    img:
                        "https://images.unsplash.com/flagged/photo-1556637640-2c80d3201be8?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80",
                },
            ],
        };
    },

    setup() {
        return {
            modules: [Autoplay, Pagination, EffectFade],
        };
    },
};
</script>

<style scoped>
/* swiper js custom styles */
.swiper {
    width: 100%;
    height: 100%;
    max-height: 55vh;
    min-height: 500px;
}

.swiper-slide {
    text-align: center;
    font-size: 50px;
    background: #f5f5f7;
    color: #000;

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
}
</style>
