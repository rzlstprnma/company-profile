<template>
    <div class="container">
        <div class="row">
            <div class="col-6"></div>
            <div class="col-6">
                <router-link :to="{name: 'PostCreate'}" class="float-right btn btn-sm btn-primary">New Post</router-link>
            </div>
        </div>
        <div v-for="post in posts" :key="post.id" class="card mt-3 card-body">
            <div class="post-title">
                <router-link class="hidden-text" to=""><h5><strong>{{ post.title }}</strong></h5></router-link>
            </div>
            <div class="mt-1">
                <div class="float-left post-action">
                    <router-link class="btn btn-sm btn-info text-dark" to=""><i class="fa fa-eye"></i></router-link>
                    <router-link class="ml-2 btn btn-sm btn-warning text-dark" to=""><i class="fa fa-pencil"></i></router-link>
                    <router-link class="ml-2 btn btn-sm btn-danger text-dark" to=""><div class="fa fa-trash"></div></router-link>
                </div>
                <div class="float-right post-category"><span class="badge badge-success">{{ post.category.category_name }}</span></div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            posts : [],
        }
    },
    methods: {
        getPosts() {
            axios
                .get('/api/admin/posts')
                .then(res => {
                    this.posts = res.data
                })
        }
    },
    mounted(){
        this.getPosts()
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