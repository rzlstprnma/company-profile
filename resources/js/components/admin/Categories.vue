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
                            <input type="text" v-model="category_name" class="form-control-sm form-control">
                            <span v-if="allCategoryErrors.length != 0" class="alert-danger">
                                {{ allCategoryErrors.category_name[0] }}
                            </span>
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
                            <tr v-for="category in allCategories" :key="category.id">
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
import { mapGetters, mapActions } from 'vuex'

export default {
    data() {
        return {
            category_name: "",          
        }
    },
    computed: mapGetters(['allCategories', 'allCategoryErrors']),
    methods: {
        ...mapActions(['fetchCategories', 'addCategory', 'deleteCategory']),
        createCategory(){
            this.$store.dispatch('addCategory', this.category_name)
        }
    },
    created() {
        this.fetchCategories()
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