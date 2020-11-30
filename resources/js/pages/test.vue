<template>

      <!-- ===== Website ====  -->
    <div style="background-color: #F4F4F4 ">
        12345
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
          this.$http({
        url: `/api/getShoppingCart`,
        method: 'POST',
        data: {
        //   select: '123456'
        }
      })
        .then((res) => {
          if (res.data.result) {
            this.plan = res.data.result
            this.planList = this.plan
          } else {
            alert('Unable to get plan form123')
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
</style>
