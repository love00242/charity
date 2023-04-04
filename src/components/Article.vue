<script setup>
import gearIcon from '@/assets/icon/article1.svg';
import moneyIcon from '@/assets/icon/article2.svg';
import phoneIcon from '@/assets/icon/article3.svg';
import heartIcon from '@/assets/icon/article4.svg';
import plantIcon from '@/assets/icon/article5.svg';
import router from "@/router";

const slideArr = [
    { title: "「搞創新，9成都失敗」台灣社福輸在哪？", icon: gearIcon },
    { title: "錢不到位、心又委屈，他們只靠「積福報」苦撐。", icon: moneyIcon },
    { title: "擁抱數位轉型浪潮，社福卻差點滅頂，為什麼？", icon: phoneIcon },
    { title: "社福進社區做好事，為什麼卻被下跪抗議？", icon: heartIcon },
    { title: "善與惡的拔河，你希望誰獲勝。", icon: plantIcon },
]
const goDetail = () => {
    console.log("goDetail");
    router.push("/articledetail");
}
</script>

<template>
    <div
        class="relative bg-[length:100%_100%] flex flex-col bg-[url('@/assets/bg/shakehand.png')] overflow-hidden">
        <img class="absolute max-w-fit h-[120px] -left-[30%] top-[10%]" src="@/assets/icon/shakehand2.svg">
        <div class="w-full h-full absolute bg-[#fff]/20 backdrop-blur left-0 right-0" />
        <div class="w-[90%] m-auto z-[1] pt-[35%]">
            <ul class="container flex overflow-auto p-5 pb-6">
                <li 
                    v-for="slide in slideArr" 
                    :key="slide"
                    @click="goDetail"
                    class="border-[0.5px] border-secondary rounded-[5px] bg-[#fff] flex flex-col items-center justify-around min-h-[270px] mx-2 px-5 min-w-[250px]">
                    <img :src="slide.icon">
                    <h2 class="text-2xl text-left">{{ slide.title }}</h2>
                    <div class="flex mr-auto">
                        <p class="text-primary text-xl">看文章</p>
                        <img class="-rotate-90 ml-[15px]" src="@/assets/icon/scroll.svg">
                    </div>
                </li>
            </ul>
            <div class="flex mt-4">
                <img class="w-8 mr-1.5" src="@/assets/icon/mail.svg">
                <input type="text" class="h-9 px-2 border text-primary border-primary text-lg placeholder:text-[#ccc] placeholder:font-light focus:" placeholder="Email">
            </div>
            <p class="text-primary text-xl mt-1.5 pl-9">我願意收到新文章的上線提醒</p>
            <button class="ml-9 mt-2 mb-3 w-[93px] text-lg">送出</button>
        </div>
    </div>
</template>

<style scoped>

.container::-webkit-scrollbar {
    @apply h-0.5;
}
.container::-webkit-scrollbar-track {
    @apply bg-[#b8b8b8];
}
.container::-webkit-scrollbar-thumb {
    @apply bg-[#434343]; 
}

</style>