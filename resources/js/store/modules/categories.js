const state = {
    categories : []
}

const getters = {
    allCategories: (state) => state.categories
}

const actions = {
    async fetchCategories({ commit }) {
        const response = await axios.get('/api/admin/categories')
        commit('setCategories', response.data)
    },
    async addCategory({ commit }, category_name) {
        const response = await axios.post('/api/admin/categories', { category_name })
        commit('newCategory', response.data)
    },
    async deleteCategory({ commit }, id) {
        await axios.post(`/api/admin/categories/${id}`, { _method: 'DELETE' })
        commit('removeCategory', id)
    }
}

const mutations = {
    setCategories: (state, categories) => state.categories = categories,
    newCategory: (state, categories) => state.categories = [...state.categories, categories],
    removeCategory: (state, id) => state.categories = state.categories.filter(category => category.id != id)
}

export default {
    state,
    getters,
    actions,
    mutations
}