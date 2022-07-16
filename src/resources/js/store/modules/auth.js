import router from "../../router";
import config from '../../config/config';
import axios from "axios";

const state = {
    user: null,
    errorsLogin: [],
    errorsRegister: []
}

const actions = {
    async loginUser({ commit, dispatch }, { email, password }) {
        await axios.get('/sanctum/csrf-cookie')
            .then(response => {
                axios.post(config.BASE_URL + '/login', { email: email, password: password })
                    .then(res => {
                        localStorage.setItem('x_xsrf_token', res.config.headers['X-XSRF-TOKEN'])
                        router.push({ name: 'Home' })
                        dispatch('getUser');
                    }).catch(err => {
                        commit('setErrorsLogin', err.response.data.errors)
                    })
            })
    },

    async registerUser({ commit, dispatch }, { email, password, password_confirmation }) {
        await axios.get('/sanctum/csrf-cookie')
            .then(response => {
                axios.post(config.BASE_URL + '/register', {
                    email: email, password: password,
                    password_confirmation: password_confirmation
                }).then(res => {
                    localStorage.setItem('x_xsrf_token', res.config.headers['X-XSRF-TOKEN'])
                    dispatch('getUser');
                    router.push({ name: 'EmailSend' })
                }).catch(err => {
                    commit('setErrorsRegister', err.response.data.errors)
                })
            })
    },
    async logout({ commit }) {
        await axios.post(config.BASE_URL + '/logout')
            .then(res => {
                localStorage.removeItem('x_xsrf_token')
                commit('setUser', null);
                router.push({ name: 'Login' })

            })
    },
    async getUser({ commit }) {
        await axios.get(config.API_URL + '/user')
            .then(res => {
                commit('setUser', res.data.data);
            })
    }

}
const mutations = {
    setErrorsLogin(state, errorsLogin) {
        state.errorsLogin = errorsLogin
    },
    setErrorsRegister(state, errorsRegister) {
        state.errorsRegister = errorsRegister
    },
    setUser(state, user) {
        state.user = user
    }
}
const getters = {
    getErrorsLogin(state) {
        return state.errorsLogin
    },
    getErrorsRegister(state) {
        return state.errorsRegister
    },
    getUser(state) {
        return state.user
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
