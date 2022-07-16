import router from "../../router";
import config from '../../config/config';
import axios from "axios";

const state = {
    message: []
}
const actions = {
    async addRoom({ commit }, { name, description, number_of_adults, number_of_children, size, price }) {
        await axios.post(config.API_URL + `/apartment/${router.currentRoute.value.params.id}/room/create`, {
            name: name,
            description: description,
            number_of_adults: number_of_adults,
            number_of_children: number_of_children,
            size: size,
            price: price
        })
            .then(res => {
                if (res.data) {
                    let success = new Object();
                    success.success = 'Номер успішно додано';
                    commit('setMessage', success)
                }
            })
            .catch(error => {
                if (error.response) {
                    commit('setMessage', error.response.data.errors)
                }
            })

    }
}


const mutations = {
    setMessage(state, message) {
        state.message = message
    }
}
const getters = {
    getMessage(state) {
        return state.message
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
