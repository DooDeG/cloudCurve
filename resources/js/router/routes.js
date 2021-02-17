function page (path) {
    return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
    // { path: '/', name: 'welcome', component: page('welcome.vue') },
    { path: '/', name: 'home', component: page('home.vue') },
    
    { path: '/test', name: 'test', component: page('test.vue') },
    // { path: '/learning', name: 'learning', component: page('learning.vue'), redirect: '/test', },
    { path: '/mains',
      name: 'mains',
      component: page('mains/index.vue'),
      children: [
            { path: '', redirect: { name: 'mains/course.vue' } },
            { path: 'course', name: 'mains/course', component: page('mains/course.vue') },
            { path: 'exercise', name: 'mains/exercise', component: page('mains/exercise.vue') },
            { path: 'visualization', name: 'mains/visualization', component: page('mains/visualization.vue') },
            
            // review page
            { path: 'traning', name: 'mains/traning', component: page('mains/traning.vue') },

            //tradition review page
            { path: 'commanTraining', name: 'mains/commanTraining', component: page('mains/commanTraining.vue') },
            //tradition review page
            { path: 'test', name: 'mains/test', component: page('mains/test.vue') },

    ] },
    { path: '/lesson', name: 'lesson', component: page('curriculum/lesson.vue') },
    { path: '/lessondata/:id', name: 'lessondata', component: page('curriculum/lessondata.vue') },
    { path: '/curve', name: 'curve', component: page('curriculum/curve.vue') },
    { path: '/exam', name: 'exam', component: page('curriculum/exam.vue') },
    { path: '/review', name: 'review', component: page('curriculum/review.vue') },
    { path: '/reviewdata/:id', name: 'reviewdata', component: page('curriculum/reviewdata.vue') },
    { path: '/commanReview', name: 'curve', component: page('curriculum/commanReview.vue') },
    { path: '/SevenDayTest', name: 'SevenDayTest', component: page('curriculum/SevenDayTest.vue') },
    
    { path: '/login', name: 'login', component: page('auth/login.vue') },
    { path: '/register', name: 'register', component: page('auth/register.vue') },
    { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
    { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
    { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
    { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

    { path: '/settings',
      component: page('settings/index.vue'),
      children: [
          { path: '', redirect: { name: 'settings.profile' } },
          { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
          { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
      ] },

    { path: '*', component: page('errors/404.vue') }
]
