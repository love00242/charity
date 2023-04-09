<script setup>
import Scroll from '@/components/Scroll.vue';
import ShareSocialMedia from '@/components/ShareSocialMedia.vue';
import router from "@/router";
const emit = defineEmits(["changeSlide"])

const props = defineProps({
  isInner: {
    type: Boolean,
    default: false,
  }
});
const goHome = () => {
  sessionStorage.setItem("slideNum", 0);
  router.push({ name: 'Idx' });
  emit("changeSlide");
}
</script>

<template>
  <div
    :class="['bg-primary flex items-center justify-between h-[45px] w-full pl-3.5 py-1', { 'fixed bottom-0': !isInner }]">
    <div class="flex">
      <img class="mr-3" src="@/assets/icon/home.svg" @click="goHome">
      <ShareSocialMedia />
    </div>
    <Scroll />
  </div>
</template>

<style scoped></style>

