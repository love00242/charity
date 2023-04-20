<script setup>
import { computed, inject, ref } from 'vue';
import leftMan from '@/assets/main/leftman.png';
import rightMan from '@/assets/main/rightman.png';
import gsap from 'gsap';
// import TextPlugin from 'gsap/TextPlugin';
import ScrollTrigger from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);
const emit = defineEmits(["changeConversation"])
const props = defineProps({
    content: {
        type: Object,
    },
    offsets: Array,
});
// const wordTl = gsap.timeline();
const isPC = inject('isPC');
const startPos = ref({ x: 0, y: 0 });
const endPos = ref({ x: 0, y: 0 });

const isLeft = computed(() => props.content.idx % 2);
// 電腦版字太多高度會超出 fix
const maxWidth = computed(() => {
    const { innerHeight, innerWidth } = window;
    const wordHeight = 175.5;
    const img = { height: 756, width: 687 };
    const rate = (innerHeight - wordHeight) / img.height;
    return rate * img.width / (innerWidth * 0.98) * 100
});

function move(e) {
    console.log("move");
    e.deltaY < 0 ? setSlideType("prev") : setSlideType("next");
}
function setSlideType(type) {
    let nowSlide = Number(sessionStorage.getItem("slideNum"));

    if (type === "prev" && nowSlide) {
        nowSlide -= 1;
    } else if (type === "next" && nowSlide <= 8) {
        nowSlide += 1;
    }
    sessionStorage.setItem("slideNum", nowSlide);
    if (isPC.value || type === "prev") {
        const contentTl = gsap.timeline();
        contentTl.to('.slideContent', { x: `${props.offsets[nowSlide]}`, duration: 0 })
    } else {
        mobileSlide();
    }
    emit("changeConversation");
    console.log("end---------", nowSlide);
}
function mobileSlide() {
    let nowSlide = Number(sessionStorage.getItem("slideNum"));
    const contentTl = gsap.timeline();
    console.log(props.offsets[nowSlide], "mobileSlide");
    if (isLeft.value || nowSlide === 9) {
        contentTl.to(".slideContent", { x: props.offsets[nowSlide], ease: "expo.out", duration: 1 });
    } else {
        const gap = Math.abs(props.offsets[1]);
        contentTl.set(".slideContent", { x: props.offsets[nowSlide] - gap });
        contentTl.to(".slideContent", { x: props.offsets[nowSlide], ease: "expo.out", duration: 1 });
    }

}
function touchstart(e) {
    startPos.x = e.changedTouches[0].pageX;
    startPos.y = e.changedTouches[0].pageY;
}
function touchmove(e) {
    endPos.x = e.changedTouches[0].pageX;
    endPos.y = e.changedTouches[0].pageY;
}
function touchend() {
    const x = endPos.x - startPos.x;
    const y = endPos.y - startPos.y;
    if (Math.abs(y) < Math.abs(x)) return;
    if (y > 5) {
        console.log("下滑");
        setSlideType("prev")
    } else if (y < -5) {
        console.log("上滑");
        setSlideType("next")
    }
}
</script>

<template>
    <div :class="[isPC ? 'pcBg' : isLeft ? 'leftBg' : 'rightBg items-end', 'flex justify-end flex-col bg-[length:100%_100%] relative']"
        @wheel.stop="move" @touchstart.stop="touchstart" @touchmove="touchmove" @touchend.stop="touchend">
        <!-- 手機 -->
        <template v-if="!isPC">
            <div :class="['w-full h-full absolute z-0 ', isLeft ? 'bg-[#e4e4e4]/20' : 'bg-[#3f3f3f]/40']" />
            <p :class="['font-bold text-2xl text-center mb-[20%] mx-auto px-2.5 z-[1] whitespace-pre-line md:mb-[10%]', { 'text-white': !isLeft }]">{{ content.text }}</p>
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
            <p :class="['font-bold text-[39px] text-center z-[1] whitespace-pre-line pr-[50%]', { 'text-white pl-[50%] whitespace-pre-wrap pr-[unset]': !isLeft }]">{{ content.text }}</p>
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