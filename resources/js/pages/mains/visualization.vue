<template>
    <div class="container md:ml-14">
        <div class="relative flex flex-col flex-1 h-full max-h-full  mt-5 md:mt-20">
        
            <div class="flex flex-col flex-1 max-h-full pl-2 pr-2 rounded-md xl:pr-4">
                <!-- Main Content -->
                <main class="flex-1 pt-2">
                    <!-- Placeholder Cards -->
                    <div class="p-4 text-white bg-blue-500 rounded-md shadow-md mr-3">
                        <div class="flex items-center justify-center">
                            <svg
                            
                            class="h-6 w-12 transition-all ease-out transition-medium"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            >
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M12 7a1 1 0 011-1h8a1 1 0 011 1v8a1 1 0 11-2 0V8h-7a1 1 0 01-1-1z"
                            />
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M20.707 7.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0L9 12.414l-5.293 5.293a1 1 0 01-1.414-1.414l6-6a1 1 0 011.414 0L13 13.586l6.293-6.293a1 1 0 011.414 0z"
                            />
                            </svg>
                            <span class="text-3xl font-semibold tracking-wider uppercase">Visualization</span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-6 mt-4 md:grid-cols-2">
                        <template x-for="i in 4" >
                            <div class="flex items-center justify-center w-full h-32 bg-white rounded-md shadow-md">
                                <span class="text-xl tracking-wider text-gray-500 uppercase">

                                    <div class="col-span-12 sm:col-span-6 md:col-span-3">
                                        <div class="flex flex-row bg-white p-4">
                                            <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl bg-blue-100 text-blue-500">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                            </div>
                                            <div class="flex flex-col flex-grow ml-4">
                                                <div class="text-sm text-gray-500">Finsh word</div>
                                                <div class="font-bold text-lg">{{Fword}}</div>
                                            </div>
                                        </div>
                                    </div>

                                </span>
                            </div>
                            <div class="flex items-center justify-center w-full h-32 bg-white rounded-md shadow-md">
                                <span class="text-xl tracking-wider text-gray-500 uppercase">
                                    
                                    <div class="col-span-12 sm:col-span-6 md:col-span-3">
                                        <div class="flex flex-row bg-white  p-4">
                                            <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl bg-green-100 text-green-500">
                                                <!-- <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg> -->
                                                <font-awesome-icon icon="clock"/>
                                            </div>
                                            <div class="flex flex-col flex-grow ml-4">
                                                <div class="text-sm text-gray-500">Day</div>
                                                <div class="font-bold text-lg">10</div>
                                            </div>
                                        </div>
                                    </div>

                                </span>
                            </div>
                        </template>
                    </div>
                    <div class="flex items-center justify-around  p-4 mt-4 bg-white rounded-md shadow-md"  @click="displayToday()">
                        <span class="text-xl tracking-wider text-gray-500 uppercase">Today review data</span>
                        <div>
                            <font-awesome-icon :icon="todayDisplay ? 'chevron-up' : 'chevron-down'" class="text-gray-500"  size="1x"/>
                        
                        </div>
                    </div>
                    <div v-show="todayDisplay"  class="grid grid-cols-1 gap-6 my-4 mt-4">
                        <template x-for="i in 4" >
                            <div class="flex justify-center w-full h-96 bg-white rounded-md shadow-md">
                                <!-- <div class="flex justify-end">
                                    <font-awesome-icon icon="align-justify" class="text-gray-500"  size="1x"/>
                                </div> -->
                                <span class="text-xl tracking-wider text-gray-500 uppercase">
                                    <div class="flex justify-center mt-5">
                                        <apexchart 
                                            width="500" type="bar" 
                                            :options="options" :series="series">
                                        </apexchart>  
                                    </div>
                                </span>
                                
                                <font-awesome-icon icon="align-justify" class="text-gray-500 flex items-start mt-5"  size="1x"/>
                            </div>
                        </template>
                    </div>

                    <div v-show="todayDisplay" class="flex items-center justify-around  p-4 mt-4 bg-white rounded-md shadow-md"  @click="displayTestData()">
                        <span class="text-xl tracking-wider text-gray-500 uppercase">Lesson 1 Test data</span>
                        <div>
                            <font-awesome-icon :icon="displayTest ? 'chevron-up' : 'chevron-down'" class="text-gray-500"  size="1x"/>
                        
                        </div>
                    </div>

                    <div v-show="displayTest" class="grid grid-cols-1 gap-6 mt-4 md:grid-cols-2">
                        <template x-for="i in 4" >
                            <div class="flex items-center justify-center w-full h-32 bg-white rounded-md shadow-md">
                                <span class="text-xl tracking-wider text-gray-500 uppercase">

                                    <div class="col-span-12 sm:col-span-6 md:col-span-3">
                                        <div class="flex flex-row bg-white p-4">
                                            <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl bg-red-100 text-red-400">
                                                <!-- <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg> -->
                                                
                                                <font-awesome-icon icon="clock"/>
                                            </div>
                                            <div class="flex flex-col flex-grow ml-4">
                                                <div class="text-sm text-gray-500">Time</div>
                                                <div class="font-bold text-lg">{{testTime}}</div>
                                            </div>
                                        </div>
                                    </div>

                                </span>
                            </div>
                            <div class="flex items-center justify-center w-full h-32 bg-white rounded-md shadow-md">
                                <span class="text-xl tracking-wider text-gray-500 uppercase">
                                    
                                    <div class="col-span-12 sm:col-span-6 md:col-span-3">
                                        <div class="flex flex-row bg-white  p-4">
                                            <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl bg-yellow-100 text-yellow-500">
                                                <!-- <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg> -->
                                                <font-awesome-icon icon="check"/>
                                            </div>
                                            <div class="flex flex-col flex-grow ml-4">
                                                <div class="text-sm text-gray-500">Date</div>
                                                <div class="font-bold text-lg">{{curDate}}</div>
                                            </div>
                                        </div>
                                    </div>

                                </span>
                            </div>
                        </template>
                    </div>

                    <!-- <div v-show="displayTest"  class="grid grid-cols-1 gap-6 my-4 mt-4">
                        <template x-for="i in 4" >
                            <div class="flex items-center justify-center w-full h-96 bg-white rounded-md shadow-md">
                                <span class="text-xl tracking-wider text-gray-500 uppercase">
                        
                                    <div class="flex justify-center mt-5">
                                        <apexchart 
                                            width="500" type="bar" 
                                            :options="options2" :series="series2">
                                        </apexchart>  
                                    </div>
                                </span>
                            </div>
                        </template>
                    </div> -->
                    

                    <!-- <div v-show="displayTest" class="grid grid-cols-1 gap-6 my-4 mt-4">
                        <template x-for="i in 4" >
                            <div class="flex items-center justify-center w-full h-96 bg-white rounded-md shadow-md">
                                <span class="text-xl tracking-wider text-gray-500 uppercase">
                                    <div class="chart-wrapper">
                                        <apexchart 
                                            width="500" type="line" 
                                            :options="options2" :series="series2">
                                        </apexchart>
                                    </div>
                                </span>
                            </div>
                        </template>
                    </div> -->
                    <div v-show="todayDisplay"  class="grid grid-cols-1 gap-6 my-4 mt-4">
                        <template x-for="i in 4" >
                            <div class="flex justify-center w-full h-96 bg-white rounded-md shadow-md">
                                <!-- <div class="flex justify-end">
                                    <font-awesome-icon icon="align-justify" class="text-gray-500"  size="1x"/>
                                </div> -->
                                <span class="text-xl tracking-wider text-gray-500 uppercase">
                                    <div class="flex justify-center mt-5">
                                        <apexchart 
                                            width="500" type="bar" 
                                            :options="options2" :series="series2">
                                        </apexchart>  
                                    </div>
                                </span>
                                
                                <font-awesome-icon icon="align-justify" class="text-gray-500 flex items-start mt-5"  size="1x"/>
                            </div>
                        </template>
                    </div>
                    <!-- <div v-show="displayTest" class="grid grid-cols-1 gap-6 my-4 mt-4">
                        <template x-for="i in 4" >
                            <div class="flex items-center justify-center w-full h-96 bg-white rounded-md shadow-md">
                                <span class="text-xl tracking-wider text-gray-500 uppercase">
                                    <div class="chart-wrapper">
                                        <apexchart 
                                            width="500" type="line" 
                                            :options="options2" :series="series2">
                                        </apexchart>
                                    </div>
                                </span>
                            </div>
                        </template>
                    </div> -->

                </main>
            </div>
        </div>
        <!-- <div>Review report
        </div>
        <div>Data for the latest week
        </div>
        
        <div class="chart-wrapper">
            <apexchart 
                width="800" type="line" 
                :options="options2" :series="series2">
            </apexchart>
        </div>
        <div>
            <apexchart width="380" type="donut" :options="options2" :series="series2"></apexchart>
        </div> -->
        
        <!-- This is an example component -->
        <div>
      
    </div>
     
</div>
    
</template>

<script>
    import { mapGetters } from 'vuex'
    export default {
        middleware: 'auth',

        // metaInfo () {
        //   return { title: this.$t('home') }
        // },
        computed: mapGetters({
            authenticated: 'auth/check',
            user: 'auth/user'
        }),
        data: () => ({
            Fword: 1,
            todayDisplay: true,
            displayTest:true,
            todayReviewData: [],
            todayTestData:[],
            testdisplay:false,
            testTime: 0,
            testAccuracy: 0,
            lessondata:[],
            
            curDate:'',
            //
            options: {
                chart: {
                    id: 'vuechart-example',
                    toolbar: { show: false }
                },
                xaxis: {
                    categories: [
                    ]
                },
                title: {
                    text: 'Ans rate',
                    align: 'center',
                    style: {
                        fontSize:  '20px',
                    },
                },
                colors: ['#00897b']
            },
            series: [{
                name: 'ans rate',
                data: [
                    
                ]
            }],

            //
            testData: [],
            options2: {
                chart: {
                    id: 'vuechart-example',
                    toolbar: { show: false }
                },
                xaxis: {
                    categories: [
                    ]
                },
                title: {
                    text: 'Ans rate',
                    align: 'center',
                    style: {
                        fontSize:  '20px',
                    },
                },
                colors: ['#00897b']
            },
            series2: [{
                name: 'ans rate',
                data: [
                    
                ]
            }],
            // options2: {
            //     chart: {
            //         id: 'vuechart-example',
            //         toolbar: { show: false }
            //     },
            //     xaxis: {
            //         categories: [
            //         ]
            //     },
            //     title: {
            //         text: 'Lesson 1 Ans rate',
            //         align: 'center',
            //         style: {
            //             fontSize:  '20px',
            //         },
            //     },
            //     colors: ['#00897b']
            // },
            // series2: [{
            //     name: 'Lesson 1 ',
            //     data: [
                    
            //     ]
            // }],
            //
            
            //
        }),
        created () {
            this.getFinshWord()
            this.getTodayReviewDataVis()
            this.getTestVis()
        },
        methods:{
            getFinshWord(){
                this.$http({
                    url: `/api/getFinshWord`,
                    method: 'GET',
                })
                .then((res) => {
                    if(res){
                        if(res.data.result){
                            this.Fword = res.data.result
                        }else{
                            this.Fword = 0;
                        }
                        
                    }else{
                        alert('無法取得後台數據123')
                    }
                }, (res) => {
                    // alert(res.response);
                    alert("無法取得數據");
                })
            },
            getTestReviewDataVis(){
                this.$http({
                    url: `/api/getTestReviewDataVis`,
                    method: 'GET',
                })
                .then((res) => {
                    if(res){
                        if(res.data.result){
                            this.todayReviewData = res.data.result
                            console.log("this.todayReviewData",this.todayReviewData)
                            var result = []
                            var resultData = []
                            this.todayReviewData.forEach(item => {
                                // console.log(item.GId)
                                result.push(item.GId.split("G")[1]);
                                
                                // result.push(item.date);
                                resultData.push(item.accuracy);
                            });
                            result.sort();
                            result.sort((old,New)=>{
                                return old -New
                            })
                            // cateArr = JSON.parse(JSON.stringify(result))
                            console.log("result",result)
                            console.log("resultData",resultData)
                            this.options = {
                                xaxis:{
                                    categories:result
                                },
                                series:[{
                                    data:resultData
                                }]
                            }
                            

                        }else{
                            this.testdisplay = false
                        }
                        
                    }else{
                        alert('無法取得後台數據123')
                    }
                }, (res) => {
                    // alert(res.response);
                    alert("無法取得數據");
                })
            },
            getTestVis(){
                this.$http({
                    url: `/api/getTestVis`,
                    method: 'GET',
                })
                .then((res) => {
                    if(res){
                        if(res.data.result){
                            
                            this.testdisplay = true
                            

                            // this.testTime =res.data.result[0].totalTime
                            // this.testAccuracy =res.data.result[0].accuracy

                            // this.lessondata = res.data.lesson1
                            
                            // console.log("lessondata",this.lessondata)
                            // var result = []
                            // var resultData = []
                            // this.lessondata.forEach(item => {
                            //     // console.log(item.GId)
                            //     // result.push(item.GId.split("G")[1]);
                            //     result.push(item.date);
                            //     resultData.push(item.accuracy);
                            // });
                            
                            // console.log("lesson",result)
                            // console.log("lessonData",resultData)
                            this.testData = res.data.result
                            console.log("this.testData",this.testData)
                            var result = []
                            var resultData = []
                            var tmpCount = 0;
                            this.testData.forEach(item => {
                                console.log(item)
                                result.push(item.GId.split("G")[1]);
                                // result.push(item.date);
                                resultData.push(item.accuracy);
                                this.testAccuracy = this.testAccuracy + item.accuracy;
                                this.testTime = this.testTime + item.totalTime;
                                tmpCount ++;
                                this.curDate = item.date;
                            });
                            this.testAccuracy = this.testAccuracy / tmpCount;
                            this.testAccuracy = this.testAccuracy .toFixed(2);
                            result.sort();
                            result.sort((old,New)=>{
                                return old -New
                            })
                            // cateArr = JSON.parse(JSON.stringify(result))
                            console.log("result",result)
                            console.log("resultData",resultData)
                            this.options2 = {
                                xaxis:{
                                    categories:result
                                },
                                series:[{
                                    data:resultData
                                }]
                            }
                            // var result = []
                            // var resultData = []
                            // this.todayTestData.forEach(item => {
                            //     // console.log(item.GId)
                            //     result.push(item.GId.split("G")[1]);
                            //     resultData.push(item.accuracy);
                            // });
                            // console.log("result",result)
                            // console.log("resultData",resultData)
                            // this.options2 = {
                            //     xaxis:{
                            //         categories:result
                            //     },
                            //     series2:[{
                            //         data:resultData
                            //     }]
                            // }
                        }else{
                            console.log("4564")
                        }
                        
                    }else{
                        alert('無法取得後台數據123')
                    }
                }, (res) => {
                    // alert(res.response);
                    alert("無法取得數據");
                })
            },
            getTodayReviewDataVis(){
                this.$http({
                    url: `/api/getTodayReviewDataVis`,
                    method: 'GET',
                })
                .then((res) => {
                    if(res){
                        if(res.data.result){
                            this.todayReviewData = res.data.result
                            console.log("this.todayReviewData",this.todayReviewData)
                    //         this.categories = [
                    //             "Feb",
                    // "Mar",]
                    //         this.options.xaxis.categories  = [
                    //             "Feb",
                    // "Mar",]
                        var result = []
                        var resultData = []
                        this.todayReviewData.forEach(item => {
                            // console.log(item.GId)
                            result.push(item.GId.split("G")[1]);
                            resultData.push(item.accuracy);
                        });
                        // result.sort();
                        // result.sort((old,New)=>{
                        //     return old -New
                        // })
                        // cateArr = JSON.parse(JSON.stringify(result))
                        console.log("result",result)
                        console.log("resultData",resultData)
                        this.options = {
                            xaxis:{
                                categories:result
                            },
                            series:[{
                                data:resultData
                            }]
                        }
                            

                        }else{

                        }
                        
                    }else{
                        alert('無法取得後台數據123')
                    }
                }, (res) => {
                    // alert(res.response);
                    alert("無法取得數據");
                })
            },
            displayToday(){
                if(this.todayDisplay == false){
                    this.todayDisplay = true
                }else{
                    this.todayDisplay = false
                }
                
            },
            displayTestData(){
                if(this.displayTest == false){
                    this.displayTest = true
                }else{
                    this.displayTest = false
                }
                
            },
        }
    }
</script>
<style scoped>

</style>

