<script setup>
import gsap from 'gsap';
import { ref } from 'vue';
const emit = defineEmits(['changePage']);

const isFinish = ref(false);
const tl = gsap.timeline();
function slideAni(e) {
    console.log("123", tl.isActive());
    if (e.deltaY < 0) {
        !isFinish.value && emit("changePage", "prev");
        isFinish.value = false;
        tl.reverse(-1);
        return
    } else if (e.deltaY > 0 && isFinish.value) {
        console.log("emit 下一頁");
        isFinish.value = false;
        emit("changePage", "next")
        return
    }
    tl.play();
    tl.to('.lefthand', { x: 45, duration: .6 })
    tl.to('.righthand', { x: -45, duration: .6 }, "<")
    tl.to('.lefthand', { opacity: 0, duration: .1 })
    tl.to('.righthand', { opacity: 0, duration: .1 }, "<")
    tl.to('.shakehand1', { opacity: 1, duration: .1 }, "<")
    tl.to('.shakehand2', { opacity: 1, duration: .1 },)
    tl.to('.words', {
        opacity: 1, duration: .8, onComplete: () => {
            isFinish.value = true;
        }
    })
}
</script>

<template>
    <div class="flex flex-col justify-around bg-[length:100%_100%] bg-[url('@/assets/bg/shakehand.png')] overflow-hidden"
        @wheel="slideAni">
        <div class="flex relative h-1/2 py-5">
            <img class="lefthand absolute -left-[55%] min-h-[120px]" src="@/assets/icon/lefthand.svg">
            <img class="righthand absolute -right-[55%] min-h-[120px]" src="@/assets/icon/righthand.svg">
            <img class="shakehand1 absolute max-w-fit h-[120px] -left-[30%] opacity-0" src="@/assets/icon/shakehand1.svg">
            <img class="shakehand2 absolute max-w-fit h-[120px] -left-[30%] opacity-0" src="@/assets/icon/shakehand2.svg">
        </div>
        <span class="words text-center font-medium text-2xl text-primary opacity-0">
            民眾和社福就像平行線，<br>
            沒有交集，<br>
            如果我們多一點同理，<br>
            看見彼此的想法與難處，<br>
            就能互相靠近，<br>
            前往共好包容的未來。
        </span>
    </div>
</template>

<style scoped></style>