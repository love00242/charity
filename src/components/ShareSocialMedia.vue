<script setup>
import { ref, inject } from 'vue';
import fbSvg from '@/assets/icon/fb.svg';
import lineSvg from '@/assets/icon/line.svg';
import share_pc from '@/assets/icon/share_pc.svg';
import share_pc_yellow from '@/assets/icon/share_pc_yellow.svg';
import close from '@/assets/icon/close.svg';
import close_pc from '@/assets/icon/close_pc.svg';
const props = defineProps({
    isArticleDetail: {
        type: Boolean,
        default: false,
    }
});

const shareTypeList = [
    { type: "fb", svg: fbSvg },
    { type: "line", svg: lineSvg },
];
const isPC = inject('isPC');
const url = window.location.href;
const isOpenShare = ref(false);
const toggleShare = () => {
    console.log("toggleShare");
    isOpenShare.value = !isOpenShare.value;
};
</script>

<template>
    <template v-if="isPC">
        <p v-if="!isOpenShare" @click="toggleShare" :class="['flex rounded-[3px] justify-center items-center text-lg cursor-pointer', isArticleDetail ? 'btn py-3 w-[240px]' : 'w-24 bg-[#434343] text-secondary leading-[unset] h-[37px]'
        ]">
            分享<img :src="isArticleDetail ? share_pc : share_pc_yellow" class="w-4 ml-1.5">
        </p>
    </template>
    <template v-else>
        <img v-if="!isOpenShare" src="@/assets/icon/share.svg" class="cursor-pointer" @click="toggleShare">
    </template>

    <div
        :class="['share relative origin-left', isOpenShare ? 'scale-x-100  opacity-100 w-auto flex items-center' : 'scale-x-0 h-0 opacity-0 hidden']">
        <div v-if="isPC" class="w-[37px] h-[37px] absolute -left-1 flex items-center justify-center bg-[#434343] rounded-[3px] border border-secondary cursor-pointer" @click="toggleShare">
            <img :src="close_pc">
        </div>
        <img v-else :src="close" class="absolute cursor-pointer h-auto" @click="toggleShare">
        <!-- duration-100 -->
        <ul
            :class="['flex items-center pl-9 pr-2 py-1', !isPC ? 'border border-secondary rounded-full' : 'bg-[#434343] rounded-[3px] h-[35px]']">
            <li v-for="(item, i) in shareTypeList" :key="i" class="mx-2">
                <ShareNetwork v-if="item.type === 'fb'" network="facebook" :url="url" :title="''">
                    <img :src="item.svg">
                </ShareNetwork>
                <a v-else :href="`https://social-plugins.line.me/lineit/share?url=${url}`" target="_blank">
                    <img :src="item.svg" class="line">
                </a>
            </li>
        </ul>
    </div>
</template>

<style scoped></style>
