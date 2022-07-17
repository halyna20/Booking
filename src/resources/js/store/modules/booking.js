import router from "../../router";
import config from '../../config/config';
import axios from "axios";

const state = {
    bookingRooms: null,
    message: "",
    deleteMessage: ""
}
const actions = {
    async addBooking({ state, rootState, commit }) {
        await axios.post(config.API_URL + '/booking', { bookingRooms: state.bookingRooms, userData: rootState.main.searchParam })
            .then(res => {
                if (res.data.error) {
                    commit('setMessage', res.data.error);
                } else {
                    commit('setMessage', "Бронювання здійснено")
                }
            }).catch(err => {
                if (err.response.status === 422)
                    commit('setMessage', err.response.data)
            })

    },

    async deleteBooking({ commit, dispatch }, { bookingDateId }) {

        await axios.delete(config.API_URL + `/bookingDate/${bookingDateId}/delete`)
            .then(res => {
                dispatch('user/getBooking', null, { root: true });
                commit('setDeleteMessage', res.data.message);
            })
    }
}

const mutations = {
    setBookingRooms(state, bookingRooms) {
        state.bookingRooms = bookingRooms
    },
    setMessage(state, message) {
        state.message = message
    },
    setDeleteMessage(state, deleteMessage) {
        state.deleteMessage = deleteMessage
    }
}
const getters = {
    getBookingRooms(state) {
        return state.bookingRooms
    },
    getMessage(state) {
        return state.message
    },
    getDeleteMessage(state) {
        return state.deleteMessage
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
