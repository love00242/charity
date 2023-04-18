<script setup>
import { computed, inject, nextTick, onMounted, ref } from 'vue';
import leftMan from '@/assets/main/leftman.png';
import rightMan from '@/assets/main/rightman.png';
import gsap from 'gsap';
import TextPlugin from 'gsap/TextPlugin';
import ScrollTrigger from 'gsap/ScrollTrigger';

gsap.registerPlugin(TextPlugin, ScrollTrigger);
const emit = defineEmits(["changeConversation"])
const props = defineProps({
    content: {
        type: Object,
    },
    offsets: Array,
});
const tl = gsap.timeline();
const isPC = inject('isPC');
const isLeft = computed(() => props.content.idx % 2);
// 電腦版字太多高度會超出 fix
const maxWidth = computed(() => {
    const { innerHeight, innerWidth } = window;
    const wordHeight = 175.5;
    const img = { height: 756, width: 687 };
    const rate = (innerHeight - wordHeight) / img.height;
    return rate * img.width / (innerWidth * 0.98) * 100
});

function play() {
    tl.restart();
}
function move(e) {
    let nowSlide = Number(sessionStorage.getItem("slideNum"));
    console.log("move", nowSlide);
    if (e.deltaY < 0 && nowSlide) {
        nowSlide -= 1;
    } else if (e.deltaY > 0 && nowSlide <= 8) {
        nowSlide += 1;
    }
    sessionStorage.setItem("slideNum", nowSlide);
    const tl = gsap.timeline();
    tl.to('.slideContent', { x: `${props.offsets[nowSlide]}`, duration: 0 })
    emit("changeConversation");
}
onMounted(async () => {
    await nextTick();
    tl.to(`.wordAni${props.content.idx}`, {
        duration: 2,
        text: props.content.text,
        delay: 0.6
    });
})

defineExpose({
    play,
})
</script>

<template>
    <div :class="[isPC ? 'pcBg' : isLeft ? 'leftBg' : 'rightBg items-end', 'flex justify-end flex-col bg-[length:100%_100%] relative']"
        @wheel.stop="move">
        <!-- 手機 -->
        <template v-if="!isPC">
            <div :class="['w-full h-full absolute z-0 ', isLeft ? 'bg-[#e4e4e4]/20' : 'bg-[#3f3f3f]/40']" />
            <p
                :class="['wordAni font-bold text-2xl text-center mb-[20%] mx-auto px-2.5 z-[1] whitespace-pre-line md:mb-[10%]', { 'text-white': !isLeft }]">
            </p>
            <div class="flex w-[85%] z-[1]">
                <img :src="isLeft ? leftMan : rightMan">
            </div>
        </template>
        <!-- PC -->
        <template v-else>
            <!-- 背景色 -->
            <p :class="['bg-[#e4e4e4]/[0.92] w-1/2 h-full absolute', { 'z-[2]': !isLeft }]"></p>
            <p :class="['bg-black/60 w-1/2 h-full absolute right-0', { 'z-[2]': isLeft }]"></p>
            <!-- 文字 -->
            <p
                :class="[`wordAni${props.content.idx} font-bold text-[39px] text-center z-[1] whitespace-pre-line pr-[50%]`, { 'text-white pl-[50%] whitespace-pre-wrap pr-[unset]': !isLeft }]">
            </p>
            <div class="flex w-full z-[1] justify-between px-[1%]">
                <img class="w-[32%]" :style="`max-width: ${maxWidth}%`" :src="leftMan">
                <img class="w-[32%]" :style="`max-width: ${maxWidth}%`" :src="rightMan">
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