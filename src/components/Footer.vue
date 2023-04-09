<script setup>
import Scroll from '@/components/Scroll.vue';
import ShareSocialMedia from '@/components/ShareSocialMedia.vue';

const props = defineProps({
  isInner: {
    type: Boolean,
    default: false,
  }
});
</script>

<template>
  <div
    :class="['bg-primary flex items-center justify-between h-[45px] w-full pl-3.5 pr-2 py-1', { 'fixed bottom-0': !isInner }]">
    <div class="flex">
      <img class="mr-3" src="@/assets/icon/home.svg">
      <ShareSocialMedia />
    </div>
    <Scroll />
  </div>
</template>

<style scoped></style>

