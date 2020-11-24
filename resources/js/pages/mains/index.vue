<template>

    <div class="row mr-0">
      <div class="col-md-3">
          <ul class="nav flex-column nav-pills bg-white mt-16 rounded-lg ml-10 shadow-2xl" style="height: 800px;">
              <li v-for="tab in tabs" :key="tab.route" class="nav-item mt-5 font-serif text-2xl ">
                  <router-link :to="{ name: tab.route }" class="nav-link divide-y-4 " active-class="active">
                      <!-- <fa :icon="tab.icon" fixed-width /> -->
                      <div class="flex justify-center">{{ tab.name }}</div>
                  </router-link>
                  <div class="flex justify-center">
                   <hr class="border-0 bg-gray-500 text-gray-500 h-px sm:w-3/4">
                  </div>
              </li>
          </ul>
          
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
  created () {
    // this.updateInfo()
  },
  computed: {
    tabs () {
      return [
        {
          // icon: 'user',
          name: this.$t('course'),
          route: 'mains/course'
        },
        {
          // icon: 'lock',
          name: this.$t('exercise'),
          route: 'mains/exercise'
        },
        {
          // icon: 'lock',
          name: this.$t('visualization'),
          route: 'mains/visualization'
        }
      ]
    }
  },
  methods:{
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
</style>
