<script setup>
import gsap from 'gsap';
import { ref, inject } from 'vue';
const emit = defineEmits(['changePage']);

const isPC = inject('isPC');
const isFinish = ref(false);
const tl = gsap.timeline();
const startPos = ref({ x: 0, y: 0 });
const endPos = ref({ x: 0, y: 0 });

function slideAni(e, type) {
    if (e?.deltaY < 0 || type === "prev") {
        !isFinish.value && emit("changePage", "prev");
        isFinish.value = false;
        tl.reverse(-1);
        return
    } else if ((e?.deltaY > 0 || type === "next") && isFinish.value) {
        console.log("emit 下一頁");
        isFinish.value = false;
        emit("changePage", "next")
        return
    }
    shakehandAni();
}

function shakehandAni() {
    const diff = isPC.value ? 130 : 0;
    tl.play();
    tl.to('.lefthand', { x: 175 - diff, duration: .6 })
    tl.to('.righthand', { x: -175 + diff, duration: .6 }, "<")
    tl.to('.lefthand', { opacity: 0, duration: .1 })
    tl.to('.righthand', { opacity: 0, duration: .1 }, "<")
    tl.to('.shakehand1', { opacity: 1, duration: .1 }, "<")
    tl.to('.shakehand2', { opacity: 1, duration: .1 })
    tl.to('.words', {
        opacity: 1, duration: .8, onComplete: () => {
            isFinish.value = true;
        }
    })
}
function touchstart(e) {
    e.preventDefault();
    startPos.x = e.changedTouches[0].pageX;
    startPos.y = e.changedTouches[0].pageY;
}
function touchmove(e) {
    e.preventDefault();
    endPos.x = e.changedTouches[0].pageX;
    endPos.y = e.changedTouches[0].pageY;
}
function touchend() {
    const x = endPos.x - startPos.x;
    const y = endPos.y - startPos.y;
    if (Math.abs(y) > Math.abs(x)) {
        if (y > 0) {
            console.log("下滑", y);
            slideAni(null, "next")
        } else if (y < 0) {
            console.log("上滑 hand", y);
            slideAni(null, "prev");
        }
    }
}
</script>

<template>
    <div class="flex flex-col justify-around bg-[length:100%_100%] bg-[url('@/assets/bg/shakehand.png')] overflow-hidden lg:bg-[url('@/assets/bg/shakehand_pc.png')] w-full"
        @wheel.stop="slideAni" @touchstart="touchstart" @touchmove="touchmove" @touchend.stop="touchend">
        <div class="flex relative h-1/2 py-5 justify-center">
            <img class="lefthand absolute -left-[100%] h-[139px] md:h-[260px] lg:-left-[10%] lg:h-[342px] lg:w-1/2"
                src="@/assets/icon/lefthand.svg">
            <img class="righthand absolute -right-[100%] h-[139px] md:h-[260px] lg:-right-[10%] lg:h-[342px] lg:w-1/2"
                src="@/assets/icon/righthand.svg">
            <img class="shakehand1 absolute opacity-0 max-w-fit h-[139px] md:h-[260px] 2xl:h-[400px]"
                src="@/assets/icon/shakehand1.svg">
            <img class="shakehand2 absolute opacity-0 max-w-fit h-[139px] md:h-[260px] 2xl:h-[400px]"
                src="@/assets/icon/shakehand2.svg">
        </div>
        <span class="words text-center font-medium text-2xl text-primary opacity-0 lg:text-5xl lg:leading-snug">
            民眾和社福就像平行線，<br v-if="!isPC" />
            沒有交集，<br />
            如果我們多一點同理，<br v-if="!isPC" />
            看見彼此的想法與難處，<br />
            就能互相靠近，<br v-if="!isPC" />
            前往共好包容的未來。
        </span>
    </div>
</template>

<style scoped></style>