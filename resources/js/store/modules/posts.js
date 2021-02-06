const state = {
    posts : []
}

const getters = {
    allPosts: (state) => state.posts
}

const actions = {
    async fetchPosts({ commit }) {
        const response = await axios.get('/api/admin/posts')
        commit('setPosts', response.data)
    },
    async addPost({ commit }, formData) {
        const response = 
        await axios({
            url: '/api/admin/posts',
            data: formData,
            method: 'post',
            headers: {'Content-Type': `multipart/form-data; boundary=${formData._boundary}` }
        })

        commit('newPost', response.data)
    },
    async deletePost({ commit }, id) {
        await axios.post(`/api/admin/posts/${id}`, { _method: 'DELETE' })
        commit('removePost', id)
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