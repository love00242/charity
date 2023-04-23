<script setup>
import { RouterView, useRoute } from 'vue-router';
import { useMeta } from 'vue-meta';
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
  <metainfo></metainfo>
  <RouterView :key="routerKey" />
</template>
