<script setup>
import { RouterView, useRoute } from 'vue-router';
import { debounce } from '@/utils/common';
import { ref, provide, onMounted, computed, watch } from 'vue';
import { articleList } from '@/utils/config/articleConfig';

const route = useRoute();

const routerKey = computed(() => {
  return route.path + Math.random();
})

const isPC = ref(window.innerWidth >= 1024);
const url = window.location.href;

provide("isPC", isPC);

watch(() => route?.query, () => {
  console.log("route.path", route.path, url, articleList[0].title);

  if (route.path.includes("articledetail")) {
    const articleNum = route?.query.article;
    const title = articleList[articleNum - 1].title + ' ' + articleList[articleNum - 1].subTitle;
    document
      .querySelector('meta[property="og:url"]')
      .setAttribute("content", `https://charity-love00242.vercel.app/#/articledetail?article=${articleNum}`);
    document
      .querySelector('meta[property="og:image"]')
      .setAttribute("content", `https://charity-love00242.vercel.app/meta_article${articleNum}.png`);
    document
      .querySelector('meta[property="og:title"]')
      .setAttribute("content", title);
    document.title = title;
  } else {
    // document
    //   .querySelector('meta[property="og:url"]')
    //   .setAttribute("content", "https://event.udn.com/auroratrust/");
    document
      .querySelector('meta[property="og:url"]')
      .setAttribute("content", "https://charity-love00242.vercel.app/");
    document
      .querySelector('meta[property="og:image"]')
      .setAttribute("content", "https://charity-love00242.vercel.app/meta_index.png");
    document
      .querySelector('meta[property="og:title"]')
      .setAttribute("content", "「平行公益　縫合大眾與助人者的認知落差」");
    document.title = "「平行公益　縫合大眾與助人者的認知落差」";
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
