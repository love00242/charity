<script setup>
import { RouterView } from 'vue-router';
import { debounce } from '@/utils/common';
import { ref, provide, onMounted } from 'vue';

const isPC = ref(window.innerWidth >= 1024);

provide("isPC", isPC);

onMounted(() => {
  window.addEventListener('resize', debounce(() => {
    isPC.value = window.innerWidth >= 1024;
  }));
});
</script>

<template>
  <RouterView />
</template>
