<template>
    <nav class="container navbar navbar-expand-lg navbar-light bg-light">
        <router-link class="navbar-brand" :to="{name: 'Home'}">{{ user.name }}</router-link>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
                <a href="#" @click="logout" class="nav-link text-danger">Logout</a>
            </li>
        </ul>
        </div>
    </nav>
</template>

<script>
export default {    
    data() {
        return {
            //state loggedIn with localStorage
            loggedIn: localStorage.getItem('loggedIn'),
            //state token
            token: localStorage.getItem('token'),
            //state user logged In
            user: []
        }
    },

    created() {
        axios.get('http://localhost:8000/api/user', {headers: {'Authorization': 'Bearer '+this.token}})
        .then(response => {
            this.user = response.data // assign response to state user
        })
    },

    methods: {
        logout() {
            axios.get('http://localhost:8000/api/logout')
            .then(() => {
                //remove localStorage
                localStorage.removeItem("loggedIn")    


                //redirect
                return this.$router.push({ name: 'Login' })
            })
        }
    }
}
</script>

<style>

</style>