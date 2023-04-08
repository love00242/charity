<script setup>
import Footer from '@/components/Footer.vue';
import { ref } from 'vue';

const otherArticle = [
    {title: '先入為主的錯殺當我們親手關上「變好這扇門」', img:''},
    {title: '誰是「壞鄰居」？當外來社福遇上在地社區', img:''},
    {title: '「愛心餅乾」看不見的成本為何賠錢還要賣到底？', img:''},
]
const memberList = [
    {value:0, text:"一般民眾"},
    {value:1, text:"社福從業人員"},
]
const genderList = [
    {value:"boy", text:"男"},
    {value:"girl", text:"女"},
]
const ageRangeList = [
    {value:0, text:"20歲以下"},
    {value:1, text:"20-30歲"},
    {value:2, text:"30-40歲"},
    {value:3, text:"40-50歲"},
    {value:4, text:"50-60歲"},
    {value:5, text:"60歲以上"},
]
const innovationState = ref(null);
const supportState = ref(null);
const member = ref("");
const gender = ref("");
const ageRange = ref(null);

const changeState = (val) => {
    console.log("ageRange", val);
    ageRange.value = val;
}
const sendData = () => {
    console.log("sendData");
}
const goBack = () => {
    console.log("goBack");
}
</script>

<template>
    <div>
        <div
            class="bg-[length:100%_100%] bg-[url('@/assets/bg/article.png')] h-[calc(100vh-45px)] text-white flex flex-row-reverse justify-center items-center">
            <h2 class="[writing-mode:vertical-rl] font-bold text-[40px]">平行公益／數位轉型的忙與盲<p
                    class="mr-[5px] normal text-[29px]">彌補大眾與助人者的認知落差</p>
            </h2>
        </div>
        <Footer :isInner="true" />
        <section class="yellowArea">
            <p class="text-primary mb-5">你認為社福團體需要創新嗎?</p>
            <div class="flex text-center">
                <input class="hidden" type="radio" :value="0" v-model="innovationState">
                <label for="0" class="chooseBox mr-1.5 w-full">需要</label>
                <input class="hidden" type="radio" :value="1" v-model="innovationState">
                <label for="1" class="chooseBox ml-1.5 w-full">不需要</label>
            </div>
        </section>
        <!-- 內文 -->
        <section class="px-5 text-lg">
            <p class="font-medium">作者/李香君（倡議企劃）</p><br />
            <p class="text-justify mb-5">
                疫情衝擊經濟民生，商家、業者苦不堪言，社福團體少了實體勸募後更飽受壓力。疫情帶來諸多挑戰與考驗，卻也因此加速數位轉型，使各類產業紛紛以「虛實整合」實體、線上並重的策略因應。<br /><br />
                這波趨勢又為社福機構迎來哪些危機與轉機？特別是各組織有著不同屬性與條件，身處數位轉型浪潮之中，是否會成為不能承受之重？<br /><br />
                據聯合勸募調查指出，2021年有83%合作的中小型社福單位募款遭疫情波及。<br />
                由於疫情期間減少出門、實體活動被迫延期，讓現金、劃撥、義賣等實體募款方式銳減，數位募款成了新管道，更被視為抵抗疫情衝擊的解藥。
            </p>

            <img class="mt-12 mb-2" src="@/assets/main/artical_pic1.png">
            <small class="flex mb-10">白永恩基金會鍾榕榕執行長(圖右)與同仁討論，持續優化官網與線上捐款的流程，減緩疫情帶來的衝擊，並跟上這波數位轉型趨勢。圖/白永恩基金會提供</small>

            <img class="mt-12 mb-8 w-10" src="@/assets/icon/quote.svg">
            <span class="flex flex-col text-[#949494] text-justify text-[26px] leading-[42px] font-normal mb-12">7-11零錢捐推行10幾年，年度最高金額1億6千萬，LINE Pay和街口支付線上捐款金額總和迅速破3億<br><p class="text-lg mt-4">／自律聯盟秘書長沈怡如／</p></span>

            <p class="text-[25px] font-bold mb-4">實體募款下滑<br />拓展數位募款增加財源</p>
            <p class="text-lg">實體募款的下滑程度有多嚴重？良顯堂基金會、白永恩基金會皆指出，2021與2020年相比，年度募款金額就少了超過新台幣700萬;罕見疾病基金會光是今年4、5月善款就掉了20%。<br /><br />疫情肆虐讓各機構不得不加速數位募款的腳步，罕病基金會去年5月即推動新平台，如超商7-11ibon、街口支付等，電子支付的便利明顯反映到實際數字。<br /><br />罕病基金會對照2021與2022年數據，捐款者使用數位支付比例由3%攀升到43%，雖然線上多為小額捐款，但數位募捐佔總募款的金額，也從3%上升到27%。<br /><br /> 據自律聯盟資料，LINE Pay與街口支付幾年前為公益團體設行動捐款平台，光在2020年兩家平台的募款就超過 3 億；自律聯盟秘書長沈怡如表示，超商零錢捐已推廣10幾年，年度最高金額為1億6千萬元，「你可以想像人手一支智慧型手機的改變，有多麼龐大。」</p>
        </section>
        <section class="mt-10 px-5">
            <p class="text-[25px] font-bold mb-4">各年齡層線上捐款幅度變化</p>
            <img class="mt-6 mb-5" src="@/assets/main/chart.png">
            <small class="flex mb-10">2021年與2020年相較，線上捐款的增幅不僅限於年輕人，大致上各年齡層皆上升，僅有70歲以上捐款者下降。資料來源：台灣責信公益協會</small>

            <p class="text-[25px] font-bold mb-4">數位轉型待解的課題：<br />詐騙、後勤管理、行銷宣傳</p>
            <p class="text-lg">受到疫情影響，全台灣各個產業都掀起一股數位轉型浪潮，從現有的資料來看，公益慈善募款的數位轉型顯得相當成功。不過，相對於捐款人只要從線下改線上捐款的轉型，募款單位的轉型要來得複雜且隱含風險。<br /><br />由於每一個機構條件不同，數位募款不一定是萬靈丹，例如良顯堂基金會的募款主力較依靠人際網路、滾雪球式擴大，也偏好去郵局劃撥；良顯堂兒少家園主任徐瑜說，數位募款僅有小幅度增加，捐款者對網路付款的方式很沒安全感，反而臨櫃交現金有一種捐獻的儀式感。<br /><br />上述案例可以觀察到，數位募款對部分募款工作並沒有太大助益。然而，卻暗藏破壞捐款人與募款單位信任關係的隱憂：詐騙風險。</p>
        </section>
        <section class="mt-10 px-5">
            <img class="mt-12 mb-8 w-10" src="@/assets/icon/quote.svg">
            <span class="flex flex-col text-[#949494] text-justify text-[26px] leading-[42px] font-normal mb-12">損失越大的捐款者，代表對基金會的信任與支持越大<br><p class="text-lg mt-4">／白永恩基金會公關葉孟軒／</p></span>
            <!-- 課題1 -->
            <p class="text-[25px] font-bold mb-4">數位轉型課題一：<br />詐騙與盜刷風險</p>
            <p class="text-lg">
                2021年一間承包社福機構線上募款的系統商遭駭客入侵，超過百間社福機構受害，捐款人個資外洩，還導致詐騙案;信用卡定期定額遭盜刷也時有所聞，不僅傷害民眾對社福單位的信任，也增加機構對系統商的疑慮，如何確保資訊安全，並加強信任，是社福機構與時俱進時的當務之急。<br /><br />
                白永恩基金會去年8月就是受害機構之一。「就是因為信任你們，我才會上當。」公關葉孟軒聽捐款者這麼說相當心痛，尤其「損失越大的捐款者，代表對基金會的信任與支持越大」。<br /><br />
                鍾榕榕表示，基金會第一時間就出面說明，也不斷發布消息，至今已發了4、5萬封簡訊、郵件，不斷呼籲民眾切勿上當；她坦言，過去對於數位轉型，只單純想找到合適系統，「沒想到過程中需要付出這麼大的信任代價」。<br /><br />
                基金會在事件一發生便立即停止使用雲端資料庫，改成內部單機作業，並嚴格控管權限。「將門通通關上，別人才偷不到」，但鍾榕榕直言，此舉無疑是在開倒車，因此也正審慎評估，能否 找到更好、更安全的系統來使用。<br /><br />
                介惠基金會則是帳號遭詐騙集團當誘餌，帳戶因此遭受凍結，施欣錦表示，第一時間就公開澄清，確保各方面的資訊安全，雖然未涉個資外洩，仍加強內部教育訓練，並確認外部資訊公司的資安、風險評估。<br /><br />
                其他社福團體也表示，傾向與規模大的系統商合作，並留意合約內容，期望在這起詐騙風波中止血，挽回捐款人信任。
            </p>

            <img class="mt-12 mb-2" src="@/assets/main/artical_pic2.png">
            <small class="flex mb-10">數位化不僅改變捐款方式，後勤管理、第一線服務等也開始使用數位工具。照服員至案家服務，會使用APP上下班打卡。圖/介惠基金會提供</small>
            <!-- 課題2 -->
            <p class="text-[25px] font-bold mb-4">數位轉型課題二：<br />後勤管理</p>
            <p class="text-lg">
                儘管詐騙事件讓社福團體狠摔了一跤，可是數位轉型的浪潮仍在持續；數位化不僅是為了挽救募款劣勢，更在組織管理與發展扮演重要關鍵。<br /><br />
                介惠基金會執行長施欣錦指出，數位轉型不光運用在捐款面，後勤管理、第一線服務也仰賴數位化。施欣錦舉例，數位化打卡系統，更方便記錄第一線服務狀況，同時減輕後端工作。<br /><br />
                不過，型態轉變勢必遭遇反彈，有些社工感到被監督、有的人覺得麻煩，於是施欣錦積極溝通，重要的是「讓同仁理解，我們在幫他減少工作上的困擾」，當大家感受數位化的便利，自然樂意使用。<br /><br />
                另外，數位化也能解決人力荒困境。罕病基金會執行長陳冠如表示，好的資訊系統，能完整紀錄第一線服務，方便新人接手進入狀況，加快與扶助家庭建立信賴，系統也能記錄與捐款者的互動，讓服務及雙方關係更能永續發展。<br /><br />
                對於數位轉型，所有受訪的社福團體都表示樂見其成。徐瑜指出，「數位化是必要的，但要先搞清楚要轉什麼？」設定明確目標才有助策略發展，例如做系統時，先設定目標、解決什麼問題，才能有效評估系統要如何調整、修正。
            </p>

            <img class="mt-12 mb-2" src="@/assets/main/artical_pic3.png">
            <small class="flex mb-10">照服員在培力過程中使用平板或手機，教導部落婦女財務管理等觀念，平時也使用線上視訊參與輔導會議。圖/介惠基金會提供</small>
            <!-- 課題3 -->
            <p class="text-[25px] font-bold mb-4">數位轉型課題三：<br />行銷宣傳</p>
            <p class="text-lg">
                數位轉型影響範圍不只是設備、器材的更換，也影響人類的思維。台灣數位文化協會秘書長陳文良表示，過往團體常用社運、教學等方式傳遞理念，但時代已截然不同，只有了解現代人的注意力在哪，才能事半功倍。<br /><br />
                泛科知識總經理馮瑞麒補充，現代人離不開手機，但組織做的事卻很難傳播到眾人手機上，努力與成效無法被眾人得知。<br /><br />
                陳文良建議，使用數位工具或社群媒體，應該從影像、熱門關鍵議題下手，並且觀察每一次貼文的流量，盡可能接觸到新的族群，累積足夠聲量與影響力，再說自己的理念。<br /><br /> 
                對於「跟風」議題的行為，陳文良表示，理解許多人會有內心衝突，但要記得現在是數位時代，以前是上街頭倡議，現在疫情隔離，大家都在網路上，「網路比馬路還大」。
            </p>

            <img class="mt-12 mb-2" src="@/assets/main/artical_pic4.png">
            <small class="flex mb-10">陳文良指出，許多社福團體卡在議題操作、網路安全、適應數位環境等，他建議先從影像、流量的觀察及關鍵議題去下手，掌握趨勢的主動權。圖/李香君攝影</small>
            <!-- 課題4 -->
            <p class="text-[25px] font-bold mb-4">好行銷的第一要素：<br />與民眾產生連結</p>
            <p class="text-lg">
                罕病基金會的數位行銷，可說是正面案例，光小額捐款就佔總募款額的80%，YouTube頻道數支影片點閱次數超過10萬，也有單支破百萬。<br /><br />
                執行長陳冠如強調，好故事要有好的行銷，組織要注入新血才能跟上不斷改變的媒介形式與流行話題，(捐款者)數據分析也很必要，否則捐款下降也做不了服務。<br /><br />
                陳冠如提到，第一優先是跟民眾產生連結，了解民眾想知道什麼？罕病對大眾來說，常有黑暗、辛苦印象，易產生歧視，很多人看見罕病病友會先躲避，於是組織將病友的正面形象呈現出來，讓大家知道「疾病並不可怕，可怕的是躲在黑暗 裡沒有走出來」。
            </p>

            <img class="mt-12 mb-2" src="@/assets/main/artical_pic5.png">
            <small class="flex mb-10">數位轉型帶來的影響有好有壞，但數位力代表未來組織發展與生存關鍵的力量，如何創造永續關係，考驗社福團體的智慧。圖/李香君攝影</small>
            <!-- 課題5 -->
            <p class="text-[25px] font-bold mb-4">各團體條件不同<br />數位轉型先設「階段性目標」</p>
            <p class="text-lg">
                罕病基金會的案例鼓舞人心，只是每家社福團體資源、規模及屬性不同，恐難以類比。沈怡如表 示，資訊太龐大，恐嚇性語言越多，會讓許多組織害怕，自律聯盟於是扮演陪跑員，給階段性目 標，「小目標小贏」，組織看見改變，會更有信心嘗試，知道正在前進，便不畏懼改變。<br /><br />
                不過，沈怡如也提醒，這些改變與轉型並不只是要讓每一項計畫都能順利結案，而是要讓整個組織變得更強壯、更有生存力；她表示，在協辦傳善獎發現，部分社福團體注重「計畫永續」，而不是「組織永續」，這就像頭痛醫頭、腳痛醫腳，卻忽略要配合生活習慣與飲食運動，才能讓身體健康，讓組織走得又穩又長。<br /><br />
                綜觀前述想法，數位轉型下一步往哪走？怎麼維護資安？如何有效解決問題？都跟組織治理策略、設計有關，如何讓捐款不只是曇花一現，而成功創造源源不絕的永續關係？考驗著社福機構的智慧。
            </p>

            <span class="text-lg flex my-12">關鍵字 〉<p class="font-bold">數位轉型、平行公益、傳善獎</p></span>
        </section>
        <section class="yellowArea">
            <p class="text-primary mb-5">你是否支持社福團體創新，<br />即便可能失敗也願意鼓勵嘗試？</p>
            <div class="flex text-center">
                <input class="hidden" type="radio" :value="0" v-model="supportState">
                <label for="0" class="chooseBox mr-1.5 w-full">支持</label>
                <input class="hidden" type="radio" :value="1" v-model="supportState">
                <label for="1" class="chooseBox mr-1.5 w-full">考慮支持</label>
                <input class="hidden" type="radio" :value="2" v-model="supportState">
                <label for="2" class="chooseBox w-full">不支持</label>
            </div>
        </section>
        <section class="yellowArea flex flex-col">
            <p class="text-primary mb-5">我是....</p>
            <ul class="flex text-center mb-4">
                <li v-for="(item, i) in memberList" :key="'member'+i" class="chooseBox mr-1.5 w-2/5">
                    <input class="hidden" type="radio" :value="item.value" v-model="member">
                    <label :for="item.value">{{ item.text }}</label>
                </li>
            </ul>
            <ul class="flex text-center mb-4">
                <li v-for="(item, i) in genderList" :key="'gender'+i" class="chooseBox mr-1.5 w-[15%]">
                    <input class="hidden" type="radio" :value="item.value" v-model="gender">
                    <label :for="item.value">{{ item.text }}</label>
                </li>
            </ul>
            <ul class="flex text-center flex-wrap mb-8">
                <li 
                    v-for="(item, i) in ageRangeList" :key="'ageRange'+i" 
                    :class="['chooseBox mr-1.5 w-[30%] mb-1', {'active': ageRange === item.value}]"
                    @click="changeState(item.value)"
                >
                    <input class="hidden" type="radio" :value="item.value" v-model="ageRange">
                    <label :for="item.value">{{ item.text }}</label>
                </li>
            </ul>
            <button class="btn w-[120px] py-3 mx-auto" @click="sendData">確定</button>
        </section>
        <div class="flex justify-center mb-8">
            <button class="btn w-[120px] py-3 text-lg" @click="goBack">
                <img src="@/assets/icon/back.svg" alt="">
                回前頁
            </button>
        </div>
        <ul class="flex flex-col mt-10 mb-8 px-5 text-lg text-[#5C5B5B]">
            <li v-for="(item, i) in otherArticle" :key="'article'+i" class="flex mb-2">
                <p class="w-[40%]">{{ item.title }}</p>
                <!-- <img src="" class="w-[120px]"> -->
                <div class="w-[60%] min-h-[135px] bg-[#F1F1F1]"></div>
            </li>
        </ul>
    </div>
</template>

<style scoped>
.yellowArea {
    @apply bg-secondary rounded-lg mx-5 my-10 px-5 pt-6 pb-9 text-lg;
}

.chooseBox {
    @apply bg-white text-[#949494] rounded-[3px] py-2;
}
.active {
    @apply bg-primary text-secondary;
}
</style>