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
  useMeta({
    meta: [
      {
        name: 'keywords',
        content: "測試"
      },
      {
        property: "description",
        content: "測試測試"
      },
    ]
  })
});
</script>

<template>
  <RouterView :key="routerKey" />
</template>
