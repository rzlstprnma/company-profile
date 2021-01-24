import './bootstrap';
import router from './router';
import Vue from 'vue';
import App from './App.vue'


new Vue({
    router,
    el: "#app",
    render: h => h(App)
});
