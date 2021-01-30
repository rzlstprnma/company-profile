<template>
    <div class="container">
        <div id="accordion" class="accordion">
            <div class="card mb-0">
                <div class="card-header accordion-header collapsed" data-toggle="collapse" data-target="#collapse-tag">
                    <strong class="card-title">
                        Tags
                    </strong>
                </div>
                <div id="collapse-tag" class="card-body collapse" data-parent="#accordion">
                    <form @submit.prevent="createTag" method="post">
                        <div class="form-group">
                            <label for="tag_name">Tag Name</label>
                            <input type="text" id="tag_name" v-model="tags.tag_name" class="form-control-sm form-control">
                        </div>
                        <button class="btn btn-sm btn-block btn-primary">Create Tag</button>
                    </form>
                    <table class="table mt-4">
                        <thead>
                            <tr>
                                <th>Tag Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="tag in tags" :key="tag.id">
                                <td>{{ tag.tag_name }}</td>
                                <td>
                                    <a href="#" @click.prevent="deleteTag(tag.id)" class="btn btn-sm btn-danger">Delete</a>
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
            tags: [],            
        }
    },
    methods: {
        getTag(){
            axios
                .get('/api/admin/tags')
                .then(res => {
                    this.tags = res.data
                })
        },
        createTag(){
            axios
                .post('/api/admin/tags', {
                    tag_name: this.tags.tag_name
                })
                .then(res => {
                    this.tags = [...this.tags, res.data]
                })
        },
        deleteTag(id){
            axios
                .post('/api/admin/tags/'+id, {
                    _method : 'DELETE'
                })
                .then(res => {              
                    this.tags = this.tags.filter(tag => tag.id != id)
                })
        }
    },
    mounted() {
        this.getTag()
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