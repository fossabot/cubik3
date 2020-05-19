import axios from 'axios';
import Vue from 'vue';
import router from './router';
import store from './vuex-store';

// Make basic libraries accessible globally
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.Vue = Vue;

// Register components dynamically
const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Set user in store
const el = document.querySelector('#userData');
if (el) {
    const user = JSON.parse(el.innerHTML);
    store.commit('setUser', user);
}

// Initialize app
const app = new Vue({
    router,
    store,
}).$mount('#app');
