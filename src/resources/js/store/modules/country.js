import config from '../../config/config';
import axios from "axios";

const state = {
    countries: []
}
const actions = {
    async getCountries({ commit }) {
        await axios.get(config.API_URL + '/countries')
            .then(res => {
                commit('setCountries', res.data.data);
            })
    }
}

const mutations = {
    setCountries(state, countries) {
        state.countries = countries
    }
}
const getters = {
    getCountries(state) {
        return state.countries
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
