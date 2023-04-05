<script setup>
import { ref } from 'vue';

const isMobile = ref(true);
</script>

<template>
    <div class="flex mt-0.5 relative md:flex-col-reverse">
        <div class="overflow-hidden w-[1px] h-[44px] relative mr-1">
            <div class="w-full h-full after:content-[''] after:absolute after:w-full after:h-full after:bg-secondary after:bg-opacity-40"></div>
            <div class="w-0.5 absolute top-0 -translate-x-[50%] scroll"></div>
        </div>
        <div class="absolute w-1 h-3 bg-secondary top-[3px] right-[21px]"></div>
        <p class="text-secondary font-light text-[11px] [writing-mode:vertical-rl] md:[writing-mode:unset] md:text-[23px] md:font-bold">scroll</p>
    </div>
</template>

<style scoped>
@keyframes scrollBar {
    0% {
        transform: translate3d(0, -115%, 0);
    }
    100% {
        transform: translate3d(0, 250%, 0);
    }
}
.scroll {
    @apply bg-gradient-to-b from-secondary/30 to-secondary h-6 animate-[scrollBar_2s_ease-in-out_infinite];
}
</style>
