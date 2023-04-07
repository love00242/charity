<script setup>
import { ref } from 'vue';

</script>

<template>
    <div class="bg-[url('@/assets/bg/index.png')] bg-[length:100%_100%] flex justify-end flex-col lg:bg-[url('@/assets/bg/index_pc.png')]">
        <img class="w-[65%] mx-auto md:w-[60%] lg:w-[32%] lg:absolute lg:right-0 lg:left-0 lg:bottom-[30%]" src="@/assets/main/title.png">
        <div class="flex w-full mt-2.5 lg:justify-between">
            <img class="w-1/2 lg:w-[35%]" src="@/assets/main/leftman.png">
            <img class="w-1/2 lg:w-[35%]" src="@/assets/main/rightman.png">
        </div>
    </div>
</template>


