<script setup>
import IndexContent from '@/components/IndexContent.vue';
import ProgressBar from '@/components/ProgressBar.vue';
import Footer from '@/components/Footer.vue';
</script>

<template>
  <div class="w-full h-[calc(100vh-45px)] relative">
    <IndexContent />
  </div>
  <ProgressBar />
  <Footer />
</template>
