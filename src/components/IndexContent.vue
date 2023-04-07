<script setup>
import { ref } from 'vue';

</script>

<template>
    <div class="bg-[url('@/assets/bg/index.png')] bg-[length:100%_100%] flex justify-end flex-col lg:bg-[url('@/assets/bg/index_pc.png')]">
        <img class="w-[65%] mx-auto md:w-[60%] lg:w-[34%] lg:absolute lg:right-0 lg:left-0 lg:bottom-[28%]" src="@/assets/main/title.png">
        <div class="flex w-full mt-2.5 lg:justify-between lg:px-[1%]">
            <img class="w-1/2 lg:w-[32%]" src="@/assets/main/leftman.png">
            <img class="w-1/2 lg:w-[32%]" src="@/assets/main/rightman.png">
        </div>
    </div>
</template>


