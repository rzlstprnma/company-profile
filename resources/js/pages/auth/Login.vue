<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card login-form">
                    <div class="card-body">
                        <h3 class="card-title text-center">Log in to Codepen</h3>
                        <div v-if="loginFailed" class="alert alert-danger">
                            Email atau Password Anda salah.
                        </div>
                        <div class="card-text">
                            <form @submit.prevent="login">
                                <!-- to error: add class "has-danger" -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input v-model="user.email" type="email" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <div v-if="validation.email" class="alert-danger" role="alert">
                                        Masukkan Email
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <a href="#" style="float:right;font-size:12px;">Forgot password?</a>
                                    <input type="password" v-model="user.password" class="form-control form-control-sm" id="exampleInputPassword1">
                                    <div v-if="validation.password" class="alert-danger" role="alert">
                                        Masukkan Password
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                                <div class="sign-up">
                                    Don't have an account? <router-link :to="{name: 'Register'}">Crete One</router-link>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            //state loggedIn with localStorage
            loggedIn: localStorage.getItem('loggedIn'),
            //state token
            token: localStorage.getItem('token'),
            //state user
            user: [],
            //state validation
            validation: [],
            //state login failed
            loginFailed: null
        }
    },
    methods: {
        login() {
            if (this.user.email && this.user.password) {
                axios.get('/sanctum/csrf-cookie')
                    .then(response => {
                        axios.post('/api/login', {
                            email: this.user.email,
                            password: this.user.password
                        }).then(res => {

                            //debug user login
                            console.log(res)

                            if (res.data.success) {

                                //set localStorage
                                localStorage.setItem("loggedIn", "true")

                                //set localStorage Token
                                localStorage.setItem("token", res.data.token)

                                //change state
                                this.loggedIn = true

                                //redirect dashboard
                                return this.$router.push({ name: 'Home' })

                            } else {

                                //set state login failed
                                this.loginFailed = true

                            }

                        }).catch(error => {
                            console.log(error)
                        })

                    })
            }

            this.validation = []

            if (!this.user.email) {
                this.validation.email = true
            }

            if (!this.user.password) {
                this.validation.password = true
            }

        }
    },

    //check user already logged in
    mounted() {
        if (this.loggedIn) {
            return this.$router.push({ name: 'Home' })
        }
    }
}
</script>

<style scoped>
form{
	padding-top: 10px;
	font-size: 14px;
	margin-top: 30px;
}

.card-title{ font-weight:300; }

.btn{
	font-size: 14px;
	margin-top:20px;
}

.sign-up{
	text-align:center;
	padding:20px 0 0;
}

.alert{
	margin-bottom:-30px;
	font-size: 13px;
	margin-top:20px;
}
</style>