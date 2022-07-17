import config from '../../config/config';
import axios from "axios";

const state = {
    booking: []
}
const actions = {
    async editUser({ commit }, { id, firstName, lastName, phone, country }) {
        await axios.patch(config.API_URL + `/user/${id}/update`, {
            first_name: firstName,
            last_name: lastName,
            phone: phone,
            country_id: country,
        }).then((res) => {
            commit('auth/setUser', res.data.data, { root: true })
        });
    },

    async getBooking({ commit },) {

        await axios.get(config.API_URL + `/user/booking`)
            .then(res => {
                if (res.data.message) {
                    commit("setBooking", res.data)
                } else {
                    commit("setBooking", res.data.bookingDate)
                }
            })
    }
}

const mutations = {
    setBooking(state, booking) {
        state.booking = booking
    }
}
const getters = {
    getBooking(state) {
        return state.booking
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
