<script setup>
import { computed, ref } from 'vue';
import leftMan from '@/assets/main/leftman.png';
import rightMan from '@/assets/main/rightman.png';

const props = defineProps({
    content: {
        type: Object,
    }
});

const isLeft = computed(() => props.content.idx % 2);
</script>

<template>
    <div :class="['flex justify-end flex-col bg-[length:100%_100%]', isLeft ? 'leftBg' : 'rightBg items-end']">
        <div :class="['w-full h-full absolute z-0', isLeft ? 'bg-[#e4e4e4]/20' : 'bg-[#3f3f3f]/40']" />
        <p :class="['font-bold text-[25px] text-center mb-[20%] mx-auto px-2.5 z-[1] whitespace-pre-line', {'text-white': !isLeft}]">{{ content.text }}</p>
        <div class="flex w-[85%] z-[1]">
            <img :src="isLeft ? leftMan : rightMan">
        </div>
    </div>
</template>

<style scoped>
.leftBg {
    @apply bg-[url('@/assets/bg/left.png')];
}

.rightBg {
    @apply bg-[url('@/assets/bg/right.png')];
}
</style>