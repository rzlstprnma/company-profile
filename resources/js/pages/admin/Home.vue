<template>
    <div>
        <Navbar/>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <Posts/>
                </div>
                <div class="col-lg-4">
                    <Categories/>
                    <Tags class="mt-3"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Categories from '../../components/admin/Categories.vue'
import Tags from '../../components/admin/Tags.vue'
import Navbar from '../../components/admin/Navbar.vue'
import Posts from '../../components/admin/Posts.vue'
export default {
    components: {
        Navbar,
        Categories,
        Tags,
        Posts,
    },
    data() {
        return {
            //state loggedIn with localStora
            loggedIn: localStorage.getItem('loggedIn'),
            //state token
            token: localStorage.getItem('token'),
        }
    },
    //check user already logged in
    mounted() {
        if (!this.loggedIn) {
            return this.$router.push({ name: 'Login' })
        }
    }

}
</script>

<style>

</style>