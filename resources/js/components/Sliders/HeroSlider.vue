<template>
    <div class="w-full mx-auto mt-[4.5rem]">
        <swiper
                :autoplay="{
                delay: 5000,
                disableOnInteraction: false,
            }"
                :effect="'fade'"
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
                            class="bg-off-white/40 lg:hidden w-full h-full absolute left-0 top-0 z-10"
                    ></div>
                    <!--img-->
                    <img
                            :src="slider.img"
                            alt=""
                            class="absolute left-0 top-0"
                    />

                    <!-- text content -->
                    <div
                            class="max-w-7xl mx-auto relative flex flex-col items-center text-center lg:text-left lg:items-start space-y-5 z-20 w-full h-full justify-center text-black p-10"
                    >
                        <h1
                                class="text-5xl md:text-7xl font-medium tracking-tight"
                                v-text="slider.title"
                        ></h1>
                        <div
                                class="flex flex-col items-center lg:items-start space-y-5"
                        >
                            <p
                                    class="text-xl md:text-lg w-full md:max-w-[500px] font-normal lg:font-light"
                                    v-text="slider.subtitle"
                            ></p>

                            <Link
                                    :href="slider.url"
                                    v-text="slider.button"
                                    class="bg-brand hover:bg-brand-hover px-3 transition-all duration-300 text-white flex items-center py-2 text-sm lg:text-base capitalize tracking-wide"
                            >
                            </Link>
                        </div>
                    </div>
                </div>
            </swiper-slide>
        </swiper>
    </div>
</template>

<script>
// Import Swiper Vue.js components
import {Swiper, SwiperSlide} from "swiper/vue";

// Import Swiper styles
import "swiper/css";
import "swiper/css/effect-fade";

import "swiper/css/pagination";

// import required modules
import {EffectFade, Pagination, Autoplay} from "swiper";
import {Link} from "@inertiajs/inertia-vue3";

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
                    title: "Clean & Minimal",
                    subtitle:
                        "Sirène is a Danish brand offering the finest in minimalist nordic design.",
                    url: route("products"),
                    img: "images/hero/hero1.png",
                    button: "Start Shopping ",
                },
                {
                    title: "Trendy Backpacks",
                    subtitle:
                        "We offer a great selection of high-quality backpacks and bags in a variety of styles and materials.",
                    url: "/category/3",
                    img: "images/hero/hero2.png",
                    button: "View Bags",
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
    height: 500px;

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

@media (min-width: 1024px) {
    .swiper-slide img {
        object-fit: contain;
        object-position: 80% center;
    }
}
</style>
