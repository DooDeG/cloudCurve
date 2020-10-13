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
