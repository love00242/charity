<script setup>
import { ref } from 'vue';

</script>

<template>
    <div class="flex mt-0.5 absolute right-1 lg:bottom-[5.5%] lg:flex-col-reverse lg:right-5 lg:left-5 lg:items-center lg:mt-0">
        <div class="overflow-hidden w-[1px] h-[44px] relative mr-1 lg:w-[3px] lg:h-[103px]">
            <div class="w-full h-full after:content-[''] after:absolute after:w-full after:h-full after:bg-secondary after:bg-opacity-90"></div>
            <div class="w-0.5 absolute top-0 -translate-x-[50%] scroll lg:w-1"></div>
        </div>
        <div class="absolute w-1 h-3 bg-secondary mx-auto top-[3px] right-[20px] lg:w-[13px] lg:h-7 lg:left-0 lg:right-[2.4px] lg:top-12"></div>
        <p class="text-secondary font-light text-[11px] [writing-mode:vertical-rl] lg:[writing-mode:unset] lg:text-[23px] lg:font-bold lg:pt-1">scroll</p>
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
.scroll {
    @apply bg-gradient-to-b from-secondary/30 to-[#eec136] h-6 animate-[scrollBar_2s_ease-in-out_infinite] lg:animate-[scrollBar_1.8s_ease-in-out_infinite];
}
</style>
