import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from './pages/admin/Home.vue';
import PostCreate from './pages/admin/PostCreate.vue'
import Login from './pages/auth/Login.vue';
import Register from './pages/auth/Register.vue';
import NotFound from './pages/errors/NotFound.vue'

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
        path: "/admin/home",
        name: "Home",
        component: Home
    },
    {
        path: "/admin/posts/create",
        name: "PostCreate",
        component: PostCreate
    },
    {
        path: "/admin/posts/edit/:id",
        name: "PostEdit",
        component: PostCreate
    },
    {
        path: "*",
        component: NotFound
    }
];

const router = new VueRouter({
    mode: "history",
    routes
})

export default router;