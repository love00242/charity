<script setup>
import IndexContent from '@/components/IndexContent.vue';
import Conversation from '@/components/Conversation.vue';

import ProgressBar from '@/components/ProgressBar.vue';
import Footer from '@/components/Footer.vue';
const content = [
  "我捐的錢全部都要用在弱勢身上！",
  "可是所有服務都有必要支出，\n如果沒人支持就無法幫助弱勢。",
  "我理解，\n但服務不包括幫社工加薪吧？",
  "合理的薪資才能留住人才，\n讓弱勢接受更好的服務。",
  "既然這樣，\n為什麼要浪費資源幫助更生人？\n他們都是壞人耶。",
  "更生人已經受過處罰，\n協助他們回歸社會不再走回頭路。",
  "回歸社會？這和我有什麼關係？",
  "多一位好人、少一名壞人，\n你我和社會都受益。"
]
</script>

<template>
  <div class="w-full h-[calc(100vh-45px)] relative">
    <!-- <IndexContent /> -->
    <Conversation :content="{ idx: 1, text: content[0] }" />
  </div>
  <ProgressBar />
  <Footer />
</template>
