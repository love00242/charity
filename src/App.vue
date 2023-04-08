<script setup>
import { RouterView, useRoute } from 'vue-router';
import { debounce } from '@/utils/common';
import { ref, provide, onMounted, computed } from 'vue';
 
const route = useRoute()
 
const routerKey = computed(() => {
  return route.path + Math.random();
})

const isPC = ref(window.innerWidth >= 1024);

provide("isPC", isPC);

onMounted(() => {
  window.addEventListener('resize', debounce(() => {
    isPC.value = window.innerWidth >= 1024;
  }));
});
</script>

<template>
  <RouterView :key="routerKey" />
</template>
