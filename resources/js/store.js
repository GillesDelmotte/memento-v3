import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex);


const getters = {};
const state = {
    currentUser: "",
};
const mutations = {
    setCurrentUser(state, user) {
        state.currentUser = user.user
        //state.currentUserImage = user.img
    },
};
const actions = {
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
};

export default new Vuex.Store({
    state,
    getters,
    mutations,
    actions
})
