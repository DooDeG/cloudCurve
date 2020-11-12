<template>
    <div class="container">
        <div class="flex justify-center mt-24">
            <div class="text-2xl md:text-4xl bold font-serif mb-10 border-b-2 border-black w-1/4 pl-2 capitalize">{{En}}</div>
            <!-- <div class="text-2xl bold mb-4 font-serif underline">Do</div> -->
        </div>
        <div class="flex justify-center mt-10">
            <div class="text-2xl bold mb-4 font-serif">
                {{Ch}}
            </div>
        </div>
        <div class="text-center font-serif text-xl ml-2">
            <button class="text-white px-4 py-2 rounded-xl shadow-md bg-green-500 capitalize" @click="closed('false')">try again</button>
        </div>
    </div>
</template>

<script>
    export default {
        middleware: 'auth',
        props: ['En', 'Ch'],
        metaInfo () {
            // return { title: this.$t('home') }
        },
        data: () => ({
            // En: '',
            // Ch: '',
        }),
        created () {
            // this.updateInfo()
            // this.getEnWorldList();
        },
        methods:{
            closed(val) {
                const data = {
                    num: val
                }
                this.$emit("closedModal", data);
                
            },
            // getEnWorldList(){
            //     this.$http({
            //         url: `/api/getEnWorldList`,
            //         method: 'GET',
            //     })
            //     .then((res) => {
            //         if(res){
            //             this.currentWord = res.data.result
            //             this.wordList = res.data.result
            //             this.currentEn = this.currentWord[this.no].english
            //             this.currentCh = this.currentWord[this.no].chinese
            //             console.log(this.currentEn)
            //             res.data.result.forEach((item, index) => {
            //                 this.wId.push(item.id);
            //             })
                        
            //         }else{
            //             alert('無法取得後台數據')
            //         }

            //     }, (res) => {
            //         // alert(res.response);
            //         alert("無法取得數據");
            //     })
            // },
            // nextWord() {
            //     this.no ++;
            //     this.currentEn = this.currentWord[this.no].english
            //     this.currentCh = this.currentWord[this.no].chinese
            // },
            // preWord() {
            //     this.no --;
            //     this.currentEn = this.currentWord[this.no].english
            //     this.currentCh = this.currentWord[this.no].chinese
            // },
            // updateGroupInfo () {
            //     console.log(this.wordList)
            //     console.log(this.wId)
            //     this.$http({
            //         url: `/api/updateGroupInfo`,
            //         method: 'POST',
            //         data: {
            //             select: this.wordList,
            //             wId: this.wId
            //         }
            //     })
            //         .then((res) => {
            //             this.$router.push({ name: 'mains/course' })
            //         }, (res) => {
            //             alert('Unable to get plan form')
            //         })
            //     },
        }
    }
</script>
<style scoped>
</style>>
