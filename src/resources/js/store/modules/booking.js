import router from "../../router";
import config from '../../config/config';
import axios from "axios";

const state = {
    bookingRooms: null,
    message: ""
}
const actions = {
    async addBooking({ state, rootState, commit }) {
        await axios.post(config.API_URL + '/booking', { bookingRooms: state.bookingRooms, userData: rootState.main.searchParam })
            .then(res => {
                if (res.data.error) {
                    commit('setMessage', res.data.error);
                }
            }).catch(err => {
                
                console.log(err)
            })

    },

    async deleteBooking({ dispatch }, { bookingDateId, bookingRoomId }) {

        await axios.delete(config.API_URL + `/bookingDate/${bookingDateId}/delete`)
            .then(res => {
                dispatch('user/getBooking', null, { root: true });
                console.log(res.data.message)
            })
    }
}

const mutations = {
    setBookingRooms(state, bookingRooms) {
        state.bookingRooms = bookingRooms
    },
    setMessage(state, message) {
        state.message = message
    }
}
const getters = {
    getBookingRooms(state) {
        return state.bookingRooms
    },
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
