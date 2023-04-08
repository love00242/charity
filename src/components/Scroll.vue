<script setup>
import { ref } from 'vue';

const props = defineProps({
    isGray: {
        type: Boolean,
        default: false,
    }
});

</script>

<template>
    <div class="flex mt-0.5 absolute right-1 lg:bottom-[5.5%] lg:flex-col-reverse lg:right-5 lg:left-5 lg:items-center lg:mt-0">
        <div class="overflow-hidden w-[1px] h-[44px] relative mr-1 lg:w-[3px] lg:h-[103px]">
            <div :class="['scrollBase', isGray ? 'after:bg-primary lg:bg-opacity-40':'after:bg-secondary lg:bg-opacity-90']"></div>
            <div :class="['w-0.5 absolute top-0 -translate-x-[50%] scrollLine', isGray ? 'from-[#43434354] lg:to-[#434343]' : 'from-secondary/30 to-secondary lg:to-[#eec136]']"></div>
        </div>
        <div :class="['center', isGray ? 'bg-primary' : 'bg-secondary']"></div>
        <p :class="['text', isGray ? 'text-primary' : 'text-secondary']">scroll</p>
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
    @apply bg-gradient-to-b h-6 animate-[scrollBar_2s_ease-in-out_infinite] lg:animate-[scrollBar_1.8s_ease-in-out_infinite] lg:w-0.5;
}
.scrollBase {
    @apply w-full h-full after:content-[''] after:absolute after:w-full after:h-full after:bg-opacity-40;
}
.center {
    @apply absolute w-1 h-3 mx-auto top-[3px] right-[20px] lg:w-[13px] lg:h-7 lg:left-0 lg:right-[2.4px] lg:top-12;
}
.text {
    @apply font-light text-[11px] [writing-mode:vertical-rl] lg:[writing-mode:unset] lg:text-[23px] lg:font-bold lg:pt-1;
}
</style>
