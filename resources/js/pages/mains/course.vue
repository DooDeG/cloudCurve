<template>
    <div class="container">
        <div class="flex flex-col mt-20">
          <!-- ===== Course ====  -->
            <div class="flex justify-around">
                <div class="text-left bg-white px-4 py-2 md:w-3/4  rounded-md shadow-xl">
                    <div class="flex justify-between">
                        <div class="text-gray-700 text-center px-4 py-2 m-2 underline bold text-3xl font-serif">Course</div>
                        <div>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div></div>
                        <div class="text-gray-700 text-center px-4 py-2 m-2">
                            <div class="text-left font-serif text-2xl mt-3">
                                <!-- <router-link :to="{ name:'exam' }"> -->
                                <router-link :to="{ name: user ? 'lesson' : 'login' }">
                                    <button class="text-white px-10 py-2 rounded-full shadow-xl"  style="background-color: #F34241 ">start now!</button>
                                </router-link>
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

  metaInfo () {
    // return { title: this.$t('home') }
  },
  computed: mapGetters({
    authenticated: 'auth/check',
    user: 'auth/user'
  }),
  created () {
    // this.updateInfo()
  },
  methods:{
      
  }
}
</script>
<style scoped>
</style>>
