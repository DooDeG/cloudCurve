<template>
    <div class="container md:ml-14">
        <div class="flex flex-col mt-20">
            <div class="flex items-center text-gray-800">
                <div class="p-4 w-full">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12 sm:col-span-6 md:col-span-3">
                            <div class="flex flex-row bg-white shadow-sm rounded p-4">
                                <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl bg-blue-100 text-blue-500">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </div>
                                <div class="flex flex-col flex-grow ml-4">
                                    <div class="text-sm text-gray-500">Finsh word</div>
                                    <div class="font-bold text-lg">{{Fword}}</div>
                                </div>
                            </div>
                        </div>
                            <div class="col-span-12 sm:col-span-6 md:col-span-3">
                                <div class="flex flex-row bg-white shadow-sm rounded p-4">
                                    <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl bg-green-100 text-green-500">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                    </div>
                                <div class="flex flex-col flex-grow ml-4">
                                    <div class="text-sm text-gray-500">Day</div>
                                    <div class="font-bold text-lg">10</div>
                                </div>
                            </div>
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

        // metaInfo () {
        //   return { title: this.$t('home') }
        // },
        computed: mapGetters({
            authenticated: 'auth/check',
            user: 'auth/user'
        }),
        data: () => ({
            Fword: 1
        }),
        created () {
            this.getFinshWord()
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
        }
    }
</script>
<style scoped>

</style>
