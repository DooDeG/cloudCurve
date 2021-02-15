<template>
    <div class="container">
        <div class="flex flex-col mt-20">
            <!-- ===== Course ====  -->
            <!-- <div class="flex justify-around">
                <div class="text-left bg-white px-4 py-2 md:w-3/4  rounded-md shadow-xl border-t-4 border-red-600 ">
                    <div class="flex justify-between">
                        <div class="text-gray-700 text-center px-4 py-2 m-2 underline bold text-3xl font-serif">Course</div>
                        <div>
                            <div class="mt-4 text-gray-700 text-center text-xl bold font-serif">Chapter: {{chap}}</div>
                        </div>
                    </div>
                    <div class="flex justify-around">
                        <div class="flex flex-col">
                            <div>
                                <div class="ml-8 text-gray-700 text-center text-xl bold font-serif">Learning</div>
                            </div>
                            <div class="flex justify-center mt-2">
                                <router-link :to="{ name: user ? 'lesson' : 'login' }">
                                    <button class="items-center"><font-awesome-icon icon="play-circle" size="3x" style="color:red !important;"/></button>
                                </router-link>
                            </div>
                        </div>
                       
                        <div class=" -mt-16">
                            <span class="text-9xl text-red-500">&#47;</span>
                        </div>
                        <div class="flex flex-col">
                            <div>
                                <div class="ml-8 text-gray-700 text-center text-xl bold font-serif">Exercise</div>
                            </div>
                            <div class="flex justify-center mt-2">
                                <router-link :to="{ name: user ? 'review' : 'login' }">
                                    <button class="items-center"><font-awesome-icon icon="play-circle" size="3x" style="color:red !important;"/></button>
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div> -->
            <div class="flex justify-center 2xl:justify-start text-gray-600 bold text-3xl font-serif">
                
                <!-- <div class=" 2xl:ml-52 underline">Today Lesson</div> -->
                
                <div class=" 2xl:ml-52 underline">Today Lesson</div>
            </div>
            <div class="flex justify-center">
                <div class="flex flex-col md:flex-row md:justify-around w-5/6 md:w-2/3 mt-3">
                    <div class="flex justify-center md:mr-5 mt-4 md:mt-1">
                        <div class="bg-white p-4 shadow rounded-md shadow-xl border-t-4 border-red-600 w-96">
                            <div class="flex">
                                <div class="w-2/3">
                                    <h1 class=" bold text-xl font-serif inline ">
                                    Lesson
                                    </h1>
                                    <h1 class="inline bold text-2xl font-serif">
                                     :&nbsp;{{chap}}
                                    </h1>
                                    
                                    <span class="block text-xs uppercase text-blue-400 mt-1">{{currentDateWithFormat}}</span>
                                    <!-- <span class="block text-xs uppercase text-blue-400 mt-1">Learning</span> -->
                                </div>
                                <div class="w-1/3">
                                    <span class="float-right text-xs px-2 text-white">
                                        <router-link :to="{ name:'lessondata', params:{id: chap } }">           
                                        <!-- <button type="button" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline" @click="onSends(le.id)"> -->
                                            <button v-if="re != 'learn'" class="items-center"><font-awesome-icon icon="play-circle" size="3x" style="color:red !important;"/></button>
                                            <button v-if="re == 'learn'" class="items-center"><font-awesome-icon icon="redo" size="2x" style="color:rgba(239, 68, 68, var(--tw-bg-opacity)); !important;"/></button>
                                        
                                        </router-link>
                                    </span>
                                </div>
                            </div>
                            <div class="flex justify-center mb-3">
                                <div class="text-blue font-serif bold text-2xl ">Learn</div>
                            </div>
                            <div class="flex mt-2">
                                <div class="w-1/2 flex-col  border-r-2">
                                    <span class="flex justify-center text-2xl font-semibold">20</span>
                                    <span class="flex justify-center text-gray-500">Words</span>
                                </div>
                                <div class="w-1/2 flex-col">
                                    <span class="flex justify-center text-2xl font-semibold">20</span>
                                    <span class="flex justify-center text-gray-500">Minute</span>
                                </div>
                            </div>
                            <!-- <div class="flex  mt-2">
                                <span class="text-xs font-semibold py-1">Progress</span>
                                <span class="text-xs font-semibold py-1 ml-auto text-blue-600">10%</span>
                            </div>
                            <div class="flex mt-2">
                                <div class="w-full h-2 rounded rounded-r-none bg-blue-400"></div>
                                <div class="w-1/4 h-2 rounded rounded-l-none bg-blue-100"></div>
                            </div> -->
                            
                        </div>
                    
                    </div>
                    <div class="flex justify-center md:mr-5 mt-4 md:mt-1">
                        <div class="bg-white p-4 shadow rounded-md shadow-xl border-t-4 border-red-600 w-96">
                            <div class="flex">
                                <div class="w-2/3">
                                    <h1 class=" bold text-xl font-serif inline ">
                                    Lesson
                                    </h1>
                                    <h1 class="inline bold text-2xl font-serif">
                                     :&nbsp;{{chap}}
                                    </h1>
                                    
                                    <span class="block text-xs uppercase text-blue-400 mt-1">{{currentDateWithFormat}}</span>
                                    <!-- <span class="block text-xs uppercase text-blue-400 mt-1">Learning</span> -->
                                </div>
                                <div class="w-1/3">
                                    <span class="float-right text-xs px-2 text-white">
                                        <router-link :to="{ name:'reviewdata', params:{id: chap } }">           
                                        <!-- <button type="button" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline" @click="onSends(le.id)"> -->
                                            <button v-if="chapExer == 'undo'" class="items-center"><font-awesome-icon icon="play-circle" size="3x" style="color:red !important;"/></button>
                                            <button v-if="chapExer == 'done'" class="items-center"><font-awesome-icon icon="redo" size="2x" style="color:rgba(239, 68, 68, var(--tw-bg-opacity)); !important;"/></button>
                                        
                                        </router-link>
                                    </span>
                                </div>
                            </div>
                            <div class="flex justify-center mb-3">
                                <div class="text-blue font-serif bold text-2xl ">Exercise</div>
                            </div>
                            <div class="flex mt-2">
                                <div class="w-1/2 flex-col  border-r-2">
                                    <span class="flex justify-center text-2xl font-semibold">20</span>
                                    <span class="flex justify-center text-gray-500">Words</span>
                                </div>
                                <div class="w-1/2 flex-col">
                                    <span class="flex justify-center text-2xl font-semibold">25</span>
                                    <span class="flex justify-center text-gray-500">Minute</span>
                                </div>
                            </div>
                            <!-- <div class="flex  mt-2">
                                <span class="text-xs font-semibold py-1">Progress</span>
                                <span class="text-xs font-semibold py-1 ml-auto text-blue-600">10%</span>
                            </div>
                            <div class="flex mt-2">
                                <div class="w-full h-2 rounded rounded-r-none bg-blue-400"></div>
                                <div class="w-1/4 h-2 rounded rounded-l-none bg-blue-100"></div>
                            </div> -->
                            
                        </div>
                    
                    </div>
                    
                </div>
            </div>
            <!-- table list  -->
            <div class="flex justify-center 2xl:justify-start text-gray-600 bold text-3xl font-serif mt-5">
                
                <div class=" 2xl:ml-52 underline">Total lesson list</div>
            </div>
        <div class="flex justify-center text-gray-900 mb-10 mt-4">
            <table class="md:w-3/4 text-md bg-white rounded-md shadow-xl">
                <tbody>
                    <tr class="border-b">
                        <th class="text-left p-3 px-5">Name</th>
                        <!-- <th class="text-left p-3 px-5">Email</th> -->
                        <th class="text-left p-3 px-5">state</th>
                        <th class="p-3 px-5 flex justify-end">Page:&nbsp;
                            <select v-model="selected" class="border-solid border-gray-100 font-bold" @change="onChange( $event)">
                                <option disabled value=""> </option>
                                <option> 1</option>
                                <option> 2</option>
                                <option> 3</option>
                                <option> 4</option>
                                <option> 5</option>
                            </select>
                        </th>
                    </tr>
                    <tr class="border-b mb-5 hover:bg-blue-100" v-for="(le, i) in Clist" :key="i">
                        <td class="p-3 px-5">Lesson {{le.id}}</td>
                        <!-- <td class="p-3 px-5">chapter 2</td> -->
                        <td class="p-3 px-5">
                            <div v-if="le.status.States == 'undo' || (le.id == chap && le.status.States == 'undo')">
                                <font-awesome-icon icon="play-circle" size="2x" style="color:red !important;"/>
                            </div>
                            <div v-else-if="le.status.States == 'done'">
                                <font-awesome-icon icon="check-circle" size="2x" style="color:rgba(52, 211, 153, var(--tw-bg-opacity)) !important;"/>
                            </div>
                            <div v-else-if="le.status == ''">
                                <font-awesome-icon icon="lock" size="2x" style="color:rgba(75, 85, 99, var(--tw-bg-opacity)) !important;"/>
                            </div>
                        </td>
                        <td class="p-3 px-5 flex justify-end">
                            <div v-if="le.status.States == 'undo' || le.id == chap">
                                <router-link :to="{ name:'lessondata', params:{id: le.id } }">           
                                <!-- <button type="button" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline" @click="onSends(le.id)"> -->
                                    <button v-if='le.status.GNo == chap  && le.status.States == "undo"' type="button" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                        Learn
                                    </button>
                                </router-link>
                                <router-link :to="{ name:'lessondata', params:{id: le.id } }">           
                                    <button v-if='le.status.GNo != chap || le.status.States == "done"' type="button" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                        Review
                                    </button>
                                </router-link>
                                
                                <router-link :to="{ name:'reviewdata', params:{id: le.id } }">  
                                    <button v-if='le.status.GNo == chap || le.status.GNo == "undo"' type="button" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                        Test
                                    </button>
                                </router-link>
                            </div>
                            <div v-else-if="le.status.States == 'done' || le.id == chap">
                                
                                <router-link :to="{ name:'lessondata', params:{id: le.id } }">  
                                    <button type="button" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                        Review
                                    </button>
                                </router-link>
                                <router-link :to="{ name:'reviewdata', params:{id: le.id } }">  
                                    <button type="button" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                        Test
                                    </button>
                                </router-link>
                            </div>
                            <div v-else-if="le.status == ''">
                            </div>
                            
                        </td>
                    </tr>
                    
                    
                    
                </tbody>
            </table>
        </div>
    </div>
    </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  export default {
    middleware: 'auth',

    metaInfo () {
      // return { title: this.$t('home') }
    },
    computed: mapGetters({
        authenticated: 'auth/check',
        user: 'auth/user'
    }),
    data: () => ({
              chap: 1,
              chapExer: 1,
              selected:1,
              Clist:[],
              tlist:[],
              state:'',
              list:[],
              slug:'',
              currentDateWithFormat:'',
              re:'',
          }),
    created () {
        // this.getExercise()
        this.getAllList()
        
        this.callFunction()
    },
    mounted(){
        this.getChapter()
    },
    methods:{
        callFunction() {
   
            // var currentDate = new Date();
            // console.log(currentDate);
  
            this.currentDateWithFormat = new Date().toJSON().slice(0,10).replace(/-/g,'/');
            console.log(this.currentDateWithFormat);
     
        },
        onSends(index) {
            // console.log(this.listQuery.departName)
            // this.$router.push("/couponsSystem/couponsManage/fullCutCoupons/index?channel="+this.listQuery.channel+"&scene="+this.listQuery.scene+"&departName="+this.listQuery.departName+"&couponFirstType="+this.listQuery.couponFirstType);
            this.slug = index;
            console.log("# "+ this.slug);
            
            this.$router.push("/lessondata/"+this.slug);
        },
        onChange(event){
            
            this.selectChapter(this.tlist, event.target.value);
        },
        getChapter(){
            this.$http({
                url: `/api/getChapter`,
                method: 'GET',
            })
            .then((res) => {
                if(res){
                    if(res.data.result){
                        this.chap = res.data.result
                        this.re = res.data.re;
                        this.getChapterExer();
                    }
                    
                }else{
                    alert('無法取得後台數據123')
                }
            }, (res) => {
                // alert(res.response);
                alert("無法取得數據");
            })
        },
        getChapterExer(){
            console.log(this.chap);
            this.$http({
                url: `/api/getExerciseChapter`,
                method: 'POST',
                data: {
                    chap: this.chap,
                }
            })
            .then((res) => {
                if(res){
                    if(res.data.result){
                        this.chapExer = res.data.result
                    }else{
                        this.chapExer = 1;
                    }
                    
                }else{
                    alert('無法取得後台數據')
                }

            }, (res) => {
                // alert(res.response);
                alert("無法取得數據");
            })
        },
        // getExercise(){
        //     this.$http({
        //         url: `/api/getExercise`,
        //         method: 'GET',
        //     })
        //     .then((res) => {    
        //         if(res){
        //            res.data.result.forEach((item, index) => {
        //                 this.reviewChap.push(item.GNo);
        //             })
                    
        //         }else{
        //             alert('無法取得後台數據')
        //         }

        //     }, (res) => {
        //         // alert(res.response);
        //         alert("無法取得數據");
        //     })
        // },
        getAllList(){
            this.$http({
                url: `/api/getAllList`,
                method: 'GET',
            })
            .then((res) => {    
                if(res){
                //    res.data.result.forEach((item, index) => {
                //         this.reviewChap.push(item.GNo);
                //     })
                    this.tlist = res.data.result;
                    this.Clist = res.data.result;
                    console.log(res.data.result)
                    this.selectChapter(this.Clist, 1);
                    
                }else{
                    alert('無法取得後台數據')
                }

            }, (res) => {
                // alert(res.response);
                alert("無法取得數據");
            })
        },
        selectChapter(arr, range){
            this.Clist = arr.slice(range*10-10, range*10);
        }
    }
  }
</script>
<style scoped>
.slash {
  font-size: 72px;
  background: -webkit-linear-gradient( rgba(252, 165, 165, var(--tw-bg-opacity)) ,rgb(241, 29, 29));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
</style>
