import config from '../../config/config';
import axios from "axios";

const state = {
    cities: []
}
const actions = {
    async getCities({ commit }) {
        await axios.get(config.API_URL + '/cities')
            .then(res => {
                commit('setCities', res.data);
            })
    }
}

const mutations = {
    setCities(state, cities) {
        state.cities = cities
    }
}
const getters = {
    getCities(state) {
        return state.cities
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
