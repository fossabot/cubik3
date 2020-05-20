import Vue from 'vue';
import VueRouter from 'vue-router';

import store from './vuex-store';

import Error404 from './pages/Error404.vue';
import Index from './pages/Index.vue';
import Login from './pages/Login.vue';
import Register from './pages/Register.vue';
import User from './pages/User.vue';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Index,
        },
        {
            path: '/login',
            component: Login,
            meta: { unauthorized: true },
        },
        {
            path: '/register',
            component: Register,
            meta: { unauthorized: true },
        },
        {
            path: '/@:user',
            component: User,
        },
        // This route must be last:
        {
            path: '*',
            name: '404',
            component: Error404,
        },
    ],
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition;
        } else {
            return { x: 0, y: 0 };
        }
    },
});

// Before entering routes, check authentication requirements
router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!store.state.user) {
            next({
                path: '/login',
                query: { redirect: to.fullPath },
            });
        } else {
            next();
        }
    } else if (to.matched.some(record => record.meta.unauthorized)) {
        if (!store.state.user) {
            next();
        } else {
            next({
                path: '/',
            });
        }
    } else {
        next();
    }
});

export default router;
