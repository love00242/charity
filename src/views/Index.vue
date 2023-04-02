<script setup>
import IndexContent from '@/components/IndexContent.vue';
import Conversation from '@/components/Conversation.vue';
import ShakeHand from '@/components/ShakeHand.vue';
import Article from '@/components/Article.vue';
import ProgressBar from '@/components/ProgressBar.vue';
import Footer from '@/components/Footer.vue';

import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';
import { onMounted, ref } from 'vue';

gsap.registerPlugin(ScrollTrigger);

const activeSlide = ref(0);
const offsets = ref([]);
const slideArr = ref([]);
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
  console.log("setSilde", gsap.isTweening(".slideContent"));
  if (gsap.isTweening(".slideContent")) return;
  if (!activeSlide.value && e.deltaY < 0 || activeSlide.value === 10 && e.deltaY > 0) return;
  if (activeSlide.value === 9) return;
  activeSlide.value = e.deltaY > 0 ? (activeSlide.value += 1) : (activeSlide.value -= 1);
  slideAni();
}
function slideAni() {
  console.log("slideAni", activeSlide.value);
  gsap.to(".slideContent", { x: offsets.value[activeSlide.value], ease: "expo.out", duration: 1.5 });
}
function changePage(val) {
  console.log("ccc", val);
  activeSlide.value = val === "next" ? 10 : 8;
  slideAni();
}
onMounted(() => {
  slideArr.value = gsap.utils.toArray(".slides");
  for (let i = 0; i < slideArr.value.length; i++) {
    offsets.value.push(-slideArr.value[i].offsetLeft);
  }
  console.log("123", slideArr.value);
});
</script>

<template>
  <div class="w-full h-[calc(100vh-45px)] overflow-hidden">
    <div class="slideContent w-full h-full flex" @wheel.stop="setSilde">
      <!-- <IndexContent class="slides" />
      <Conversation class="slides" v-for="(item, idx) in content" :key="'slides' + idx"
        :content="{ idx: idx + 1, text: item }" /> -->
      <!-- <ShakeHand class="slides" @changePage="changePage" /> -->
      <Article class="slides" />
    </div>
  </div>
  <ProgressBar :nowPage="activeSlide" />
  <Footer />
</template>

<style scoped>
.slides {
  @apply min-w-full relative;
}
</style>
