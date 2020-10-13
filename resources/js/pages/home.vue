<template>

      <!-- ===== Website ====  -->
    <div style="background-color: #F4F4F4 ">
        <div class="container hidden md:flex md:flex-col ">
            <div class="logo-container md:mt-0 flex flex-row-reverse ">
                <img class="logo mobile" style="max-width:65%" src="/img/language.png" alt="">
            </div>
            <div class=" text-left -mt-8 font-serif text-5xl">Study, Learn & <br>Live a New Language!</div>
            <div class="text-left font-serif text-2xl mt-3 mb-5">
                <button  @click="getCartList" class="text-white px-10 py-2 rounded-full shadow-2xl"  style="background-color: #F34241 ">start now!</button>
            </div>
        </div>
        <!-- ===== Our Course ====  -->
        <div class="hidden md:flex flex-col md:visible bg-white pt-8 pb-20">
            <div class="text-center font-serif text-4xl text-gray-200">
                COURES
            </div>
            <div class="container text-center font-serif text-4xl -mt-8 border-b-2 border-gray-200 w-2/3 md:w-1/2 xl:w-1/3 pb-0">
            Our Course
            </div>
            <div class="container shadow-2xl mt-5 pb-16 md:max-w-5xl" style="border-radius: 20px;">
                <div class="flex justify-around">
                    <div class="mt-5"><img class="logo mobile" style="max-width:100%" src="/img/imagebox.png" alt=""></div>
                    <div class="text-left flex flex-col w-1/3 md:mt-16">
                        <div class="font-serif text-2xl font-bold  md:-ml-16">Online Learning</div>
                        <div class="font-serif text-lg md:-ml-24 md:mt-5">Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Vivamus suscipit tortor eget felis porttitor volutpat. </div>
                        <div class="text-right md:pt-16">
                            <button class="text-white px-10 py-2 rounded-full shadow-2xl"  style="background-color: #F34241 ">Learning now！</button>
                        </div>
                    </div>
                </div>
                <div class="flex justify-around">
                    <div class="text-left flex flex-col w-1/3 md:mt-12">
                        <div class="font-serif text-2xl font-bold  ">Online Exercise</div>
                        <div class="font-serif text-lg md:mt-5">Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Vivamus suscipit tortor eget felis porttitor volutpat. </div>
                        <div class="text-right md:pt-16">
                              <button class="text-white px-10 py-2 rounded-full shadow-2xl" style="background-color: #F34241 ">Learning now！</button>
                        </div>
                    </div>
                    <div class="mt-5"><img class="logo mobile" style="max-width:100%" src="/img/imagebox2.png" alt=""></div>
                </div>
            </div>
        </div>
        <div class="rounded-lg flex items-center justify-center px-5 py-5 md:mt-2 bg-indigo-600 -mt-5" style="margin-top:-10px">
            <div class="w-full flex justify-center overflow-hidden relative px-8 pt-2 pb-16 text-white w-1/2">
                <div>
                    <h3 class="text-4xl font-bold font-serif text-white leading-tight mb-5 border-black mb-12 relative z-10 text-center border-b-2 border-white">Visualization</h3>
                    <p class="relative z-10 mt-24 pt-4 flex justify-center">
                        <a href="#" class="py-2 px-10 rounded-full shadow-2xl text-white bg-gray-900 hover:bg-black focus:outline-none transition-all duration-300 ease-in-out" style="background-color: #F34241">View your own data.</a>
                    </p>
                </div>
                <div class="absolute bottom-0 flex justify-center right-0 mb-2 mr-2 w-full z-0">
                    <img class="logo mobile" style="max-width:100%" src="/img/visualization.png" alt="">
                </div>
            </div>
        </div>
        
        <!-- ===== Mobile ====  -->
        <div id="container" class="w-4/5 mx-auto md:hidden">
            <div class="flex flex-col sm:flex-row">
            <!-- Card 1 -->
            <div class="sm:w-1/4 p-2">
                <div class="bg-white px-6 py-8 rounded-lg shadow-lg text-center">
                <div class="mb-3">
                    <img
                    class="w-auto mx-auto rounded-full"
                    src="https://i.pravatar.cc/150?img=66"
                    alt=""
                    />
                </div>
                <h2 class="text-xl font-medium text-gray-700">Pande Muliada</h2>
                <span class="text-blue-500 block mb-5">Front End Developer</span>

                <a href="#" class="px-4 py-2 bg-blue-500 text-white rounded-full"
                    >Hire</a
                >
                </div>
            </div>

            <!-- Card 2 -->
            <div class="sm:w-1/4 p-2">
                <div class="bg-white px-6 py-8 rounded-lg shadow-lg text-center">
                <div class="mb-3">
                    <img
                    class="w-auto mx-auto rounded-full"
                    src="https://i.pravatar.cc/150?img=31"
                    alt=""
                    />
                </div>
                <h2 class="text-xl font-medium text-gray-700">Saraswati Cahyati</h2>
                <span class="text-blue-500 block mb-5">Back End Developer</span>

                <a href="#" class="px-4 py-2 bg-blue-500 text-white rounded-full"
                    >Hire</a
                >
                </div>
            </div>

            <!-- Card 3 -->
            <div class="sm:w-1/4 p-2">
                <div class="bg-white px-6 py-8 rounded-lg shadow-lg text-center">
                <div class="mb-3">
                    <img
                    class="w-auto mx-auto rounded-full"
                    src="https://i.pravatar.cc/150?img=18"
                    alt=""
                    />
                </div>
                <h2 class="text-xl font-medium text-gray-700">Wayan Alex</h2>
                <span class="text-blue-500 block mb-5">Data Scientist</span>

                <a href="#" class="px-4 py-2 bg-blue-500 text-white rounded-full"
                    >Hire</a
                >
                </div>
            </div>

            <!-- Card 4 -->
            <div class="sm:w-1/4 p-2">
                <div class="bg-white px-6 py-8 rounded-lg shadow-lg text-center">
                <div class="mb-3">
                    <img
                    class="w-auto mx-auto rounded-full"
                    src="https://i.pravatar.cc/150?img=28"
                    alt=""
                    />
                </div>
                <h2 class="text-xl font-medium text-gray-700">Ketut Julia</h2>
                <span class="text-blue-500 block mb-5">Project Manager</span>

                <a href="#" class="px-4 py-2 bg-blue-500 text-white rounded-full"
                    >Hire</a
                >
                </div>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  // middleware: 'auth',

  metaInfo () {
    return { title: this.$t('home') }
  },
  created () {
    this.updateInfo()
  },
  methods:{
      updateInfo () {
    //   this.$http({
        $.ajax({
        url: `/api/getPlanList`,
        method: 'POST'
      })
        .then((res) => {
          if (res.data.result) {
            this.plan = res.data.result
            this.planList = this.plan
          } else {
            alert('Unable to get plan form')
          }
        }, (res) => {
          alert('Unable to get plan form')
        })
    },
      getCartList(){
        this.$http({
            url: `/api/getShoppingCart`,
            method: 'GET',
            data: {
                // bt: window.localStorage.getItem('bt')
            }
        })
        .then((res) => {
            if(res){
                
            }else{
                alert('123456')
            }

        }, (res) => {
            // alert(res.response);
            alert("無法取得購物車");
        })
    },
    getAllAdminLogs(){
                this.loading = true;
                this.$http({
                    url: `getAllAdminLog`,
                    method: 'POST',
                })
                .then((res) => {
                    if(res.data.status == 'success'){
                        this.logs = res.data.result;
                        this.filterList = this.logs;
                        this.totalRecord = this.filterList.length;
                        this.loading = false;
                        this.searchFilter();
                    }else{
                        alert("無法取得系統記錄");
                    }
                }, () => {
                    alert("無法取得系統記錄");
                })
            },
  }
}
</script>
<style scoped>
</style>>
