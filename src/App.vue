<script setup>
import { RouterView, useRoute } from 'vue-router';
import { debounce } from '@/utils/common';
import { ref, provide, onMounted, computed, watch } from 'vue';

const route = useRoute();

const routerKey = computed(() => {
  return route.path + Math.random();
})

const isPC = ref(window.innerWidth >= 1024);

provide("isPC", isPC);

watch(() => route.path, () => {
  console.log("route.path", route.path, route.query.article);

  if (route.path.includes("articledetail")) {
    document
      .querySelector('meta[property="og:url"]')
      .setAttribute("content", `https://event.udn.com/auroratrust/articledetail?article=${route?.query.article}`);
    document
      .querySelector('meta[property="og:image"]')
      .setAttribute("content", `https://event.udn.com/auroratrust/meta_article${route?.query.article}.png`);
  } else {
    document
      .querySelector('meta[property="og:url"]')
      .setAttribute("content", "https://event.udn.com/auroratrust/");
    document
      .querySelector('meta[property="og:image"]')
      .setAttribute("content", "https://event.udn.com/auroratrust/meta_index.png");
  }
})

onMounted(() => {
  window.addEventListener('resize', debounce(() => {
    isPC.value = window.innerWidth >= 1024;
  }));
});
</script>

<template>
  <RouterView :key="routerKey" />
</template>
