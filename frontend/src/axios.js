import ax from 'axios'

// insert all your axios logic here

export const axios = ax

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.withCredentials = true;

export default {
    install (Vue) {
        Vue.prototype.$axios = ax
    }
}