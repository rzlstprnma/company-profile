import './bootstrap';
import router from './router';
import store from './store/index';
import Vue from 'vue';
import App from './App.vue'

new Vue({
    router,
    store,
    el: "#app",
    render: h => h(App)
});
