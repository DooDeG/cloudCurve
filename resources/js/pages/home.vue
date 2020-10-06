<template>

      <!-- ===== Website ====  -->
    <div style="background-color: #F4F4F4 ">
        <div class="container hidden md:flex md:flex-col ">
            <div class="logo-container md:mt-0 flex flex-row-reverse ">
                <img class="logo mobile" style="max-width:65%" src="/img/language.png" alt="">
            </div>
            <div class=" text-left -mt-8 font-serif text-5xl">Study, Learn & <br>Live a New Language!</div>
            <div class="text-left font-serif text-2xl mt-3 mb-5">
                <button class="text-white px-10 py-2 rounded-full shadow-2xl"  style="background-color: #F34241 ">start now!</button>
            </div>
        </div>
        <!-- ===== Our Course ====  -->
        <div class=" bg-white pt-8 pb-16">
            <div class="text-center font-serif text-4xl text-gray-200">
                COURES
            </div>
            <div class="container text-center font-serif text-4xl -mt-8 border-b-2 border-gray-200 w-2/3 md:w-1/2 xl:w-1/3 pb-0">
            Our Course
            </div>
            <div class="container shadow-2xl mt-5 pb-10 md:max-w-5xl" style="border-radius: 20px;">
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
                              <button class="text-white px-10 py-2 rounded-full shadow-2xl"  style="background-color: #F34241 ">Learning now！</button>
                        </div>
                    </div>
                    <div class="mt-5"><img class="logo mobile" style="max-width:100%" src="/img/imagebox2.png" alt=""></div>
                </div>
            </div>
        </div>
        <div class="mt-5 container flex flex-col text-center">
            <div class="container text-4xl font-serif border-b-2 border-gray-200 border-b-2 border-white w-1/2">Visualization</div>
            <div class="flex justify-center md:-ml-16 md:-mt-5">
                <div class=" text-center px-4 py-2 m-2 ">
                    <div class="mt-5 flex justify-center"><img class="logo mobile" style="max-width:100%" src="/img/visualization.png" alt=""></div>
                </div>
                <div class="text-center px-4 py-2 m-2">
                    <div class="text-xl text-gray-800 font-serif mt-16">View your own data.</div>
                    <div class="text-left flex justify-center ">
                      <div class="text-right md:pt-16">
                        <button class="text-lg text-white px-8 py-2 rounded-full shadow-2xl"  style="background-color: #F34241 ">View</button>
                    </div>
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
  }
}
</script>
<style scoped>
</style>>
