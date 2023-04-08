<script setup>
import gearIcon from '@/assets/icon/article1.svg';
import moneyIcon from '@/assets/icon/article2.svg';
import phoneIcon from '@/assets/icon/article3.svg';
import heartIcon from '@/assets/icon/article4.svg';
import plantIcon from '@/assets/icon/article5.svg';
import router from "@/router";
import { ref, inject } from 'vue';

const slideArr = [
    { num: 1, title: "「搞創新，9成都失敗」台灣社福輸在哪？", icon: gearIcon },
    { num: 2, title: "錢不到位、心又委屈，他們只靠「積福報」苦撐。", icon: moneyIcon },
    { num: 3, title: "擁抱數位轉型浪潮，社福卻差點滅頂，為什麼？", icon: phoneIcon },
    { num: 4, title: "社福進社區做好事，為什麼卻被下跪抗議？", icon: heartIcon },
    { num: 5, title: "善與惡的拔河，你希望誰獲勝。", icon: plantIcon },
]
const isPC = inject('isPC');
const container = ref(null);
const startX = ref(0);
const scrollLeft = ref(0);
const isDrag = ref(false);
const mail = ref("");

const goDetail = () => {
    if (isDrag.value) return;
    console.log("goDetail");
    router.push("/articledetail");
}
const mousedown = (e) => {
    isDrag.value = true;
    startX.value = e.pageX - container.value.offsetLeft;
    scrollLeft.value = container.value.scrollLeft;
}
const mousemove = (e) => {
    if (!isDrag.value) return;
    const moveX = e.pageX - container.value.offsetLeft;
    const distance = (moveX - startX.value) * 3;
    container.value.scrollLeft = scrollLeft.value - distance;
}
const mouseup = () => {
    isDrag.value = false;
}
const scroll = (type) => {
    type === "right" ? container.value.scrollLeft += 60 : container.value.scrollLeft -= 60;
}
const sendMail = () => {
    const mailRegex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(mail.value === "") {
        alert("請輸入電子信箱");
        return;
    }
    if(!mailRegex.test(mail.value)) {
        alert("請輸入正確Email格式");
        return;
    }
    alert("送出成功!")
}
</script>

<template>
    <div
        class="relative bg-[length:100%_100%] flex flex-col bg-[url('@/assets/bg/shakehand.png')] overflow-hidden items-center">
        <img class="absolute h-[139px] max-w-fit md:h-[260px] 2xl:h-[400px] top-[5%]" src="@/assets/icon/shakehand2.svg">
        <div class="w-full h-full absolute bg-[#fff]/20 backdrop-blur left-0 right-0" />
        <div class="w-[90%] m-auto z-[1] pt-[35%] md:pt-[25%] lg:pt-0">
            <div class="flex items-center">
                <button v-if="isPC" class="text-3xl cursor-pointer" @click="scroll('left')">{{ "<" }}</button>
                        <ul ref="container" class="container flex overflow-auto p-5 pb-6 mx-2" @mousedown="mousedown"
                            @mousemove.prevent="mousemove" @mouseup="mouseup">
                            <li v-for="slide in slideArr" :key="slide" @click="goDetail"
                                class="border-[0.5px] border-secondary rounded-[5px] bg-[#fff] flex flex-col items-center justify-around min-h-[270px] mx-2 px-5 min-w-[250px] w-[250px]">
                                <img :src="slide.icon">
                                <h2 class="text-2xl text-left">{{ slide.title }}</h2>
                                <div class="flex mr-auto">
                                    <p class="text-primary text-xl">看文章</p>
                                    <img class="-rotate-90 ml-[15px]" src="@/assets/icon/scroll.svg">
                                </div>
                            </li>
                        </ul>
                        <button v-if="isPC" class="text-3xl cursor-pointer border-none" @click="scroll('right')">{{ ">"
                        }}</button>
            </div>
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-center lg:mt-8 lg:mb-6">
                <div class="flex mt-4 lg:mt-0 lg:mr-3">
                    <img class="w-8 mr-1.5" src="@/assets/icon/mail.svg">
                    <input type="text"
                        class="h-9 px-2 border text-primary bg-white border-primary text-lg placeholder:text-[#ccc] placeholder:font-light lg:text-xl"
                        placeholder="Email" v-model="mail">
                </div>
                <p class="text-primary text-xl mt-1.5 pl-9 lg:mt-0 lg:pl-0 lg:text-xl">我願意收到新文章的上線提醒</p>
            </div>
            <button class="btn ml-9 mt-2 mb-3 w-[93px] text-lg lg:block lg:m-auto" @click="sendMail">送出</button>
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