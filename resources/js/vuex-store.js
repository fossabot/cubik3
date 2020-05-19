import Vue from 'vue';
import Vuex, { Store } from 'vuex';
import md5 from 'md5';

Vue.use(Vuex);

const store = new Store({
    state: {
        user: null,
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
        },
    },
    strict: process.env.NODE_ENV !== 'production',
});

export default store;
