<template>
    <div class="container">
        <div class="row">
            <div class="col-6"></div>
            <div class="col-6">
                <router-link :to="{name: 'PostCreate'}" class="float-right btn btn-sm btn-primary">New Post</router-link>
            </div>
        </div>
        <div v-for="post in allPosts" :key="post.id" class="card mt-3 card-body">
            <div class="post-title">
                <router-link class="hidden-text" to=""><h5><strong>{{ post.title }}</strong></h5></router-link>
            </div>
            <div class="mt-1">
                <div class="float-left post-action">
                    <router-link class="btn btn-sm btn-info text-dark" to=""><i class="fa fa-eye"></i></router-link>
                    <router-link class="ml-2 btn btn-sm btn-warning text-dark" to=""><i class="fa fa-pencil"></i></router-link>
                    <a class="ml-2 btn btn-sm btn-danger text-dark" @click.prevent="deletePost(post.id)"><div class="fa fa-trash"></div></a>
                </div>
                <div class="float-right post-category"><span class="badge badge-success" v-if="post.category.category_name">{{ post.category.category_name }}</span></div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
export default {
    computed: mapGetters(['allPosts']),
    methods: {
        ...mapActions(['fetchPosts', 'deletePost']),
    },
    created(){
        this.fetchPosts()
    }
}
</script>

<style scoped>
.card-body .post-title{
    white-space: nowrap !important;
    overflow: hidden !important;
    text-overflow: ellipsis !important;
}
a{
    font-size: 12px;
}
</style>