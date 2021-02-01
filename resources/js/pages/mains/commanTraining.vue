<template>
    <div class="container mt-5 md:mt-0 md:ml-14">
        <main
		class="flex-1 dark:bg-gray-900 overflow-y-auto transition duration-500 ease-in-out">
		<div class="md:px-24 md:py-12 text-gray-700 dark:text-gray-500 transition duration-500 ease-in-out">
			<h2 class="text-4xl font-medium capitalize">Recently Learned</h2>
			

			<div class="border dark:border-gray-700 transition duration-500 mt-2.5 mb-3"></div>

            <!-- Start Content -->
          <div class="grid grid-cols-1 gap-5 mt-6 sm:grid-cols-2 lg:grid-cols-4">
                <div v-for="{item, index} in items" :key="index">
                    <div class="p-4 transition-shadow border rounded-lg shadow-sm bg-white">
                        <div class="flex items-start justify-between">
                        <div class="flex flex-col space-y-2">{{item}}
                            <span class="text-gray-400">Total Users</span>
                            <span class="text-lg font-semibold">100,221</span>
                        </div>
                        </div>
                        <div>
                            <span class="inline-block px-2 text-sm text-white bg-green-300 rounded">14%</span>
                            <span>from 2019</span>
                        </div>
                    </div>
                </div>
          </div>
			<div class="flex flex-col mt-8">
				
				<div class="flex flex-row mt-2">
					<div
						class="flex w-full items-center justify-between bg-white border-l-4 border-yellow-500
						dark:bg-gray-800 px-8 py-6 transition-shadow shadow-sm">
						<!-- card -->
						<div class="flex">
                            <img class="h-16 w-16 rounded-full object-cover hidden md:flex" src="/img/graduation.jpg" alt="graduation.jpg">
							<div class="flex flex-col ml-6">
								<span class="text-lg font-bold">Classic review</span>
								<div class="mt-4 flex  flex-col lg:flex-row lg:justify-start">
									<div class="flex justify-start">
										<svg
											class="h-5 w-5 fill-current
											dark:text-gray-300"
											viewBox="0 0 24 24">
											<path
												d="M12 4a4 4 0 014 4 4 4 0 01-4 4
												4 4 0 01-4-4 4 4 0 014-4m0
												10c4.42 0 8 1.79 8
												4v2H4v-2c0-2.21 3.58-4 8-4z"></path>
										</svg>
										<span
											class="ml-2 text-sm text-gray-600
											dark:text-gray-300 capitalize">
											{{ user.name }}
										</span>
									</div>

									<div class="flex justify-start lg:ml-6">
										<svg
											class="h-5 w-5 fill-current
											dark:text-gray-300"
											viewBox="0 0 24 24">
											<path
												d="M19
												19H5V8h14m-3-7v2H8V1H6v2H5c-1.11
												0-2 .89-2 2v14a2 2 0 002 2h14a2 2
												0 002-2V5a2 2 0 00-2-2h-1V1m-1
												11h-5v5h5v-5z"></path>
										</svg>
										<span
											class="ml-2 text-sm text-gray-600
											dark:text-gray-300 capitalize">
											{{day}}
										</span>
									</div>

									<div class="flex justify-start lg:ml-6">
										<svg
											class="h-5 w-5 fill-current
											dark:text-gray-300"
											viewBox="0 0 24 24">
											<path
												d="M13 2.05v2.02c3.95.49 7 3.85 7
												7.93 0 3.21-1.92 6-4.72 7.28L13
												17v5h5l-1.22-1.22C19.91 19.07 22
												15.76 22
												12c0-5.18-3.95-9.45-9-9.95M11
												2c-1.95.2-3.8.96-5.32 2.21L7.1
												5.63A8.195 8.195 0 0111 4V2M4.2
												5.68C2.96 7.2 2.2 9.05 2
												11h2c.19-1.42.75-2.77
												1.63-3.9L4.2 5.68M6
												8v2h3v1H8c-1.1 0-2 .9-2
												2v3h5v-2H8v-1h1c1.11 0 2-.89
												2-2v-1a2 2 0 00-2-2H6m6
												0v5h3v3h2v-3h1v-2h-1V8h-2v3h-1V8h-2M2
												13c.2 1.95.97 3.8 2.22
												5.32l1.42-1.42A8.21 8.21 0 014
												13H2m5.11 5.37l-1.43 1.42A10.04
												10.04 0 0011 22v-2a8.063 8.063 0
												01-3.89-1.63z"></path>
										</svg>
										<span
											class="ml-2 text-sm text-gray-600
											dark:text-gray-300 capitalize">
											 25 Minute
										</span>
									</div>
								</div>

							</div>
						</div>

						
					</div>

					<div
						class="text-center flex flex-col items-center
						justify-center bg-white dark:bg-gray-800
						dark:text-gray-300 ml-1 px-12 cursor-pointer
						hover:bg-blue-200 dark-hover:bg-blue-500 rounded-lg transition-shadow shadow-sm">
						<!-- <svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
							<path
								d="M9.47 9.65l-1.41 1.42L11
								14l5.19-5.18-1.41-1.42L11 11.18M17 3H7c-1.1 0-2
								.9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2m0 15l-5-2.18L7
								18V5h10z"></path>
						</svg> -->
                        <span class="float-right text-xs px-2 text-white">
                            <!-- <router-link :to="{ name:'curve', query: { relesson: course }}">-->
							<div @click="nextPage()">
                            <!-- <button type="button" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline" @click="onSends(le.id)"> -->
                                <button v-if="re != 'learn'" class="items-center"><font-awesome-icon icon="play-circle" size="3x" style="color: rgba(245, 158, 11, var(--tw-bg-opacity)); !important;"/></button>
                                <button v-if="re == 'learn'" class="items-center"><font-awesome-icon icon="redo" size="2x" style="color: rgba(245, 158, 11, var(--tw-bg-opacity)); !important;"/></button>
                            
                            </div>
                        </span>
					</div>
				</div>

			</div>
		</div>
	</main>
    </div>
</template>

<script>
    import { mapGetters, mapState } from 'vuex'
    export default {
        middleware: 'auth',
        // metaInfo () {
        //   return { title: this.$t('home') }
        // },
		computed:{ 
			...mapGetters({
				authenticated: 'auth/check',
				user: 'auth/user'
			}),
			...mapState({

			})
		},
        data: () => ({
            Fword: 1,
            day:'',
			re:'',
			course:[],
			check:false,
            items: [
                { message: 'Foo' },
                { message: 'Bar' },
                { message: 'Foo' },
                { message: 'Bar' },
            ]
            // appName: window.config.appName
        }),
        created () {
            this.getFinshWord()
			this.getCurrentDay()
			this.checkTodayLearn()
			// this.getForgettingCurve()
			
        },
        methods:{
			// <router-link :to="'/curve/' + JSON.stringify(course)">
			async nextPage(){
				
				setTimeout(() => {
					if(this.check === true){
						this.$router.push({
							path: "/commanReview",
							// query: { coursess: this.course }
						})
					}else{
						alert('You should learn today lesson')
					}
				}, 1000)
						
				
				
			},
			// click(){
			// 	// 点击按钮进行一些操作，然后保存数据
			// 	this.$store.commit('curve/SET_CURVE',this.items)
			// },
			checkTodayLearn(){
				this.$http({
                    url: `/api/checkTodayLearn`,
                    method: 'GET',
                })
                .then((res) => {
                    if(res){
                        if(res.data.result){
								this.check = res.data.result
							console.log(this.check)
							// this.$store.commit('curve/SET_CURVE','this.course')
                        }else{
                        }
                        
                    }else{
                        alert('無法取得後台數據')
                    }
                }, (res) => {
                    // alert(res.response);
                    alert("無法取得數據");
                })
			},

			getForgettingCurve(){
                this.$http({
                    url: `/api/getForgettingCurve`,
                    method: 'GET',
                })
                .then((res) => {
                    if(res){
                        if(res.data.result){
							this.course = res.data.result
							
							console.log(this.course)
							// this.$store.commit('curve/SET_CURVE','this.course')
                        }else{
                            this.course = [];
                        }
                        
                    }else{
                        alert('無法取得後台數據123')
                    }
                }, (res) => {
                    // alert(res.response);
                    alert("無法取得數據");
                })
            },
            getFinshWord(){
                this.$http({
                    url: `/api/getFinshWord`,
                    method: 'GET',
                })
                .then((res) => {
                    if(res){
                        if(res.data.result){
                            this.Fword = res.data.result
                        }else{
                            this.Fword = 0;
                        }
                        
                    }else{
                        alert('無法取得後台數據123')
                    }
                }, (res) => {
                    // alert(res.response);
                    alert("無法取得數據");
                })
            },
            getCurrentDay(){
                var today = new Date();
                var day = today.getDate();
                var month = today.getMonth() + 1;
                var year = today.getFullYear();
                if (day < 10) {
                day = '0' + day
                }
                if (month < 10) {
                month = '0' + month
                }
                this.day = day + '/' + month + '/' + year;
                
            }
        }
    }
</script>
<style scoped>
</style>