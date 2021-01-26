<template>
    <div class="container">
        <div id="accordion" class="accordion">
            <div class="card mb-0">
                <div class="card-header accordion-header collapsed" data-toggle="collapse" data-target="#collapseOne">
                    <strong class="card-title">
                        Categories
                    </strong>
                </div>
                <div id="collapseOne" class="card-body collapse" data-parent="#accordion">
                    <form @submit.prevent="createCategory" method="post">
                        <div class="form-group">
                            <label for="category_name">Category Name</label>
                            <input type="text" v-model="categories.category_name" class="form-control-sm form-control">
                        </div>
                        <button class="btn btn-sm btn-block btn-primary">Create Category</button>
                    </form>
                    <table class="table mt-4">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="category in categories" :key="category.id">
                                <td>{{ category.category_name }}</td>
                                <td>
                                    <a href="#" @click.prevent="deleteCategory(category.id)" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            categories: [],            
            //state loggedIn with localStorage
            loggedIn: localStorage.getItem('loggedIn'),
            //state token
            token: localStorage.getItem('token'),
        }
    },
    methods: {
        getCategories(){
            axios
                .get('/api/admin/categories')
                .then(res => {
                    this.categories = res.data
                })
        },
        createCategory(){
            axios
                .post('/api/admin/categories', {
                    category_name: this.categories.category_name
                })
                .then(res => {
                    this.categories = [...this.categories, res.data]
                })
        },
        deleteCategory(id){
            axios
                .post('/api/admin/category/delete/'+id, {
                    _method : 'DELETE'
                })
                .then(res => {              
                    this.categories = this.categories.filter(category => category.id != id)
                })
        }
    },
    mounted() {
        this.getCategories()
    }
}
</script>

<style lang="scss" scoped>
.accordion {
    .card-header{
        cursor: pointer;
        &:after {
            font-family: 'FontAwesome';  
            content: "\f068";
            float: right; 
        }
    }
    .card-header.collapsed:after {
        /* symbol for "collapsed" panels */
        content: "\f067"; 
    }
    .card-body{
        max-height: 500px;
        overflow: auto;
    }
}
</style>