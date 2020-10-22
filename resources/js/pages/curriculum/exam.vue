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
                <button class=" text-teal-500 rounded-full font-bold py-4 px-6 mr-2 flex items-center hover:bg-teal-500 hover:text-white"  @click="$router.go(-1)">
                    <svg class="h-5 w-5 mr-2 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
                        <path id="XMLID_10_" d="M438,372H36.355l72.822-72.822c9.763-9.763,9.763-25.592,0-35.355c-9.763-9.764-25.593-9.762-35.355,0 l-115.5,115.5C-46.366,384.01-49,390.369-49,397s2.634,12.989,7.322,17.678l115.5,115.5c9.763,9.762,25.593,9.763,35.355,0 c9.763-9.763,9.763-25.592,0-35.355L36.355,422H438c13.808,0,25-11.193,25-25S451.808,372,438,372z"></path>
                    </svg>
                </button>
            </div>
            
        </div>
        <div class="flex justify-center mt-24">
            <div class="text-2xl bold font-serif mb-10 border-b-2 border-black w-1/4 pl-2 mr-5">
                v.做,实行,尽力,给予,可用,制作,算出,解答
            </div>
            <!-- <div class="text-2xl bold mb-4 font-serif underline">Do</div> -->
            <div class="text-center font-serif text-md ">
                <button class="text-white px-4 py-2 rounded-xl shadow-md bg-green-500">Next</button>
            </div>
        </div>
        
        <div class="flex justify-center">
            <div class="text-2xl text-left px-4 py-2 m-2 w-1/3 rounded-md shadow-sm bg-gray-200 hover:bg-teal-500 hover:text-white cursor-pointer">
                1. do
            </div>
        </div>
        <div class="flex justify-center">
            <div class="text-2xl text-left px-4 py-2 m-2 w-1/3 rounded-md shadow-sm bg-gray-200 hover:bg-teal-500 hover:text-white cursor-pointer">
                2. it
            </div>
        </div>
        <div class="flex justify-center">
            <div class="text-2xl text-left px-4 py-2 m-2 w-1/3 rounded-md shadow-sm bg-gray-200 hover:bg-teal-500 hover:text-white cursor-pointer">
                3. make
            </div>
        </div>
        <div class="flex justify-center">
            <div class="text-2xl text-left px-4 py-2 m-2 w-1/3 rounded-md shadow-sm bg-gray-200 hover:bg-teal-500 hover:text-white cursor-pointer">
                4. cookie
            </div>
        </div>
    </div>
</template>

<script>
export default {
  middleware: 'auth',

  metaInfo () {
    // return { title: this.$t('home') }
  },
  created () {
    // this.updateInfo()
  },
  methods:{
      
  }
}
</script>
<style scoped>
</style>>
