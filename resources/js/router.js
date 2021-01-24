import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from './pages/admin/Home.vue';
import Login from './pages/auth/Login.vue';
import Register from './pages/auth/Register.vue';

Vue.use(VueRouter);

const routes = [
    {
        path: "/admin/login",
        name: "Login",
        component: Login
    },
    {
        path: "/admin/register",
        name: "Register",
        component: Register
    },
    {
        path: "/home",
        name: "Home",
        component: Home
    }
];

const router = new VueRouter({
    mode: "history",
    routes
})

export default router;