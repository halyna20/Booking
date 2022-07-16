import router from "../../router";
import config from '../../config/config';
import axios from "axios";

const state = {
    errors: []
}
const actions = {
    async addApartment({ commit }, { name, address, description, city, type }) {

        await axios.post(config.API_URL + '/store', {
            name: name,
            address: address,
            description: description,
            city_id: city,
            type_id: type
        })
            .then(res => {
                if (res.data) {
                    router.push({ path: `/apartment/${res.data.data.id}/room/create` })
                }
            })
            .catch(error => {
                if (error.response.status === 422) {
                    commit('setErrors', error.response.data.errors)
                }
            })
    }
}

const mutations = {
    setErrors(state, errors) {
        state.errors = errors
    },
}
const getters = {
    getErrors(state) {
        return state.errors
    },
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
