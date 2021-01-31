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
                    <div v-if="wrong" class="text-red-600">
                        Ans: {{currentAns}}
                    </div>
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
        
        
        
        <div class="text-center font-serif text-xl ml-5" v-show="no == length">
            <button @click="updateInfo" class="text-white px-4 py-2 rounded-xl shadow-md bg-green-500">Done</button>
        </div>
       
        
    </div>
    
</template>

<script>

    import lesson from "../../components/learnComponent.vue";
    import Qs from 'vue-axios';
    import axios from 'axios';

    import { mapState } from 'vuex';
    
    import { mapGetters } from 'vuex'
    export default {
        middleware: 'auth',
        
        components: { lesson },

    
        computed:{
            
        },
        
        computed: {
            ...mapState(['curves']),
        },
        data: () => ({
            dt:[],
            AnsList:[],
            currentQuestion:'',
            currentAns:'',
            currentWord:[],
            currentAnsList: [],
            no:0,
            CnQ:0,
            minId: 0,
            list:[],
            tmp:[],
            wrongAnsIndex: -1,
            wrong:false,
            minutes: 2,
            seconds: 0,
            timeOut: false,
            reData:{
                curveGroup:[//each group using time and correct rate
                    // {
                    //     rate:[],
                    //     time:[],
                    //     id:[]
                    // }
                ],
                curveDetail:[
                    // {
                    //     rate:[],
                    //     time:[],
                    //     id:[]
                    // }
                ]
            },
            tmpEnoData:[],
            tmpLessonData:[],
            gtime:0,
            GId:[],   //save gid
            lessonPoint:[0], //when meet lessonPoint assgin gid
            gno:0, //assgin gid
            correctNum:0,
            length:0        //total correct num
        }),
        mounted() {
            this.add();
        },
        created () {
            this.init();
            // this.initQuestion(this.dt);
            // if(this.dt == '[object Object]' ){
                
            //     this.$router.push({ name: 'mains/traning' })
            // }

        },
//         watch:{
//             '$route':function(newUrl,oldUrl){
//                 if(newUrl!=oldUrl){
//                     this.dt=this.$route.query.course;
//                 }
// }
//         },
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

            
            // curves(currVal) {
            //     // 监听mapState中的变量，当数据变化（有值、值改变等），
            //     // 保证能拿到完整的数据，不至于存在初始化没有数据的问题，然后可以赋给本组件data中的变量
            //     this.ddd = currVal;
            // }
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
             // 防止数值小于10时，出现一位数
            num(n) {
                return n < 10 ? '0' + n : '' + n
            },

            // 倒计时函数
            add() {
                let time = window.setInterval( ()=> {
                    if (this.minutes !== 0 && this.seconds === 0) {
                        this.minutes -= 1;
                        this.seconds = 59;
                    
                    } else if (this.minutes === 0 && this.seconds === 0) {
                        this.seconds = 0
                        this.timeOut = true
                        console.log(this.timeOut)
                        // this.mark('','');
                        window.clearInterval(time)
                    } else {
                        this.seconds -= 1;
                    }
                }, 1000)
            },
            init(){
                this.dt = this.$route.query.coursess;
                // console.log(Object.values(this.dt));
                
                // console.log(this.dt);
                // console.log(this.dt[0].Word);
                // console.log("this.dt")
                var no = 0
                this.dt.forEach(element => {
                    
                    // console.log('element[Word')
                    console.log(element['Word'])
                    this.list.push({item: element['Word']});
                    this.GId.push({item: element['id']});
                    
                    console.log(this.GId)
                    console.log('this.GId')
                    if(element['day'] ==1){
                        no += 20
                        this.lessonPoint.push(String(no));
                    }else if(element['day'] ==2){
                        no += 10
                        this.lessonPoint.push(String(no));
                    }else if(element['day'] ==4){
                        no += 5
                        this.lessonPoint.push(String(no));
                    }else if(element['day'] ==7){
                        no += 5
                        this.lessonPoint.push(String(no));
                    }else if(element['day'] ==15){
                        no += 5
                        this.lessonPoint.push(String(no));
                    }else if(element['day'] ==30){
                        no += 5
                        this.lessonPoint.push(String(no));
                    }
                    console.log(this.lessonPoint)
                    // this.list.push({[tm]: element['Word']});
                });
                
                console.log(this.list) 
                console.log(this.GId) 
                console.log('this.GId23') 
                this.list = this.flatten(this.list, this.list.length)
                // console.log(this.list)
                // console.log('this.list')

                this.currentQuestion = this.list[0].english
                // console.log(this.list)
                this.currentAns = this.list[0].chinese
                this.currentWord = this.list[0]
                this.minId = this.list[0].id
                this.length = this.list.length
                this.randomAnsList(this.currentWord.id, this.list, this.minId)
                // console.log(this.temp)
                // console.log('this.temp')
                this.createAnsList(this.temp);
            },
            mark(ans, index){
                console.log(this.currentAns)
                if(ans == this.currentAns){
                    //選正確
                    if(this.no < this.list.length){
                        this.CnQ++;
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
            nextWord() {
                setTimeout(() => {
                    // console.log(this.minutes * 60 + this.seconds);
                    console.log(this.no)
                    
                    
                    //find each gid
                    var tmpda = []
                    tmpda['time'] = 0
                    tmpda['id'] = ''
                    tmpda['rate'] = 0
                    tmpda['time']= 60*2 -(this.minutes * 60 + this.seconds);

                    tmpda['GId'] = ''
                    tmpda['GId'] = this.GId[this.gno]
                        
                    console.log('this.GId');
                    if(this.wrong == true){
                        tmpda['rate']= 0;
                    }else if(this.wrong == false){
                        tmpda['rate']= 1;
                    }
                    tmpda['id']= this.list[this.no].id;
                    this.tmpEnoData.push(tmpda);
                    //each question use time and correct rate

                    this.gtime += 60*2 -(this.minutes * 60 + this.seconds);
                    
                    //save lesson data

                    this.currentAnsList = [];
                    this.randomAnsList(this.list[this.no].id, this.list, this.minId);
                    this.createAnsList(this.temp);
                    this.wrongAnsIndex = -1;
                    this.wrong = false;
                    this.timeOut = false;
                    this.minutes= 2;
                    this.seconds= 0;
                }, 100)

                if(this.CnQ == 2){
                    this.CnQ = 0;
                    this.reData.curveDetail.push(this.tmpEnoData);
                    console.log(this.reData.curveDetail)
                    console.log('this.reData.curveDetail')
                    this.correctNum ++;
                    this.tmpEnoData = [];

                    if(this.lessonPoint.some(item => item === String(this.no+1))){
                        
                        var tm = []
                        tm['time'] = 0
                        tm['id'] = ''
                        tm['rate'] = 0
                        tm['time']= this.gtime;

                        tm['GId'] = ''
                        tm['GId'] = this.GId[this.gno]
                            
                        console.log('lesson point');
                        tm['rate']= this.correctNum/(this.no+1);
                        this.correctNum = 0
                        tm['id']= this.list[this.no].id;
                        console.log('lesson point');
                        this.tmpLessonData.push(tm);
                        
                        this.reData.curveGroup.push(this.tmpLessonData);
                        
                        console.log(this.reData.curveGroup)
                        this.tmpLessonData = []; 
                        console.log('lesson point');
                        
                        this.gno ++
                    }
                    
                    this.no++;
                }
            },
            flatten(arr, length) {
                if(length == 1){
                    return this.list[0].item;
                }else if(length == 2){
                    var tmp = [];
                    tmp = arr[0].item.concat(arr[1].item);
                    return tmp;
                }else if(length == 3){
                    var tmp = [];
                    tmp = arr[0].item.concat(arr[1].item);
                    tmp = tmp.concat(arr[2].item);
                    return tmp;
                }else if(length == 4){
                    var tmp = [];
                    var tmp2 = [];
                    tmp = arr[0].item.concat(arr[1].item);
                    tmp2 = arr[2].item.concat(arr[3].item);
                    tmp = tmp.concat(tmp2);
                    return tmp;
                }else if(length == 5){
                    var tmp = [];
                    var tmp2 = [];
                    tmp = arr[0].item.concat(arr[1].item);
                    tmp2 = arr[2].item.concat(arr[3].item);
                    tmp = tmp.concat(tmp2);
                    tmp = tmp.concat(arr[4].item); 
                    return tmp;
                }else if(length == 6){
                    var tmp = [];
                    var tmp2 = [];
                    var tmp3 = [];
                    tmp = arr[0].item.concat(arr[1].item);
                    tmp2 = arr[2].item.concat(arr[3].item);
                    tmp3 = arr[4].item.concat(arr[5].item);
                    tmp = tmp.concat(tmp2);
                    tmp = tmp.concat(tmp3); 
                    return tmp;
                }
            },
            saveGroupStates() {
            // console.log(this.wordList)
                console.log(this.wId)
                // this.$http({
                //     url: `/api/updateGroupStates`,
                //     method: 'POST',
                //     data: {
                //         states: "done",
                //         wId: this.wId,
                //         slug: this.slug
                //     }
                // })
                // .then((res) => {
                //     this.$router.push({ name: 'mains/course' })
                // }, (res) => {
                //     alert('Unable to get plan form')
                // })
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
                // console.log(result);
                
                // console.log('result');
                this.temp = result;
                arr = [];
                result = [];
                rand = [];
                l = [];
            },
            createAnsList(li){
                li.forEach((item) => {
                    if(this.CnQ == 0){
                        // console.log(item)
                        // console.log('this.list[item]')
                        this.currentAnsList.push(item.chinese);
                    }else if(this.CnQ == 1){
                        this.currentAnsList.push(item.english);
                    }
                })
                if(this.CnQ == 0){
                    this.currentAns = this.list[this.no].chinese;
                    this.currentQuestion = this.list[this.no].english;
                }else if(this.CnQ == 1){
                    this.currentAns = this.list[this.no].english;
                    this.currentQuestion = this.list[this.no].chinese;
                }
            },
            updateInfo () {
                console.log(this.reData)
                
                console.log(this.reData.curveGroup[0])
                
                console.log('this.reData.curveGroup')
                let data = {
                    obj:this.reData.curveGroup,
                    oj2:this.reData.curvcurveDetaileGroup
                }
               let param = new URLSearchParams()
                param.append(this.reData.curveGroup, this.reData.curvcurveDetaileGroup)
                let params = {
                    ids: [1, 2, 3],
                    id: 1
                }
                const subData = Object.assign({}, this.reData.curveGroup);
                // param.append("password", "woaini123")
                this.$http({
                    url: `/api/updateCurveGroupInfo`,
                    method: 'POST',
                    // data: {
                    //     LessonDetail:JSON.stringify(this.reData.curveGroup),
                    //     // LessonData: this.reData.curvcurveDetaileGroup
                        
                    //     // LessonDetail:this.reData.curveGroup,
                    // },
                    data:data,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',  //指定消息格式
                    },
                    transformRequest: [function (e) {
                        // 数据转换的核心代码，来自我公司的前端大佬
                        function setDate(e){
                            var t, n, i, r, o, s, a, c = "";
                            for (t in e)
                            if (n = e[t], n instanceof Array)
                                for (a = 0; a < n.length; ++a)
                                o = n[a], i = t + "[" + a + "]", s = {}, s[i] = o, c += setDate(s) + "&";
                            else if (n instanceof Object)
                                for (r in n) o = n[r], i = t + "[" + r + "]", s = {}, s[i] = o, c += setDate(s) + "&";
                            else void 0 !== n && null !== n && (c += encodeURIComponent(t) + "=" + encodeURIComponent(n) + "&");
                            return c.length ? c.substr(0, c.length - 1) : c
                        }
                        // 数据转换的核心代码结束
                        return setDate(e)
                    }],
                })
                .then((res) => {
                    // this.$router.push({ name: 'mains/course' })
                }, (res) => {
                    alert('Unable to get plan form')
                })
            },
        }
    }
</script>
<style scoped>
</style>
