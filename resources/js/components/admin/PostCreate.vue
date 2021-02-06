<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-body">
                    <form @submit.prevent="storePost()" id="post-form" enctype="multipart/form-data">
                        <div class="float-right">
                            <button class="btn btn-success btn-sm" value="publish">Publish</button>
                            <button class="btn btn-secondary btn-sm" value="draft">Save to Draft</button>
                        </div>
                        <div class="form-group mt-5">
                            <label for="title">Title</label>
                            <input id="title" placeholder="Write title of post here" v-model="form.title" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="categoy">Choose Category</label>
                            <select v-model="form.category_id" id="category" class="custom-select">
                                <option disabled selected value="">-- Choose Category --</option>
                                <option v-for="category in allCategories" :key="category.id" :value="category.id">{{ category.category_name }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <Select2Multiple id="tags" name="blog_tag_id[]" v-model="form.blog_tag_id">
                                <option v-for="option in allTags" :key="option.id" :value="option.id">{{ option.tag_name }}</option>
                            </Select2Multiple>
                        </div>
                        <div class="form-group">
                            <label for="post_photo">Upload Photo</label>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" @change="onImageChange" class="custom-file-input" id="post_photo">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <editor
                            v-model="form.body"
                            initialValue="<p>Write your thoughts here ...</p>"
                            apiKey="buqyptqj6lgw9tyseek2cwp20wkgaqebx3ge7elexo04r6il"
                            :init="{
                            height: 420,
                            menubar: false,
                            plugins: [
                                'advlist autolink lists link image charmap',
                                'searchreplace visualblocks code fullscreen',
                                'print preview anchor insertdatetime media',
                                'paste code help wordcount table'
                            ],
                            toolbar:
                                'undo redo | formatselect | bold italic | \
                                alignleft aligncenter alignright | \
                                bullist numlist outdent indent | help'
                            }"
                            >
                            </editor>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Select2Multiple from '../Select2Multiple'
import Editor from '@tinymce/tinymce-vue'
import { mapGetters, mapActions } from 'vuex'

export default {
    data() {
        return {
            form: {
                title: "",
                photo: "",
                body: "",
                category_id: "",
                blog_tag_id: []
            }
        }
    },
    computed: mapGetters(['allTags', 'allCategories']),
    components: {
        Editor,
        Select2Multiple,
        editor: Editor,
    },
    methods: {
        ...mapActions(['fetchTags', 'fetchCategories', 'addPost']),
        onImageChange(e){
            this.form.photo = e.target.files[0];
        },
        storePost(){
            let formData = new FormData();
            formData.append('photo', this.form.photo)
            formData.append('title', this.form.title)
            formData.append('category_id', this.form.category_id)
            formData.append('body', this.form.body)
            formData.append('blog_tag_id', this.form.blog_tag_id)
            formData.append('self', this)
            
            this.$store.dispatch('addPost', formData).then(() => this.$router.push({ name: "Home" }))
        }
    },
    created() {
        this.fetchCategories(),
        this.fetchTags()
    }
}
</script>
<style>

</style>