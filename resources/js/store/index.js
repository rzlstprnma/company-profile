import Vue from 'vue'
import Vuex from 'vuex'
import tags from './modules/tags'
import categories from './modules/categories'
import posts from './modules/posts'

Vue.use(Vuex)

export default new Vuex.Store({
    modules : {
        tags,
        categories,
        posts,
    }
})