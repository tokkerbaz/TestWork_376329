import Vue from 'vue';
import App from './App.vue';
import axios from 'axios';
import VueAxios from './axios'
import  store  from './store';
import router from './router';

Vue.use(VueAxios)

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.config.productionTip = false

new Vue({
  store,
  router,
  created () {
    const userInfo = localStorage.getItem('user')
    if (userInfo) {
      const userData = JSON.parse(userInfo)
      this.$store.commit('setUserData', userData)
    }
    axios.interceptors.response.use(
        response => response,
        error => {
          if (error.response.status === 401) {
            this.$store.dispatch('logout')
          }
          return Promise.reject(error)
        }
    )
  },
  render: h => h(App),
}).$mount('#app')
