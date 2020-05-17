import _ from 'lodash';
import axios from 'axios';
import Vue from 'vue';
import router from './router';

// Make basic libraries accessible globally
window._ = _;
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.Vue = Vue;

// Register components dynamically
const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Initialize app
new Vue({
    router,
}).$mount('#app');
