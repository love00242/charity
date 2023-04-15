<script setup>
import axios from 'axios';
import Footer from '@/components/Footer.vue';
import Scroll from '@/components/Scroll.vue';
import scrollTop from '@/components/scrollTop.vue';
import ShareSocialMedia from '@/components/ShareSocialMedia.vue';
import { articleList, articleTitle } from '@/utils/config/articleConfig';
import { onMounted, ref, inject, onBeforeUnmount } from 'vue';
import { useRoute } from "vue-router";
import router from "@/router";

const memberList = [
    { value: 0, text: "一般民眾" },
    { value: 1, text: "社福從業人員" },
]
const genderList = [
    { value: "boy", text: "男" },
    { value: "girl", text: "女" },
]
const ageRangeList = [
    { value: 0, text: "20歲以下" },
    { value: 1, text: "20-30歲" },
    { value: 2, text: "30-40歲" },
    { value: 3, text: "40-50歲" },
    { value: 4, text: "50-60歲" },
    { value: 5, text: "60歲以上" },
]
const isPC = inject('isPC');
const topDistance = ref(0);
const route = useRoute();
const topAns = ref(null);
const bottomAns = ref(null);
const member = ref("");
const gender = ref("");
const ageRange = ref(null);
const articleNum = ref(1);
const otherArticle = ref([]);

const changeState = (type, val) => {
    switch (type) {
        case "topAns":
            topAns.value = val;
            break
        case "bottomAns":
            bottomAns.value = val;
            break
        case "member":
            member.value = val;
            break
        case "gender":
            gender.value = val;
            break
        case "ageRange":
            ageRange.value = val;
            break
    }
    console.log("changeState", val);
}
async function sendData() {
    console.log("sendData");
    if (topAns.value === null || bottomAns.value === null || member === "" || gender === "" || ageRange === null) {
        alert("還有題目尚未作答");
        return
    }
    const api = `php/insertDataArticle.php`;
    const config = { headers: { 'Content-Type': 'multipart/form-data' } };
    const data = new FormData();
    data.append(`topAns${articleNum.value}`, topAns.value)
    data.append(`bottomAns${articleNum.value}`, bottomAns.value)
    data.append("member", member.value)
    data.append("gender", gender.value)
    data.append("ageRange", ageRange.value)

    const result = await axios.post(api, data, config);
    console.log(result.status);
}
const goBack = () => {
    router.push({ name: 'Idx' });
}
const goArticle = (num) => {
    router.replace({ path: '/articledetail', query: { article: num } });
}
const handleScroll = () => {
    topDistance.value = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop;
}
const goTop = () => {
    window.scrollTo(0, 0);
}
const goHome = () => {
    sessionStorage.setItem("slideNum", 0);
    router.push({ name: 'Idx' });
}
const getImageUrl = (type, num) => {
    switch (type) {
        case "author":
            return new URL(`../assets/article${articleNum.value}/author.png`, import.meta.url).href;
        case "pic":
            return  new URL(`../assets/article${articleNum.value}/pic${num}.png`, import.meta.url).href;
        case "bg":
            return  new URL(`../assets/article${num}/bg_pc.png`, import.meta.url).href;
    }
}

onMounted(() => {
    console.log("query", route.query);
    articleNum.value = route.query.article;
    otherArticle.value = articleTitle.filter(item => item.num !== Number(articleNum.value));
    window.addEventListener('scroll', handleScroll);
});
onBeforeUnmount(() => {
    window.addEventListener('scroll', handleScroll);
})
</script>

<template>
    <div class="overflow-auto lg:bg-secondary relative">
        <div
            :class="['bg-[length:100%_100%] h-[calc(100vh-45px)] text-white flex flex-row-reverse justify-center items-center relative lg:h-screen ]', `article${articleNum}`]">
            <h2 class="[writing-mode:vertical-rl] font-bold text-[40px] lg:[writing-mode:horizontal-tb] lg:text-6xl">{{
                articleList[articleNum - 1].title }}<p
                    class="mr-[5px] font-normal text-[29px] lg:text-6xl lg:text-center lg:mr-0 lg:mt-3 lg:font-bold">{{
                        articleList[articleNum - 1].subTitle }}</p>
            </h2>
            <template v-if="isPC">
                <img class="absolute w-12 left-8 top-8 cursor-pointer" src="@/assets/icon/home.svg" @click="goHome">
                <Scroll :isGray="true" />
            </template>
        </div>
        <Footer v-if="!isPC" :isInner="true" />
        <div class="lg:bg-white flex flex-col lg:mx-[120px] lg:px-[15%] lg:pt-10">
            <section class="yellowArea">
                <p class="text-primary mb-5 lg:border-b lg:border-b-[#707070] lg:pb-3">{{ articleList[articleNum -
                    1].questionTop }}</p>
                <ul class="flex text-center mb-1 lg:justify-center">
                    <li v-for="(item, i) in articleList[articleNum - 1].ansArrTop" :key="'topAns' + i"
                        :class="['chooseBox mr-2 w-full lg:w-[150px] lg:h-[60px] lg:leading-[60px]', { 'active': topAns === i }]"
                        @click="changeState('topAns', i)">
                        <label :for="i">{{ item }}</label>
                    </li>
                </ul>
                <p v-if="topAns !== null" class="text-center text-[15px]">謝謝你的作答</p>
            </section>
            <!-- 內文作者 -->
            <section class="px-5 text-lg lg:text-xl lg:pt-8">
                <p class="font-medium">{{ articleList[articleNum - 1].author }}</p><br />
                <p class="text-justify mb-5 whitespace-pre-line">{{ articleList[articleNum - 1].authorContent }}</p>
                <template v-if="articleList[articleNum - 1].authorPhoto">
                    <img class="mt-8 mb-2 lg:w-full" :src="getImageUrl('author')">
                    <small class="flex mb-10">{{ articleList[articleNum - 1].authorPhotoCaption }}</small>
                </template>
            </section>
            <!-- 段落 -->
            <template v-for="(item, i) in articleList[articleNum - 1].sections" :key="'articleSection' + i">
                <section v-if="item.isQuote" class="mt-10 px-5">
                    <img class="mt-12 mb-8 w-10" src="@/assets/icon/quote.svg">
                    <span class="flex flex-col text-[#949494] text-justify text-[26px] leading-[42px] font-normal mb-12">
                        {{ item.text }}<br>
                        <p class="text-lg mt-4">{{ item.author }}</p>
                    </span>
                </section>
                <template v-else>
                    <div v-if="item.isIframe" class="w-[calc(100%-40px)] h-0 pb-[56.25%] relative m-auto">
                        <iframe class="absolute w-full h-full top-0" src="https://www.youtube.com/embed/7C82b0gq0rQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                    <p
                        class="mt-10 px-5 text-[25px] font-bold mb-4 whitespace-pre-line lg:text-center lg:text-4xl lg:mb-7 lg:leading-tight">
                        {{ item.title }}</p>
                    <section class="px-5" v-for="(val, k) in item.content" :key="'content' + k">
                        <p class="text-lg whitespace-pre-line mb-12 lg:text-xl">{{ val.text }}</p>
                        <template v-if="val.photoNum.length > 0">
                            <img v-for="(num, n) in val.photoNum" :key="'contentImg' + n"
                                :src="getImageUrl('pic', num)" class="mb-2 lg:w-full">
                            <small class="flex mb-10">{{ val.photoCaption }}</small>
                        </template>
                    </section>
                </template>
            </template>

            <span class="text-lg flex my-12 px-5 lg:text-xl">關鍵字 〉<p class="font-bold">數位轉型、平行公益、傳善獎</p></span>

            <section class="yellowArea">
                <p class="text-primary mb-5 whitespace-pre-line lg:border-b lg:border-b-[#707070] lg:pb-3">{{
                    articleList[articleNum - 1].questionBottom }}</p>
                <ul class="flex text-center lg:justify-center lg:pt-5">
                    <li v-for="(ans, m) in articleList[articleNum - 1].ansArrBottom" :key="'ansArrBottom' + m"
                        :class="['chooseBox mr-1.5 w-[30%] mb-1 lg:w-[150px] lg:h-[60px] lg:leading-[60px]', { 'active': bottomAns === m }]"
                        @click="changeState('bottomAns', m)">
                        <label :for="m">{{ ans }}</label>
                    </li>
                </ul>
                <p v-if="bottomAns !== null" class="text-center text-[15px]">謝謝你的作答</p>
            </section>
            <section class="yellowArea flex flex-col">
                <p class="text-primary mb-5 lg:text-left lg:mb-10">我是....</p>
                <ul class="flex text-center mb-4">
                    <li v-for="(item, i) in memberList" :key="'member' + i"
                        :class="['chooseBox mr-1.5 w-2/5 lg:h-[60px] lg:leading-[60px]', { 'active': member === item.value }]"
                        @click="changeState('member', item.value)">
                        <label :for="item.value">{{ item.text }}</label>
                    </li>
                </ul>
                <ul class="flex text-center mb-4">
                    <li v-for="(item, i) in genderList" :key="'gender' + i"
                        :class="['chooseBox mr-1.5 w-[15%] lg:h-[60px] lg:leading-[60px]', { 'active': gender === item.value }]"
                        @click="changeState('gender', item.value)">
                        <label :for="item.value">{{ item.text }}</label>
                    </li>
                </ul>
                <ul class="flex text-center flex-wrap mb-8">
                    <li v-for="(item, i) in ageRangeList" :key="'ageRange' + i"
                        :class="['chooseBox mr-1.5 w-[30%] mb-1 lg:h-[60px] lg:leading-[60px]', { 'active': ageRange === item.value }]"
                        @click="changeState('ageRange', item.value)">
                        <label :for="item.value">{{ item.text }}</label>
                    </li>
                </ul>
                <button class="btn w-[120px] py-3 mx-auto lg:w-[240px]" @click="sendData">確定</button>
            </section>
            <div class="flex justify-center mb-8 lg:flex-col lg:items-center lg:mt-8">
                <button class="btn w-[120px] py-3 text-lg flex items-center justify-center lg:w-[240px] lg:mb-4"
                    @click="goBack">
                    回前頁
                    <img src="@/assets/icon/back.svg" class="w-4 ml-1">
                </button>
                <ShareSocialMedia v-if="isPC" :isArticleDetail="true"></ShareSocialMedia>
            </div>
            <ul class="flex flex-col mt-10 mb-8 px-5 text-lg text-[#5C5B5B] lg:flex-row lg:items-baseline">
                <li v-for="(item, i) in otherArticle.slice(0, 3)" :key="'article' + i"
                    class="flex mb-2 lg:flex-col-reverse lg:mx-2 lg:w-1/3" @click="goArticle(item.num)">
                    <p class="w-[40%] lg:w-full">{{ item.title }}</p>
                    <img :src="getImageUrl('bg', item.num)"
                        class="w-[60%] min-h-[135px] lg:min-h-[188px] lg:w-full object-cover">
                </li>
            </ul>
        </div>
        <scrollTop v-if="isPC && topDistance > 1000" @click="goTop" />
    </div>
</template>

<style scoped>
.article1 {
    @apply bg-[url('@/assets/article1/bg.png')] lg:bg-[url('@/assets/article1/bg_pc.png')];
}

.article2 {
    @apply bg-[url('@/assets/article2/bg.png')] lg:bg-[url('@/assets/article2/bg_pc.png')];
}

.article3 {
    @apply bg-[url('@/assets/article3/bg.png')] lg:bg-[url('@/assets/article3/bg_pc.png')];
}

.article4 {
    @apply bg-[url('@/assets/article4/bg.png')] lg:bg-[url('@/assets/article4/bg_pc.png')];
}

.article5 {
    @apply bg-[url('@/assets/article5/bg.png')] lg:bg-[url('@/assets/article5/bg_pc.png')];
}

.yellowArea {
    @apply bg-secondary rounded-lg mx-5 my-10 px-5 py-6 text-lg lg:w-[95%] lg:px-8 lg:text-center lg:text-2xl lg:mx-auto lg:my-3;
}

.chooseBox {
    @apply bg-white text-[#949494] rounded-[3px] py-2 lg:py-0;
}

.active {
    @apply bg-primary text-secondary;
}

/* 分享 */
:deep(.share) {
    @apply lg:flex;

    ul {
        @apply lg:w-[160px] lg:h-[54px] lg:pl-10;
    }

    > div {
        @apply lg:w-[60px] lg:h-[60px] lg:relative lg:left-5;
        img {
            @apply w-6;
        }
    }

    li {
        @apply lg:mr-6;
        img {
            @apply lg:h-8;
        }
        .line {
            @apply lg:h-7;
        }
    }
}
</style>