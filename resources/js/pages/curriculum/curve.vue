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
        <div>
            <div class="flex justify-center mt-24" v-show="no < length">
                <p>Countdown :{{minute}}:{{second}}</p>
                <div class="text-2xl bold font-serif mb-10 border-b-2 border-black w-1/4 pl-2 mr-5 capitalize ">
                    {{currentQuestion}}
                    <div v-if="wrong && CnQ == 2" class="text-red-600">
                        Ans: {{currentAns}}
                    </div>
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
            
            <div class="flex justify-center"  v-for="(ans, index) in currentAnsList" :key="index"  v-show="no < length">
                <button class="text-2xl text-left px-4 py-2 m-2 w-1/3 rounded-md shadow-sm bg-gray-200 hover:bg-green-400 hover:text-white cursor-pointer"
                        :class="wrongAnsIndex == index?'bg-red-400':''"
                        v-on:click="mark(ans, index)">
                    {{ans}}
                    
                </button>
            </div>
        </div>
        
        
        
        <div class="text-center font-serif text-xl mt-5 md:mt-0 md:ml-5" v-show="no == length">
            <div class="flex justify-center mb-5 md:p-5">
                <div class="bg-white rounded-lg w-4/5 lg:w-1/2 xl:w-1/3 p-4 shadow -pb-1">
                    <div v-for="(ans, index) in curveGroup" :key="index" class="pt-3">
                        <span class="flex justify-start text-gray-900 relative inline-block date uppercase font-medium">Lesson {{ans.id}}</span>
                        
			            <div class="border dark:border-gray-700 transition duration-500 mt-2.5 mb-3"></div>
                        <div class="flex mb-2">
                            <div class="w-6/12">
                                <span class="text-sm text-gray-600 block">Total time used:</span>
                                <span class="text-sm text-gray-600 block">Correct question:</span>
                                <span class="text-sm text-gray-600 block">Total question:</span>
                            </div>
                            <div class="w-6/12">
                                <span class="text-sm font-semibold block">{{ans.totalTime}}</span>
                                <span class="text-sm font-semibold block">{{ans.rate}}</span>
                                <span class="text-sm font-semibold block">{{ans.tmpCount}}</span>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
            <!-- button -->
            <button @click="updateInfo" class="text-white px-4 py-2 rounded-xl shadow-md bg-green-500">Done</button>
        </div>
       
        
    </div>
    
</template>

<script>
    const synth = window.speechSynthesis;
    const msg = new SpeechSynthesisUtterance();
    export default {
        middleware: 'auth',
        

        data: () => ({
            length:0,
            minutes: 2,
            seconds: 0,
            no:0,
            CnQ:0,
            wrongAnsIndex: -1,
            wrong:false,
            currentQuestion:'',
            currentAnsList: [],
            currentWord:[],
            list:[],
            temp:[],
            gtime:0,
            correctNum:0,
            countNum:0,
            tmpEnoData:[],
            timeOut: false,
            curveGroup:[],
            curveDetail:[],
            lesson:[]
            //lessonPoint:['0'],//when meet lessonPoint assgin gid
            
        }),
        mounted() {
            this.add();
        },
        created () {
         
            this.getForgettingCurve()
        },
        watch: {
            // 监听数值变化
            second: {
                handler(newVal) {
                    this.num(newVal)
                }
            },
            minute: {
                handler(newVal) {
                    this.num(newVal)
                }
            },
            timeOut: {
            	deep: true,
            	handler: function (newVal,oldVal){
					if(this.timeOut == true){
                        this.mark('','');
                        this.add();
					}
					
            	}
        	}

        },
        computed: {
            // 初始化数据
            second() {
                return this.num(this.seconds)
            },
            minute() {
                return this.num(this.minutes)
            },
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
            getForgettingCurve(){
                this.$http({
                    url: `/api/getTodayReviewData`,
                    method: 'GET',
                })
                .then((res) => {
                    // if(res.data.result || res.data.result != null || res.data.result != []){
                    if(Object.keys(res.data.result).length !== 0 && res.data.result.constructor === Array){
                        // console.log('Object.keys(res.data.result).length',Object.keys(res.data.result).length)
                        // console.log('res.data.result.constructor === Array',res.data.result.constructor === Array)
                        this.list = res.data.result
                        // console.log('this.list',this.list)
                        
                        // this.$store.commit('curve/SET_CURVE','this.course')
                        this.currentQuestion = this.list[0].Word.english
                        // console.log(this.list)
                        this.currentAns = this.list[0].Word.chinese
                        this.currentWord = this.list[0].Word
                        this.minId = this.list[0].Word.id
                        this.length = this.list.length
                        this.temp = this.randomAnsList(this.currentWord.id, this.list, this.minId)
                        // console.log('this.temp', this.temp)
                        this.createAnsList(this.temp);
                        var no = 0
                        var g = ''
                        // this.list.forEach(element => {
                        //     if(g != element.id){
                        //         if(element.day == 1){
                        //             no += 20
                        //             this.lessonPoint.push(String(no));
                        //         }else if(element.day ==2){
                        //             no += 10
                        //             this.lessonPoint.push(String(no));
                        //         }else if(element.day ==4){
                        //             no += 5
                        //             this.lessonPoint.push(String(no));
                        //         }else if(element.day ==7){
                        //             no += 5
                        //             this.lessonPoint.push(String(no));
                        //         }
                        //     }
                        //     g = element.id
                        //     // console.log('lessonPoint',this.lessonPoint)
                        //     // this.list.push({[tm]: element['Word']});
                        // });

                    }else{
                        alert('Today not review lesson')
                        this.$router.push({ name: 'mains/course' })
                        this.course = [];
                    }
                }, (res) => {
                    // alert(res.response);
                    alert("無法取得數據");
                })
            },
            mark(ans, index){
                console.log(this.currentAns)
                if(ans == this.currentAns){
                    //選正確
                    if(this.no < this.list.length){
                        this.CnQ++;
                        // this.correctNum++;
                        this.nextWord();
                    }else{
                        // this.no = this.wordList.length;
                        console.log(this.no)
                        console.log(this.list.length)
                    }
                }else{
                    if(this.no < this.list.length){
                        //選錯 
                        if(ans != this.currentAns){
                            this.CnQ++;
                            this.wrongAnsIndex = index;
                            this.wrong = true;
                            this.nextWord();
                        //時間到
                        }else if(this.timeOut == true){
                            this.CnQ++;
                            // this.wrongAnsIndex = index;
                            this.wrong = true;
                            this.nextWord();
                        }
                        
                    }else{
                        // this.no = this.wordList.length;
                        console.log(this.no)
                        console.log(this.list.length)
                    }
                }
            },
            randomAnsList(ansNo, list, min){
                var i;
                var rand = [];
                var arr = [];
                this.temp = [];
                
                list.forEach(item => {
                    rand.push(item);
                });
                //set total list
                var l = rand;
                arr.push(this.list[this.no]);
                // console.log(l)
                // console.log('l')
                l.splice(ansNo, 1)
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
                // console.log('result',result);
                
                arr = [];
                rand = [];
                l = [];
                return result
            },
            createAnsList(li){
                li.forEach((item) => {
                    if(this.CnQ == 0){
                        console.log(item.Word.chinese)
                        // console.log('this.list[item]')
                        this.currentAnsList.push(item.Word.chinese);
                    }else if(this.CnQ == 1){
                        this.currentAnsList.push(item.Word.english);
                    }
                })
                if(this.CnQ == 0){
                    this.currentAns = this.list[this.no].Word.chinese;
                    this.currentQuestion = this.list[this.no].Word.english;
                }else if(this.CnQ == 1){
                    this.currentAns = this.list[this.no].Word.english;
                    this.currentQuestion = this.list[this.no].Word.chinese;
                }
            },
            nextWord() {
                
                setTimeout(() => {
                    // console.log(this.minutes * 60 + this.seconds);
                    console.log(this.no)
                    
                    
                    //find each gid
                    var tmpda = {totalTime: 0, Eno: '', rate: 0, GId: '',time:0};
                    tmpda.totalTime = 60*2 -(this.minutes * 60 + this.seconds);

                    tmpda.GId = this.list[this.no].id
                        
                    if(this.wrong == true){
                        tmpda.rate= 0;
                    }else if(this.wrong == false){
                        tmpda.rate= 1;
                    }
                    tmpda.Eno= this.list[this.no].Word.id;
                    tmpda.time= this.list[this.no].Word.level;
                    this.tmpEnoData.push(tmpda);
                    //each question use time and correct rate

                    console.log('tmpEnoData', this.tmpEnoData);
                    // this.gtime += 60*2 -(this.minutes * 60 + this.seconds);
                    
                    //save lesson data

                    
                    if(this.CnQ == 2){
                        this.CnQ = 0;
                        this.curveDetail.push(this.tmpEnoData);
                        console.log('this.curveDetail',this.curveDetail)
                        // this.correctNum ++;
                        this.tmpEnoData = [];

                        // if(this.lessonPoint.some(item => item === String(this.no+1))){
                        
                        this.gno ++
                        // }
                        
                        this.no ++;
                    }
                    if(this.curveGroup.findIndex(p => p.GId ==  this.list[this.no].id) == -1){
                        // add new record in Group
                        var tm = []
                        var tm = {time: 0, id: '', rate: 0, time:0, GId:'', totalTime:0, tmpCount:0};
                    
                        tm.totalTime += 60*2 -(this.minutes * 60 + this.seconds);
                        tm.time= this.list[this.no].time;

                        tm.GId = this.list[this.no].id;
                        tm.rate= 0;
                        if(this.wrong == true){
                            tm.rate += 0;
                        }else if(this.wrong == false){
                            tm.rate += 1;
                        }
                        tm.tmpCount ++;
                        
                        
                        tm.id = tm.GId;
                        tm.id = tm.id.split("G")[1];
                        console.log('first time tm', tm);
                        
                        this.curveGroup.push(tm);
                        console.log('this.curveGroup[i].tmpCount',this.curveGroup)
                        // console.log('i', i,',',this.curveGroup[i].tmpCount)
                    }else{
                        var i = this.curveGroup.findIndex(p => p.GId ==  this.list[this.no].id);
                        
                        this.curveGroup[i].totalTime += 60*2 -(this.minutes * 60 + this.seconds);
                        if(this.wrong == true){
                            this.curveGroup[i].rate += 0;
                        }else if(this.wrong == false){
                            this.curveGroup[i].rate += 1;
                        }
                        this.curveGroup[i].tmpCount ++;
                        console.log('i', i,',',this.curveGroup[i].tmpCount)
                        
                        console.log('this.curveGroup[i].tmpCount',this.curveGroup[i].tmpCount)
                        // console.log('this.curveGroup[i]', this.curveGroup[i])
                    }
                    
                    this.countNum ++;

                    this.currentAnsList = [];
                    this.temp = this.randomAnsList(this.list[this.no].id, this.list, this.minId);
                    this.createAnsList(this.temp);
                    this.wrongAnsIndex = -1;
                    this.wrong = false;
                    this.timeOut = false;
                    this.minutes= 2;
                    this.seconds= 0;
                }, 100)

                
            },
            add() {
                let time = window.setInterval( ()=> {
                    if (this.minutes !== 0 && this.seconds === 0) {
                        this.minutes -= 1;
                        this.seconds = 59;
                    
                    } else if (this.minutes === 0 && this.seconds === 0) {
                        this.seconds = 0
                        this.timeOut = true
                        // console.log(this.timeOut)
                        // this.mark('','');
                        window.clearInterval(time)
                    } else {
                        this.seconds -= 1;
                    }
                }, 1000)
            },
            updateInfo () {
                
                console.log('this.curveDetail',this.curveDetail)
                
                console.log('this.curveGroup',this.curveGroup)
                this.curveGroup.forEach(item => {
                    item.rate = item.rate / item.tmpCount;
                    item.rate = item.rate.toFixed(2);
                });
                
                console.log('this.curveGroup new',this.curveGroup)
                this.$http({
                    url: `/api/updateCurveGroupInfo`,
                    method: 'POST',
                    data: {
                        LessonDetail:this.curveDetail,
                        LessonData: this.curveGroup
                        
                        // LessonDetail:this.reData.curveGroup,
                    },
                })
                .then((res) => {
                    this.$router.push({ name: 'mains/course' })
                }, (res) => {
                    alert('Unable to get plan form')
                })

            },
            num(n) {
                return n < 10 ? '0' + n : '' + n
            },
            
        }
    }
</script>
<style>

</style>
