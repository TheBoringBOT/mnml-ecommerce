<template>
    <section
            class="bg-gradient w-full py-5 flex items-center space-y-5 text-black"
    >
        <div
                class="mx-auto max-w-7xl px-10 w-full flex flex-col lg:flex-row justify-center space-y-2 lg:space-y-0 lg:space-x-10 items-center"
        >
            <div>
                <h4
                        class="inline-block font-medium text-2xl font-semibold leading-none space-x-10 text-center"
                >
                    Get 25% off your next purchase <br/>
                </h4>
            </div>
            <div>
                <span
                        class="font-mono inline-block bg-black text-white block leading-6 border border-black/50 py-2 px-3 rounded-full"
                >Use code: <strong> #GoBig25</strong></span
                >
            </div>
        </div>
    </section>
</template>

<style scoped>
.bg-gradient {
    background-image: radial-gradient(
            ellipse at 5% 5%,
            #e6c0fe 0%,
            rgba(254, 200, 51, 0) 75%
    ),
    radial-gradient(
            ellipse at 95% 5%,
            #fd7d3e 0%,
            rgba(253, 193, 167, 0) 75%
    ),
    radial-gradient(
            ellipse at 95% 95%,
            #b686e4 15%,
            rgba(228, 105, 154, 0) 75%
    ),
    radial-gradient(
            ellipse at 5% 95%,
            #9eebdf 30%,
            rgba(235, 85, 81, 0) 75%
    );
}
</style>
