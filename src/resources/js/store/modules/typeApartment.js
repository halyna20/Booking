import config from '../../config/config';
import axios from "axios";

const state = {
    types: []
}
const actions = {
    async getTypes({ commit }) {
        await axios.get(config.API_URL + '/types')
            .then(res => {
                commit('setTypes', res.data);
            })
    }
}

const mutations = {
    setTypes(state, types) {
        state.types = types
    }
}
const getters = {
    getTypes(state) {
        return state.types
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
