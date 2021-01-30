<template>
    <div>
        <Navbar/>
        <PostCreate/>
    </div>
</template>

<script>
import Navbar from '../../components/admin/Navbar.vue'
import PostCreate from '../../components/admin/PostCreate.vue'
export default {
    components: {
        PostCreate,
        Navbar
    }
}
</script>

<style>

</style>