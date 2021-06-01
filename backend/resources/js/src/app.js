import Vue from 'vue';
import App from './App.vue';
import VueAxios from 'vue-axios';
import axios from 'axios';
import { router } from './router';

window.Vue = require('vue');
window.axios = require('axios');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.use(VueAxios, axios);

const app = new Vue({
    router,
    render: h => h(App),
}).$mount("#testwork");
