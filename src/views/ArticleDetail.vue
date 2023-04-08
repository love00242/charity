<script setup>
import Footer from '@/components/Footer.vue';
import { articleList, articleTitle } from '@/utils/config/articleConfig';
import { onMounted, ref, nextTick } from 'vue';
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
const container = ref(null);
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
const sendData = () => {
    console.log("sendData");
    if (topAns.value === null || bottomAns.value === null || member === "" || gender === "" || ageRange === null) {
        alert("還有題目尚未作答");
        return
    }
}
const goBack = () => {
    console.log("goBack");
}
const goArticle = (num) => {
    router.replace({path: '/articledetail', query: { article: num }});
}
onMounted(() => {
    console.log("query", route.query);
    articleNum.value = route.query.article;
    otherArticle.value = articleTitle.filter(item => item.num !== Number(articleNum.value));
});
</script>

<template>
    <div ref="container" class="overflow-auto">
        <div
            :class="['bg-[length:100%_100%] h-[calc(100vh-45px)] text-white flex flex-row-reverse justify-center items-center', `article${articleNum}`]">
            <h2 class="[writing-mode:vertical-rl] font-bold text-[40px]">{{ articleList[articleNum - 1].title }}<p
                    class="mr-[5px] normal text-[29px]">{{ articleList[articleNum - 1].subTitle }}</p>
            </h2>
        </div>
        <Footer :isInner="true" />
        <section class="yellowArea">
            <p class="text-primary mb-5">{{ articleList[articleNum - 1].questionTop }}</p>
            <ul class="flex text-center mb-1">
                <li v-for="(item, i) in articleList[articleNum - 1].ansArrTop" :key="'topAns' + i"
                    :class="['chooseBox mr-2 w-full', { 'active': topAns === i }]" @click="changeState('topAns', i)">
                    <label :for="i">{{ item }}</label>
                </li>
            </ul>
            <p v-if="topAns" class="text-center text-[15px]">謝謝你的作答</p>
        </section>
        <!-- 內文作者 -->
        <section class="px-5 text-lg">
            <p class="font-medium">{{ articleList[articleNum - 1].author }}</p><br />
            <p class="text-justify mb-5 whitespace-pre-line">{{ articleList[articleNum - 1].authorContent }}</p>
            <template v-if="articleList[articleNum - 1].authorPhoto">
                <img class="mt-8 mb-2" :src="`/assets/article${articleNum}/author.png`">
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
                <section class="mt-10 px-5" v-for="(val, k) in item.content" :key="'content' + k">
                    <p class="text-[25px] font-bold mb-4 whitespace-pre-line">{{ item.title }}</p>
                    <p class="text-lg whitespace-pre-line mb-12">{{ val.text }}</p>
                    <template v-if="val.photoNum.length > 0">
                        <img v-for="(num, n) in val.photoNum" :key="'contentImg' + n"
                            :src="`/assets/article${articleNum}/pic${num}.png`" class="mb-2">
                        <small class="flex mb-10">{{ val.photoCaption }}</small>
                    </template>
                </section>
            </template>
        </template>

        <span class="text-lg flex my-12 px-5">關鍵字 〉<p class="font-bold">數位轉型、平行公益、傳善獎</p></span>

        <section class="yellowArea">
            <p class="text-primary mb-5 whitespace-pre-line">{{ articleList[articleNum - 1].questionBottom }}</p>
            <ul class="flex text-center">
                <li v-for="(ans, m) in articleList[articleNum - 1].ansArrBottom" :key="'ansArrBottom' + m"
                    :class="['chooseBox mr-1.5 w-[30%] mb-1', { 'active': bottomAns === m }]"
                    @click="changeState('bottomAns', m)">
                    <label :for="m">{{ ans }}</label>
                </li>
            </ul>
            <p v-if="bottomAns" class="text-center text-[15px]">謝謝你的作答</p>
        </section>
        <section class="yellowArea flex flex-col">
            <p class="text-primary mb-5">我是....</p>
            <ul class="flex text-center mb-4">
                <li v-for="(item, i) in memberList" :key="'member' + i"
                    :class="['chooseBox mr-1.5 w-2/5', { 'active': member === item.value }]"
                    @click="changeState('member', item.value)">
                    <label :for="item.value">{{ item.text }}</label>
                </li>
            </ul>
            <ul class="flex text-center mb-4">
                <li v-for="(item, i) in genderList" :key="'gender' + i"
                    :class="['chooseBox mr-1.5 w-[15%]', { 'active': gender === item.value }]"
                    @click="changeState('gender', item.value)">
                    <label :for="item.value">{{ item.text }}</label>
                </li>
            </ul>
            <ul class="flex text-center flex-wrap mb-8">
                <li v-for="(item, i) in ageRangeList" :key="'ageRange' + i"
                    :class="['chooseBox mr-1.5 w-[30%] mb-1', { 'active': ageRange === item.value }]"
                    @click="changeState('ageRange', item.value)">
                    <label :for="item.value">{{ item.text }}</label>
                </li>
            </ul>
            <button class="btn w-[120px] py-3 mx-auto" @click="sendData">確定</button>
        </section>
        <div class="flex justify-center mb-8">
            <button class="btn w-[120px] py-3 text-lg flex items-center justify-center" @click="goBack">
                回前頁
                <img src="@/assets/icon/back.svg" class="w-4 ml-1">
            </button>
        </div>
        <ul class="flex flex-col mt-10 mb-8 px-5 text-lg text-[#5C5B5B]">
            <li v-for="(item, i) in otherArticle.slice(0, 3)" :key="'article' + i" class="flex mb-2" @click="goArticle(item.num)">
                <p class="w-[40%]">{{ item.title }}</p>
                <img :src="`assets/article${item.num}/bg_pc.png`" class="w-[60%] min-h-[135px]">
            </li>
        </ul>
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
    @apply bg-secondary rounded-lg mx-5 my-10 px-5 py-6 text-lg;
}

.chooseBox {
    @apply bg-white text-[#949494] rounded-[3px] py-2;
}

.active {
    @apply bg-primary text-secondary;
}
</style>