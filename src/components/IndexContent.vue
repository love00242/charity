<script setup>
import { ref, inject } from 'vue';
import gsap from 'gsap';

const emit = defineEmits(["changeConversation"])
const isPC = inject('isPC');
const tl = gsap.timeline();

const props = defineProps({
    offsets: Array,
});

function reverse() {
    tl.reverse(-1);
}

function moveWord(e) {
    console.log(props.offsets, "moveWord");
    if(e.deltaY < 0) return;
    tl.play();
    tl.to('.leftTitle', { y: -1000, duration: .6 })
    tl.to('.rightTitle', { y: 1000, duration: .6 }, "<")
    tl.to('.slideContent', { x: `${props.offsets[1]}`, duration: 0 })
    sessionStorage.setItem("slideNum", 1);
    emit("changeConversation");
}

defineExpose({
    reverse,
})
</script>

<template>
    <div class="bg-[url('@/assets/bg/index.png')] bg-[length:100%_100%] flex justify-end flex-col lg:bg-[url('@/assets/bg/index_pc.png')]" @wheel.stop="moveWord">
        <img v-if="!isPC" class="w-[65%] mx-auto md:w-[60%]"  src="@/assets/main/title.png">
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


