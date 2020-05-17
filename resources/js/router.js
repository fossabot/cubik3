import Vue from 'vue';
import VueRouter from 'vue-router';

import Error404 from './pages/Error404.vue';
import Home from './pages/Home.vue';

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/home',
            component: Home,
        },
        // This route must be last:
        {
            path: '*',
            name: '404',
            component: Error404,
        },
    ],
});
