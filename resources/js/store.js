import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex);


const getters = {};
const state = {
    currentUser: "",
    allJob: null,
    allPractitioner: null,
};
const mutations = {
    setCurrentUser(state, user) {
        state.currentUser = user.user
        //state.currentUserImage = user.img
    },
    setAllJob(state, jobs) {
        state.allJob = jobs;
    },
    setAllPractitioner(state, practitioners) {
        state.allPractitioner = practitioners;
    },
};
const actions = {

    // récuperer l'utilisateur connecté

    setCurrentUser({ commit }) {
        return new Promise((resolve, reject) => {
            window.axios.get('/authenticated-user')
                .then(response => {
                    commit('setCurrentUser', response.data)
                    resolve()
                })
                .catch(error => {
                    console.log(error)
                })
        })
    },

    // récupérer toutes les profesion

    setAllJob({ commit }) {
        return new Promise((resolve, reject) => {
            window.axios.get('/getJobs')
                .then(response => {
                    commit('setAllJob', response.data)
                    resolve()
                })
        })
    },

    // récupérer tous les utilisateur ayant crée un aganda

    setAllPractitioner({ commit }) {
        return new Promise((resolve, reject) => {
            window.axios.get('/getPractitioners')
                .then(response => {
                    commit('setAllPractitioner', response.data)
                    resolve()
                }).catch(error => {
                    console.log(error)
                })
        })
    },
};

export default new Vuex.Store({
    state,
    getters,
    mutations,
    actions
})
