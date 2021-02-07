const state = {
    tags : [],
    validation: []
}

const getters = {
    allTags: (state) => state.tags,
    allTagErrors: (state) => state.validation
}

const actions = {
    async fetchTags({ commit }) {
        const response = await axios.get('/api/admin/tags')
        commit('setTags', response.data)
    },
    async addTag({ commit }, tag_name) {
        const response = await axios.post('/api/admin/tags', { tag_name })
        if(response.data.errors == "") {
            commit('newTag', response.data)
        }else{
            state.validation = response.data.errors
        }
    },
    async deleteTag({ commit }, id) {
        await axios.post(`/api/admin/tags/${id}`, { _method: 'DELETE' })
        commit('removeTag', id)
    }
}

const mutations = {
    setTags: (state, tags) => (state.tags = tags),
    newTag: (state, tag) => state.tags = [...state.tags, tag],
    removeTag: (state, id) => state.tags = state.tags.filter(tag => tag.id != id)
}

export default {
    state,
    getters,
    actions,
    mutations
}