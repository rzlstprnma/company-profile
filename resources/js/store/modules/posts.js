const state = {
    posts : [],
    validation: [],
}

const getters = {
    allPosts: (state) => state.posts,
    allPostErrors: (state) => state.validation
}

const actions = {
    async fetchPosts({ commit }) {
        const response = await axios.get('/api/admin/posts')
        commit('setPosts', response.data)
    },
    async addPost({ commit }, formData) {
        try {
            const response = 
            await axios({
                url: '/api/admin/posts',
                data: formData,
                method: 'post',
                headers: {'Content-Type': `multipart/form-data; boundary=${formData._boundary}` }
            })
            if(response.status == 200) {
                commit('newPost', response.data)
            }
        }catch(errors) {
            state.validation = errors.response.data.errors
        }
        
    },
    async deletePost({ commit }, id) {
        await axios.post(`/api/admin/posts/${id}`, { _method: 'DELETE' })
        commit('removePost', id)
    },
    async postDetail(updPost) {
        await axios.get(`/api/admin/posts/${updPost.id}/edit`, updPost)   
        console.log(updPost)
    }
}
const mutations = {
    setPosts: (state, posts) => state.posts = posts,
    removePost: (state, id) => state.posts = state.posts.filter(post => post.id != id),
    newPost: (state, post) => state.posts = [...state.posts, post] 
}

export default {
    state,
    getters,
    actions,
    mutations
}