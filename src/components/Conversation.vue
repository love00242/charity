<script setup>
import { computed, inject } from 'vue';
import leftMan from '@/assets/main/leftman.png';
import rightMan from '@/assets/main/rightman.png';

const props = defineProps({
    content: {
        type: Object,
    }
});
const isPC = inject('isPC');
const isLeft = computed(() => props.content.idx % 2);
</script>

<template>
    <div :class="[isPC ? 'pcBg': isLeft ? 'leftBg' : 'rightBg items-end', 'flex justify-end flex-col bg-[length:100%_100%] relative']">
        <!-- 手機 -->
        <template v-if="!isPC" >
            <div :class="['w-full h-full absolute z-0 ', isLeft ? 'bg-[#e4e4e4]/20' : 'bg-[#3f3f3f]/40']" />
            <p :class="['font-bold text-2xl text-center mb-[20%] mx-auto px-2.5 z-[1] whitespace-pre-line md:mb-[10%]', {'text-white': !isLeft}]">{{ content.text }}</p>
            <div class="flex w-[85%] z-[1]">
                <img :src="isLeft ? leftMan : rightMan">
            </div>
        </template>
        <!-- PC -->
        <template v-else>
            <p :class="['bg-[#e4e4e4]/[0.92] w-1/2 h-full absolute', {'z-[2]': !isLeft}]"></p>
            <p :class="['bg-black/60 w-1/2 h-full absolute right-0', {'z-[2]': isLeft}]"></p>
            
            <p :class="['font-bold text-[39px] text-center z-[1] whitespace-pre-line pr-[50%]', {'text-white pl-[50%] pr-0': !isLeft}]">{{ content.text }}</p>
            <div class="flex w-full z-[1] justify-between px-[1%]">
                <img class="w-[32%]" :src="leftMan">
                <img class="w-[32%]" :src="rightMan">
            </div>
        </template>
    </div>
</template>

<style scoped>
.pcBg {
    @apply bg-[url('@/assets/bg/index_pc.png')];
}
.leftBg {
    @apply bg-[url('@/assets/bg/left.png')];
}
.rightBg {
    @apply bg-[url('@/assets/bg/right.png')];
}
</style>