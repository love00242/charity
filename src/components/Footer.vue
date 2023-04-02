<script setup>
import { ref } from 'vue';
import fbSvg from '@/assets/icon/fb.svg';
import lineSvg from '@/assets/icon/line.svg';

const shareTypeList = [
  { type: "fb", svg: fbSvg },
  { type: "line", svg: lineSvg },
];
const isOpenShare = ref(false);
const toggleShare = () => {
  console.log("toggleShare");
  isOpenShare.value = !isOpenShare.value;
};
const share = (val) => {
  console.log("share", val);
}
</script>

<template>
  <div class="bg-primary flex items-center justify-between h-[45px] w-full px-3.5 py-1 fixed bottom-0">
    <div class="flex">
      <img class="mr-3" src="@/assets/icon/home.svg">
      <img v-if="!isOpenShare" src="@/assets/icon/share.svg" class="cursor-pointer" @click="toggleShare">
      <div :class="['relative duration-100 origin-left', isOpenShare ? 'scale-x-100': 'scale-x-0 opacity-0']">
        <img src="@/assets/icon/close.svg" class="absolute"
          @click="toggleShare">
        <ul class="flex items-center border border-secondary rounded-full pl-9 pr-2 py-1">
          <li v-for="(item, i) in shareTypeList" :key="i" class="mx-2">
            <img :src="item.svg" @click="share(item.type)">
          </li>
        </ul>
      </div>
    </div>
    <!-- <img src="@/assets/icon/scroll.svg"> -->
  </div>
</template>

<style scoped>
</style>

