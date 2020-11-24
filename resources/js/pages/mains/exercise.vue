<template>
    <div class="container">
        <div class="flex flex-col mt-20">
          <!-- ===== Course ====  -->
            <div class="flex justify-around">
                <div class="text-left bg-white px-4 py-2 md:w-3/4  rounded-md shadow-xl">
                    <div class="flex justify-between">
                        <div class="text-gray-700 text-center px-4 py-2 m-2 underline bold text-3xl font-serif">Exercise</div>
                        <div></div>
                    </div>
                    <div class="flex justify-between">
                        <div class="mt-10 ml-8 text-gray-700 text-center text-xl bold font-serif">Chapter: {{chap}}</div>
                        <div class="text-gray-700 text-center px-4 py-2 m-2">
                            <div class="text-left font-serif text-2xl mt-3">
                                <!-- <router-link :to="{ name:'exam' }"> -->
                                <router-link :to="{ name: user ? 'exam' : 'login' }">
                                    <button class="text-white px-10 py-2 rounded-full shadow-xl"  style="background-color: #F34241 ">start now!</button>
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-around mt-10 bold text-3xl font-serif">Review</div>
        <div class="max-w-md w-full lg:flex mt-10" v-for="(ans, index) in reviewChap"  :key="index" >
            <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" title="Woman holding a mug">
            </div>
            <div class="border-r border-b border-l border-grey-light lg:border-l-0 lg:border-t lg:border-grey-light bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                <div class="mb-8">
                    <div class="text-black font-bold text-xl mb-2">Review chapter {{ans}}</div>
                </div>
                <div class="flex items-center">
                    <div class="text-sm">
                        <div class="text-left font-serif text-2xl mt-3">
                                <!-- <router-link :to="{ name:'exam' }"> -->
                                <!-- <router-link :to="{ name: user ? 'review' : 'login',params:{id: review.id } }"> -->
                                <router-link :to="{ name: user ? 'review' : 'login' }">
                                    <button class="text-white px-10 py-2 rounded-full shadow-xl"  style="background-color: #F34241 ">Review</button>
                                </router-link>
                        </div>
                    </div>
                </div>
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
    data: () => ({
        chap: '',
        reviewChap: [],
    }),
    computed: mapGetters({
      authenticated: 'auth/check',
      user: 'auth/user'
    }),
    created () {
        this.getChapter()
        this.getExercise()
    },
    methods:{
        getChapter(){
            this.$http({
                url: `/api/getExerciseChapter`,
                method: 'GET',
            })
            .then((res) => {
                if(res){
                    if(res.data.result){
                        this.chap = res.data.result
                    }else{
                        this.chap = 1;
                    }
                    
                }else{
                    alert('無法取得後台數據')
                }

            }, (res) => {
                // alert(res.response);
                alert("無法取得數據");
            })
        },
        getExercise(){
            this.$http({
                url: `/api/getExercise`,
                method: 'GET',
            })
            .then((res) => {    
                if(res){
                   res.data.result.forEach((item, index) => {
                        this.reviewChap.push(item.GNo);
                    })
                    
                }else{
                    alert('無法取得後台數據')
                }

            }, (res) => {
                // alert(res.response);
                alert("無法取得數據");
            })
        },
    }
}
</script>
<style scoped>
</style>
