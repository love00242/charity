<script setup>
import { inject, ref } from 'vue';
import gsap from 'gsap';

const emit = defineEmits(["changeConversation"])
const isPC = inject('isPC');
const tl = gsap.timeline();
const startPos = ref({ x: 0, y: 0 });
const endPos = ref({ x: 0, y: 0 });

const props = defineProps({
    offsets: Array,
});

function reverse() {
    console.log("reverse");
    !isPC.value ? tl.to('.slideContent', { x: `${props.offsets[0]}`, duration: 0 }) : tl.reverse(-1);
}
function moveWord(e) {
    console.log(props.offsets, "moveWord");
    if (e.deltaY < 0) return;
    if (isPC.value) {
        tl.play();
        tl.to('.leftTitle', { y: -1000, duration: .6 })
        tl.to('.rightTitle', { y: 1000, duration: .6 }, "<")
        tl.to('.slideContent', { x: `${props.offsets[1]}`, duration: 0 })
    }else {
        mobileSlide();
    }
    sessionStorage.setItem("slideNum", 1);
    emit("changeConversation");
}
function mobileSlide() {
    tl.play();
    tl.to('.slideContent', { x: `${props.offsets[1]}`, opacity: 0.6, duration: 0}, "<")
    tl.to('.slideContent', { opacity: 1 , duration: 1})
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
    if (y < 0 && y < -5) {
        console.log("上滑");
        mobileSlide();
        sessionStorage.setItem("slideNum", 1);
        emit("changeConversation");
    }
}

defineExpose({
    reverse,
})
</script>

<template>
    <div class="indexContent"
        @wheel.stop="moveWord" @touchstart.stop="touchstart" @touchmove="touchmove" @touchend.stop="touchend">
        <img v-if="!isPC" class="w-[65%] mx-auto md:w-[60%]" src="@/assets/main/title.png">
        <div v-else class="w-full flex absolute top-0 bottom-0 right-0 left-0 justify-center">
            <img class="leftTitle" src="@/assets/main/lefttitle.png">
            <img class="rightTitle" src="@/assets/main/righttitle.png">
        </div>
        <div class="flex w-full mt-2.5 lg:justify-between lg:px-[1%]">
            <img class="w-1/2 lg:w-[32%]" src="@/assets/main/leftman.png">
            <img class="w-1/2 lg:w-[32%]" src="@/assets/main/rightman.png">
        </div>
    </div>
</template>

<style scoped>
.indexContent {
    @apply bg-[url('@/assets/bg/index.png')] bg-[length:100%_100%] flex justify-end flex-col lg:bg-[url('@/assets/bg/index_pc.png')]
}
</style>