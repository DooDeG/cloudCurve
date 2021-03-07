<template>
    <div class="container">
        <div class=" flex justify-center">
            <div class="px-6 w-2/3">
                <div class="bg-gray-300 h-2 w-full rounded-full relative">
                    <span class="bg-white h-4 w-4 absolute top-0 -ml-2 -mt-1 z-10 shadow rounded-full" style="left:5%"></span>
                    <span class="bg-teal-500 h-2 absolute left-0 top-0 rounded-full" style="width:5%"></span>
                </div>
                <!-- <div class="flex justify-between mt-2 text-xs text-gray-600">
                    <span class="w-8 text-left">0%</span>
                    <span class="w-8 text-center">25%</span>
                    <span class="w-8 text-center">50%</span>
                    <span class="w-8 text-center">75%</span>
                    <span class="w-8 text-right">100%</span>
                </div> -->
            </div>
        </div>
        <div class="flex justify-between">
            <div>
                <button class=" text-teal-500 rounded-full font-bold py-4 px-6 mr-2 flex items-center hover:bg-green-400 hover:text-white"  @click="$router.go(-1)">
                    <svg class="h-5 w-5 mr-2 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
                        <path id="XMLID_10_" d="M438,372H36.355l72.822-72.822c9.763-9.763,9.763-25.592,0-35.355c-9.763-9.764-25.593-9.762-35.355,0 l-115.5,115.5C-46.366,384.01-49,390.369-49,397s2.634,12.989,7.322,17.678l115.5,115.5c9.763,9.762,25.593,9.763,35.355,0 c9.763-9.763,9.763-25.592,0-35.355L36.355,422H438c13.808,0,25-11.193,25-25S451.808,372,438,372z"></path>
                    </svg>
                </button>
            </div>
            
        </div>
        <div v-if="wrongAns  == false" >
            <div class="flex justify-center mt-24" v-show="no < 20">
                <div class="text-2xl bold font-serif mb-10 border-b-2 border-black w-1/4 pl-2 mr-5 capitalize ">
                    {{currentQuestion}}
                </div>
                <div @click="playVoice">
                    <font-awesome-icon icon="headphones" size="2x" style="color:rgba(75, 85, 99, var(--tw-bg-opacity)) !important;"/>
                </div>
                <!-- <div class="text-2xl bold mb-4 font-serif underline">Do</div> -->
                <!-- <div class="text-center font-serif text-md flex flex-col">
                    <div class="text-center font-serif text-xl " v-show="no > 0">
                        <div><button @click="preWord" class="text-white px-4 py-2 rounded-xl shadow-md bg-green-500">Pre</button></div>
                    </div>
                    <div class="text-center font-serif text-xl" v-show="no < 19">
                        <div><button @click="nextWord" class="text-white px-3 py-2 rounded-xl shadow-md bg-green-500">Next</button></div>
                    </div>
                    <div class="text-center font-serif text-xl" v-show="no == 19">
                        <button  class="text-white px-3 py-2 rounded-xl shadow-md bg-green-500">Done</button>
                    </div>
                </div> -->
            </div>
            
            <div class="flex justify-center"  v-for="(ans, index) in currentAnsList" :key="index"  v-show="no < 20">
                <button class="text-2xl text-left px-4 py-2 m-2 w-1/3 rounded-md shadow-sm bg-gray-200 hover:bg-green-400 hover:text-white cursor-pointer"
                        :class="wrongAnsIndex == index?'bg-red-400':''"
                        v-on:click="mark(ans, index)">
                    {{ans}}
                    
                </button>
            </div>
        </div>
        
        
        <div v-if="wrongAns" >
            
        </div>
        <div class="text-center font-serif text-xl ml-5" v-show="no == 20">
            <button @click="saveGroupStates" class="text-white px-4 py-2 rounded-xl shadow-md bg-green-500">Done</button>
        </div>
        <transition name="ModalAppear">
            <lesson v-if="wrongAns  == true" v-on:closedModal="closeModal" :Ch="currentAns" :En="currentQuestion"/>
            
        </transition>
        
    </div>
    
</template>

<script>
    const synth = window.speechSynthesis;
    const msg = new SpeechSynthesisUtterance();
    import lesson from "../../components/learnComponent.vue";
    export default {
        middleware: 'auth',
        
        components: { lesson },
        data: () => ({
            wordList: [],
            currentQuestion: '',
            currentChoose: [],
            listLength:'',
            currentAns: '',
            currentEn: '',
            currentAnsList: [],
            no: 0,
            state: '1',
            wId: [],
            temp: [],
            minId: 0,
            wrongAns: '',
            wrongAnsIndex: -1,
            CnQ: 0,
            slug:'',
        }),
        created () {
            // this.updateInfo().
            this.getParams();
            this.getEnWorldList(this.slug);
        },
        watch:{
        },
        methods:{
            playVoice() {
                this.handleSpeak(this.currentQuestion) 
            },
            // 语音播报的函数
            handleSpeak(text) {
                msg.text = text;   
                // msg.lang = "en-US";  
                msg.volume = 1;     
                msg.rate = 1;      
                msg.pitch = 1;      
                synth.speak(msg); 
            },
            // 语音停止
            handleStop(e) {
                msg.text = e;
                // msg.lang = "zh-CN";
                synth.cancel(msg);
            },
            getParams() {
                console.log(this.$route.params.id);
                this.slug = this.$route.params.id
            },
            getEnWorldList(slug){
                this.$http({
                    url: `/api/getReviewListWithId`,
                    method: 'POST',
                    data: {
                        slug: this.slug
                    }
                })
                .then((res) => {
                    if(res.data.result == "undo"){
                        alert('You need to learn one chapter')
                        this.$router.push({ name: 'mains/course' })
                    
                    }else if(res){
                        this.currentWord = res.data.result
                        this.wordList = res.data.result
                        this.currentQuestion = this.currentWord[this.no].english
                        this.currentAns = this.currentWord[this.no].chinese
                        this.minId = this.currentWord[0].id
                        this.randomAnsList(this.currentWord[this.no].id, res.data.result.length, this.minId);
                        this.createAnsList(this.temp);
                        res.data.result.forEach((item, index) => {
                            this.wId.push(item.id);
                        })
                        
                        
                    }else{
                        alert('You need to learn one chapter')
                    }

                }, (res) => {
                    // alert(res.response);
                    alert("無法取得數據");
                })
            },
            saveGroupStates() {
            // console.log(this.wordList)
                console.log(this.wId)
                this.$http({
                    url: `/api/updateGroupStates`,
                    method: 'POST',
                    data: {
                        states: "done",
                        wId: this.wId,
                        slug: this.slug
                    }
                })
                .then((res) => {
                    this.$router.push({ name: 'mains/course' })
                }, (res) => {
                    alert('Unable to get plan form')
                })
            },
            randomAnsList(ansNo, listLength, min){
                var i;
                var rand = [];
                var arr = [];
                this.temp = [];
                for(var i = 0; i < listLength; i++ ){
                    rand.push(i);
                }
                //set total list
                var l = rand;
                arr.push(ansNo - min);
                l.splice(ansNo - min, 1)
                for (var i = 0; i < 3; i++) {
                    var a = Math.floor(Math.random() * l.length -1);
                    arr.push(l.splice(a, 1)[0]); //舊陣列去除數字轉移到新陣列
                    
                };
                var result = [];//開另一個空陣列
                var ranNum = 4;
                
                for (var i = 0; i < ranNum; i++) {
                    var ran = Math.floor(Math.random() * arr.length-1);
                    result.push(arr.splice(ran, 1)[0]); //舊陣列去除數字轉移到新陣列
                };
                console.log(result);
                this.temp = result;
                arr = [];
                result = [];
                rand = [];
                l = [];
            },
            createAnsList(li){
                li.forEach((item) => {
                    if(this.CnQ == 0){
                        this.currentAnsList.push(this.currentWord[item].chinese);
                        this.currentQuestion = this.currentWord[this.no].english;
                    }else if(this.CnQ == 1){
                        this.currentAnsList.push(this.currentWord[item].english);
                        this.currentQuestion = this.currentWord[this.no].chinese;
                    }
                })
                if(this.CnQ == 0){
                    this.currentAns = this.currentWord[this.no].chinese;
                }else if(this.CnQ == 1){
                    this.currentAns = this.currentWord[this.no].english;
                }
            },
            mark(ans, index){
                console.log(this.currentAns)
                if(ans == this.currentAns){
                    if(this.no < this.wordList.length){
                        this.CnQ++;
                        this.nextWord();
                    }else{
                        // this.no = this.wordList.length;
                        console.log(this.no)
                        console.log(this.wordList.length)
                    }
                }else{
                    console.log(ans);
                    this.currentQuestion = this.currentWord[this.no].english;
                    this.currentAns = this.currentWord[this.no].chinese;
                    this.wrongAns = true;
                    this.wrongAnsIndex = index;
                    
                }
            },
            updateExerciseInfo () {
                this.wrongAns = false;
                this.wrongAnsIndex = -1;
                this.$router.push({ name: 'mains/course' })
            },
            nextWord() {
                console.log(this.no)
                console.log("no")
                console.log(this.CnQ)
                console.log("CnQ")
                if(this.CnQ == 2){
                    this.no++;
                    this.CnQ = 0;
                }
                
                console.log(this.no)
                console.log("no")
                console.log(this.CnQ)
                console.log("CnQ")
                this.currentAnsList = [];
                this.randomAnsList(this.currentWord[this.no].id, this.wordList.length, this.minId);
                this.createAnsList(this.temp);
                // this.currentAns = this.currentWord[this.no].chinese;
                // this.currentQuestion = this.currentWord[this.no].english;
                this.wrongAns = false;
                this.wrongAnsIndex = -1;
            },
            preWord() {
                if(this.CnQ == 2){
                    this.no--;
                    this.CnQ = 0;
                }
                this.currentAnsList = [];
                this.randomAnsList(this.currentWord[this.no].id, this.wordList.length, this.minId);
                this.createAnsList(this.temp);
                // this.currentAns = this.currentWord[this.no].chinese;
                // this.currentQuestion = this.currentWord[this.no].english;
                this.wrongAns = false;
                this.wrongAnsIndex = -1;
            },
            reloadWord() {
                this.no;
                this.currentAnsList = [];
                this.randomAnsList(this.currentWord[this.no].id, this.wordList.length, this.minId);
                this.createAnsList(this.temp);
                // this.currentAns = this.currentWord[this.no].chinese;
                // this.currentQuestion = this.currentWord[this.no].english;
                this.wrongAns = false;
                this.wrongAnsIndex = -1;
            },
            closeModal(data) {
                // this.no--;
                this.wrongAns = data.num;
                this.wrongAnsIndex = -1;
                this.reloadWord();
            },
        }
    }
</script>
<style scoped>
</style>
