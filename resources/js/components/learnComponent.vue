<template>
    <div class="container">
        <div class="flex justify-center mt-24">
            <div class="text-2xl md:text-4xl bold font-serif mb-10 border-b-2 border-black w-1/4 pl-2 capitalize">{{En}}</div>
            <div @click="playVoice">
                <font-awesome-icon icon="headphones" size="2x" style="color:rgba(75, 85, 99, var(--tw-bg-opacity)) !important;"/>
            </div>
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
    const synth = window.speechSynthesis;
    const msg = new SpeechSynthesisUtterance();
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
            playVoice() {
                this.handleSpeak(this.En) 
            },
            // 语音播报的函数
            handleSpeak(text) {
                msg.text = text;   
                // msg.lang = "en-US";  
                msg.volume = 1;     
                msg.rate = 1;      
                msg.pitch = 1;      
                synth.speak(msg); 
            },
            // 语音停止
            handleStop(e) {
                msg.text = e;
                // msg.lang = "zh-CN";
                synth.cancel(msg);
            },
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
