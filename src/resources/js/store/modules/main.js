import axios from 'axios';
import router from "../../router";
import config from '../../config/config';


const state = {
    apartments: [],
    errors: new Object,
    searchParam: new Object,
    apartmentDetails: [],
    rooms: [],
    findError: ""
}

const actions = {
    async search({ commit }, { city, dateFrom, dateTo, child, adult, roomCount }) {
        const params = {
            city,
            dateFrom,
            dateTo,
            child,
            adult,
            roomCount
        }

        let search = {
            dateFrom: dateFrom,
            dateTo: dateTo,
            child: child,
            adult: adult,
        }

        commit('setSearchParam', search)


        await axios.get(config.API_URL + '/search', { params })
            .then(res => {
                console.log(res.data)
                if (res.data.error) {
                    commit('setFindError', res.data)
                } else {
                    commit('setApartments', res.data.data)
                    router.push({ path: '/search-result' })
                }

            }).catch(e => {
                if (e.response.status === 422) {
                    commit('setErrors', e.response.data.errors)
                }
            })
    },
    async getApartment({ commit, state }) {
        const params = state.searchParam

        await axios.get(config.API_URL + `/apartment/${router.currentRoute.value.params.id}`, { params })
            .then(res => {
                commit('setApartmentDetails', res.data.apartment)
                commit('setRooms', res.data.rooms)
            })
    }
}

const mutations = {
    setApartments(state, apartments) {
        state.apartments = apartments
    },
    setFindError(state, findError) {
        state.findError = findError
    },
    setErrors(state, errors) {
        state.errors = errors
    },
    setSearchParam(state, searchParam) {
        state.searchParam = searchParam
    },
    setApartmentDetails(state, apartmentDetails) {
        state.apartmentDetails = apartmentDetails
    },
    setRooms(state, rooms) {
        state.rooms = rooms
    }
}


const getters = {
    getApartments(state) {
        return state.apartments
    },
    getFindError(state) {
        return state.findError
    },
    getErrors(state) {
        return state.errors
    },
    getSearchParam(state) {
        return state.searchParam
    },
    getApartmentDetails(state) {
        return state.apartmentDetails
    },
    getRooms(state) {
        return state.rooms;
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
