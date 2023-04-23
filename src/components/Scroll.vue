<script setup>
import { ref } from 'vue';

</script>

<template>
    <div class="flex mt-0.5 relative right-1 lg:bottom-[5.5%] lg:absolute lg:flex-col-reverse lg:right-5 lg:left-5 lg:items-center lg:mt-0">
        <div class="overflow-hidden w-[1px] h-[44px] relative mr-1 lg:w-[3px] lg:h-[103px] lg:ml-[6px]">
            <div class="scrollBase after:bg-secondary lg:bg-opacity-30"></div>
            <div class="w-[1px] absolute top-0 -translate-x-[50%] scrollLine from-[#fecf3b00] to-secondary"></div>
        </div>
        <p class="text text-secondary">scroll</p>
    </div>
</template>

<style scoped>
@keyframes scrollBar {
    0% {
        transform: translate3d(0, -115%, 0);
    }
    100% {
        transform: translate3d(0, 360%, 0);
    }
}
.scrollLine {
    @apply bg-gradient-to-b h-6 animate-[scrollBar_2s_ease-in-out_infinite] lg:animate-[scrollBar_1.8s_ease-in-out_infinite] lg:w-1 lg:h-8;
}
.scrollBase {
    @apply w-full h-full after:content-[''] after:absolute after:w-full after:h-full after:bg-opacity-40 lg:w-[1px];
}
.text {
    @apply font-light text-[11px] [writing-mode:vertical-rl] lg:[writing-mode:unset] lg:text-[23px] lg:font-medium lg:pt-1;
}
</style>
