<template>

    <div class="row mr-0">
      <div class="col-md-2">
          <!-- <div class="nav flex-column nav-pills bg-white mt-16 rounded-lg ml-10 shadow-2xl border-dashed border-red-200" style="height: 800px;">
              <div v-for="tab in tabs" :key="tab.route" class="nav-item mt-5 font-serif text-2xl ">
                  <router-link :to="{ name: tab.route }" class="nav-link" active-class="active">
                  <router-link :to="{ name: tab.route }" class=" hover:text-blue active:border-r-4 active:border-gray-700">
                      <div class=" text-center active:border-current">
                          <font-awesome-icon :icon="tab.icon" size="3x"/>
                        
                          <div class="flex justify-center">{{ tab.name }}</div>
                      </div>
                  
                  <div class="divide-y divide-red-300 mt-4"></div>
                  <div class="flex justify-center">
                   <hr class="border-0 bg-gray-500 text-gray-500 h-px sm:w-3/4">
                  </div>
              </div>
          </div> -->
          <div class="antialiased z-0 hidden md:flex" id="app">
              <transition name="slide">
                <div class="pt-24 w-64 min-h-screen p-8 bg-white fixed left-0 top-0 shadow-2xl ease-in-out  transition-transform transition-medium">
                  <div class="flex justify-center">
                    <nav class="w-56 relative">
                      <span class="absolute h-14 w-full bg-white rounded-lg shadow ease-out transition-transform transition-medium rounded-md border-red-600 border-l-2" :style="{ transform: `translateY(calc(110% * ${selected}))` }"></span>
                      <ul class="relative">
                          <li>
                              <router-link :to="{ name:  'home'  }">
                                  <button type="button" @click="select(0)" :aria-selected="selected === 0" class="py-3 px-4 w-full flex items-center focus:outline-none focus-visible:underline">
                                      <svg
                                        :class="selected === 0 ? 'text-indigo-400' : 'text-gray-500'"
                                        class="h-6 w-6 transition-all ease-out transition-medium"
                                        viewBox="0 0 24 24"
                                        fill="currentColor"
                                      >
                                      <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M12.707 2.293a1 1 0 00-1.414 0l-9 9a1 1 0 101.414 1.414L4 12.414V21a1 1 0 001 1h5a1 1 0 001-1v-6h2v6a1 1 0 001 1h5a1 1 0 001-1v-8.586l.293.293a1 1 0 001.414-1.414l-9-9zM18 10.414l-6-6-6 6V20h3v-6a1 1 0 011-1h4a1 1 0 011 1v6h3v-9.586z"
                                      />
                                      </svg>
                                      <span
                                        :class="selected === 0 ? 'text-indigo-600' : 'text-gray-700'"
                                        class="ml-2 text-lg font-medium transition-all ease-out transition-medium"
                                      >
                                          Home
                                      </span>
                                  </button>
                            </router-link>
                        </li>
                        
                        
                        <li>
                          
                        <router-link :to="{ name:  'mains/course' }">
                          <button type="button" @click="select(1)" :aria-selected="selected === 1" class="py-3 px-4 w-full flex items-center focus:outline-none focus-visible:underline">
                        <svg
                          :class="selected === 1 ? 'text-indigo-400' : 'text-gray-500'"
                          class="h-6 w-6 transition-all ease-out transition-medium"
                          viewBox="0 0 24 24"
                          fill="currentColor"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M11.617 1.076a1 1 0 011.09.217l5.657 5.657a9 9 0 11-13.113.41A1 1 0 017 8.022v2.292a2 2 0 104 0V2a1 1 0 01.617-.924zM13 4.414v5.9A4 4 0 015.212 11.6 7 7 0 1016.95 8.364L13 4.414z"
                          />
                        </svg>
                        <span
                          :class="selected === 1 ? 'text-indigo-600' : 'text-gray-700'"
                          class="ml-2 text-lg font-medium transition-all ease-out transition-medium"
                        >
                          Lesson
                        </span>
                      </button>
                      
                        </router-link>
                        </li>
                        <li>
                          <router-link :to="{ name:  'mains/traning'  }">
                          <button type="button" @click="select(2)" :aria-selected="selected === 2" class="py-3 px-4 w-full flex items-center focus:outline-none focus-visible:underline">
                        <svg
                          :class="selected === 2 ? 'text-indigo-400' : 'text-gray-500'"
                          class="h-6 w-6 transition-all ease-out transition-medium"
                          viewBox="0 0 24 24"
                          fill="currentColor"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M7 10a3 3 0 013-3h8a3 3 0 013 3v8a3 3 0 01-3 3h-8a3 3 0 01-3-3v-8zm3-1a1 1 0 00-1 1v8a1 1 0 001 1h8a1 1 0 001-1v-8a1 1 0 00-1-1h-8z"
                          />
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M3 6a3 3 0 013-3h10a1 1 0 110 2H6a1 1 0 00-1 1v10a1 1 0 11-2 0V6z"
                          />
                        </svg>
                        <span
                          :class="selected === 2 ? 'text-indigo-600' : 'text-gray-700'"
                          class="ml-2 text-lg font-medium transition-all ease-out transition-medium"
                        >
                          Review
                        </span>
                      </button>
                      
                        </router-link>
                        </li>
                        <!-- <li>
                          <router-link :to="{ name:  'mains/commanTraining'  }">
                          <button type="button" @click="select(3)" :aria-selected="selected === 3" class="py-3 px-4 w-full flex items-center focus:outline-none focus-visible:underline">
                        <svg
                          :class="selected === 3 ? 'text-indigo-400' : 'text-gray-500'"
                          class="h-6 w-6 transition-all ease-out transition-medium"
                          viewBox="0 0 24 24"
                          fill="currentColor"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M7 10a3 3 0 013-3h8a3 3 0 013 3v8a3 3 0 01-3 3h-8a3 3 0 01-3-3v-8zm3-1a1 1 0 00-1 1v8a1 1 0 001 1h8a1 1 0 001-1v-8a1 1 0 00-1-1h-8z"
                          />
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M3 6a3 3 0 013-3h10a1 1 0 110 2H6a1 1 0 00-1 1v10a1 1 0 11-2 0V6z"
                          />
                        </svg>
                        <span
                          :class="selected === 3 ? 'text-indigo-600' : 'text-gray-700'"
                          class="ml-2 text-sm font-medium transition-all ease-out transition-medium"
                        >
                          Tradition review
                        </span>
                      </button>
                      
                        </router-link>
                        </li> -->
                        <li>
                          
                        <router-link :to="{ name:  'mains/visualization'  }">
                          <button type="button" @click="select(3)" :aria-selected="selected === 3" class="py-3 px-4 w-full flex items-center focus:outline-none focus-visible:underline" >
                        <svg
                          :class="selected === 3 ? 'text-indigo-400' : 'text-gray-500'"
                          class="h-6 w-6 transition-all ease-out transition-medium"
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
                        <span
                          :class="selected === 3 ? 'text-indigo-600' : 'text-gray-700'"
                          class="ml-2 text-lg font-medium transition-all ease-out transition-medium"
                        >
                          Visualization
                        </span>

                      </button>
                        </router-link>
                        <!-- <font-awesome-icon icon="adjust" size="xs" /> -->
                        </li>
                        <li>
                          
                        <router-link :to="{ name:  'mains/test'  }">
                          <button type="button" @click="select(4)" :aria-selected="selected === 4" class="py-3 px-4 w-full flex items-center focus:outline-none focus-visible:underline" >
                        <svg
                          :class="selected === 4 ? 'text-indigo-400' : 'text-gray-500'"
                          class="h-6 w-6 transition-all ease-out transition-medium"
                          viewBox="0 0 24 24"
                          fill="currentColor"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M7 10a3 3 0 013-3h8a3 3 0 013 3v8a3 3 0 01-3 3h-8a3 3 0 01-3-3v-8zm3-1a1 1 0 00-1 1v8a1 1 0 001 1h8a1 1 0 001-1v-8a1 1 0 00-1-1h-8z"
                          />
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M3 6a3 3 0 013-3h10a1 1 0 110 2H6a1 1 0 00-1 1v10a1 1 0 11-2 0V6z"
                          />
                        </svg>
                        <span
                          :class="selected === 4 ? 'text-indigo-600' : 'text-gray-700'"
                          class="ml-2 text-lg font-medium transition-all ease-out transition-medium"
                        >
                          test
                        </span>

                      </button>
                        </router-link>
                        <!-- <font-awesome-icon icon="adjust" size="xs" /> -->
                        </li>
                        
                      </ul>
                    </nav>
                  </div>

                </div>
                </transition>
  

          </div>
      </div>
      <div class="col-md-8">
          <transition name="fade" mode="out-in">
              <router-view />
          </transition>
      </div>
  </div>
</template>

<script>
export default {
  middleware: 'auth',
  metaInfo () {
    // return { title: this.$t('home') }
  },
  data: () => ({
        
      selected: 1,
      userId: ''
    }),
  created () {
    // this.updateInfo()
      // this.getuser();
      if(this.$route.name == 'mains/visualization'){
          this.selected = 3
      }
      if(this.$route.name == 'mains/traning'){
          this.selected = 2
      }
      // if(this.$route.name == 'mains/commanTraining'){
      //     this.selected = 3
      // }
      if(this.$route.name == 'mains/test'){
          this.selected = 4
      }
      
  },
  mounted (){
      console.log(this.$route.name);
      // if(this.$route.name == 'mains/visualization'){
      //     this.selected = 2
      // }
  },
  computed: {
    tabs () {
      return [
        // {
        //   // <i class="fas fa-book-open"></i>
        //   icon: 'book-open',
        //   name: this.$t('lesson'),
        //   route: 'mains/course'
        // },
        // {
        //   icon: 'lock',
        //   name: this.$t('exercise'),
        //   route: 'mains/exercise'
        // },
        // {
        //   icon: 'chart-bar',
        //   name: this.$t('visualization'),
        //   route: 'mains/visualization'
        // }
      ]
    }
  },
  methods:{
      select(i) {
        this.selected = i;
      },
      async updateInfo () {
      this.$http({
        // $.ajax({
        url: `/api/getPlanList`,
        method: 'POST'
      })
        .then((res) => {
          if (res.data.result) {
            this.plan = res.data.result
            this.planList = this.plan
          } else {
            alert('Unable to get plan form12345')
          }
        }, (res) => {
          alert('Unable to get plan form')
        })
    },
    async getuser () {
      this.$http({
        // $.ajax({
        url: `/api/getCurrentUser`,
        method: 'GET'
      })
        .then((res) => {
          if (res.data.result) {
            this.userId = res.data.result
          } else {
            alert('Unable to get userId')
          }
        }, (res) => {
          alert('Response error')
        })
    },
    //   getCartList(){
    //     this.$http({
    //         url: `/api/getShoppingCart`,
    //         method: 'GET',
    //         data: {
    //             // bt: window.localStorage.getItem('bt')
    //         }
    //     })
    //     .then((res) => {
    //         if(res){
                
    //         }else{
    //             alert('123456')
    //         }

    //     }, (res) => {
    //         // alert(res.response);
    //         alert("無法取得購物車");
    //     })
    // },
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
.ease-in {
  transition-timing-function: cubic-bezier(0.4, 0, 1, 1);
}
.ease-out {
  transition-timing-function: cubic-bezier(0, 0, 0.2, 1);
}
.ease-in-out {
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}

.transition-fastest {
  transition-duration: 75ms;
}
.transition-faster {
  transition-duration: 100ms;
}
.transition-fast {
  transition-duration: 150ms;
}
.transition-medium {
  transition-duration: 200ms;
}
.transition-slow {
  transition-duration: 300ms;
}
.transition-slower {
  transition-duration: 500ms;
}
.transition-slowest {
  transition-duration: 700ms;
}

.transition-all {
  transition-property: all;
}
.transition-opacity {
  transition-property: opacity;
}
.transition-transform {
  transition-property: transform;
}

.focus-visible.focus-visible\:underline {
  text-decoration: underline;
}

.slide-enter-active,
.slide-leave-active
{
  transition: transform 0.4s ease;
}

.slide-enter,
.slide-leave-to {
  transform: translateX(100%);
  transition: all 150ms ease-in 0s
}
</style>
