<script setup>
// import { ref } from 'vue';

const props = defineProps({
  nowPage: {
    type: Number,
    default: 0,
  }
});
</script>

<template>
  <span 
    class="fixed bottom-[45px] bg-secondary h-[5px]" 
    :style="`width:${(nowPage / 12) * 100}%`"
  >
  </span>
</template>


