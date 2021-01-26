<template>
    <div>
        <Navbar/>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">

                </div>
                <div class="col-lg-4">
                    <Categories/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Categories from '../../components/admin/Categories.vue'
import Navbar from '../../components/admin/Navbar.vue'
export default {
    components: {
        Navbar,
        Categories
    },
}
</script>

<style>

</style>