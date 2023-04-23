<script setup>
import { sleep } from '@/utils/common';
import IndexContent from '@/components/IndexContent.vue';
import Conversation from '@/components/Conversation.vue';
import ShakeHand from '@/components/ShakeHand.vue';
import Article from '@/components/Article.vue';
import ProgressBar from '@/components/ProgressBar.vue';
import Footer from '@/components/Footer.vue';
import Scroll from '@/components/Scroll.vue';

import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';
import { onMounted, ref, inject, nextTick, onBeforeUnmount } from 'vue';

gsap.registerPlugin(ScrollTrigger);

const isPC = inject('isPC');
const activeSlide = ref(0);
const offsets = ref([]);
const slideArr = ref([]);
const conversationDom = ref(null);
const indexContentDom = ref(null);
const startPos = ref({ x: 0, y: 0 });
const endPos = ref({ x: 0, y: 0 });
const content = [
  "我捐的錢全部都要用在弱勢身上！",
  "可是所有服務都有必要支出，\n如果沒人支持就無法幫助弱勢。",
  "我理解，\n但服務不包括幫社工加薪吧？",
  "合理的薪資才能留住人才，\n讓弱勢接受更好的服務。",
  "既然這樣，\n為什麼要浪費資源幫助更生人？\n他們都是壞人耶。",
  "更生人已經受過處罰，\n協助他們回歸社會不再走回頭路。",
  "回歸社會？這和我有什麼關係？",
  "多一位好人、少一名壞人，\n你我和社會都受益。"
]

function setSilde(e) {
  console.log("setSilde");
  // if (gsap.isTweening(".slideContent")) return;
  if ((!activeSlide.value && e.deltaY < 0) || (activeSlide.value === 10 && e.deltaY > 0) || activeSlide.value === 9) return;
  e.deltaY > 0 ? slideAni("next") : slideAni("prev");
}
function slideAni(type) {
  console.log("slideAni");
  // if (gsap.isTweening(".slideContent")) return;
  type === "next" ? (activeSlide.value += 1) : (activeSlide.value -= 1);
  sessionStorage.setItem("slideNum", activeSlide.value);
  // isBackConversation && changeConversation();
  gsap.to(".slideContent", { x: offsets.value[activeSlide.value], opacity: 0.5, duration: 0 }, "<");
  gsap.to(".slideContent", { opacity: 1 , duration: 1})
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
  if (Math.abs(y) > Math.abs(x)) {
    if (activeSlide.value > 0 && y > 5) {
      console.log("下滑");
      slideAni("prve");
    } else if (activeSlide.value < 9 && y < -5) {
      console.log("上滑");
      slideAni("next")
    }
  }
}

//解決safari vh問題
function safariHacks() {
  let windowsVH = window.innerHeight / 100;
  document.documentElement.style.setProperty('--vh', `${windowsVH}px`);
  document.documentElement.style.setProperty('--vh', `${windowsVH}px`);
  window.addEventListener('resize', function () {
    document.documentElement.style.setProperty('--vh', `${windowsVH}px`);
  });
}
function getSlider() {
  offsets.value = [];
  slideArr.value = document.querySelectorAll(".slides");
  for (let i = 0; i < slideArr.value.length; i++) {
    offsets.value.push(-slideArr.value[i].offsetLeft);
  }
  console.log("offsets");
  sessionStorage.getItem("slideNum") > 0 && changeSlide();
}
function changeSlide() {
  console.log("changeSlide");
  activeSlide.value = Number(sessionStorage.getItem("slideNum"));
  gsap.set('.slideContent', { x: offsets.value[activeSlide.value] });
}
function changeConversation() {
  console.log("changeConversation");
  activeSlide.value = Number(sessionStorage.getItem("slideNum"));
  !activeSlide.value && indexContentDom.value.reverse();
}
onMounted(() => {
  nextTick(async () => {
    safariHacks();
    await sleep();
    getSlider();
  });
  window.addEventListener("resize", getSlider);
  document.body.style = "overflow:hidden";
});
onBeforeUnmount(() => {
  document.body.style = "";
});
</script>

<template>
  <div :class="['overflow-hidden lg:h-screen relative', isPC ? 'h-screen' : 'wrap']">
    <div class="slideContent w-full h-full flex relative" @wheel="setSilde" @touchstart="touchstart"
      @touchmove="touchmove" @touchend="touchend">
      <IndexContent ref="indexContentDom" class="slides" :offsets="offsets" @changeConversation="changeConversation" />
      <Conversation ref="conversationDom" class="slides" v-for="(item, idx) in content" :key="'slides' + idx"
        :content="{ idx: idx + 1, text: item }" :offsets="offsets" @changeConversation="changeConversation" />
      <ShakeHand class="slides" @changePage="slideAni" />
      <Article class="slides" @changeSlide="changeSlide" />
    </div>
    <Scroll v-if="isPC && activeSlide < 9" />
  </div>
  <template v-if="!isPC">
    <ProgressBar :nowPage="activeSlide" />
    <Footer @changeSlide="changeSlide" />
  </template>
</template>

<style scoped>
.slides {
  @apply min-w-full relative;
}

.wrap {
  height: calc(var(--vh, 1vh) * 100 - 45px);
}
</style>
