import {createStore} from "vuex";

export default createStore({
    state: {
        token: null,
        isAuthenticated: false,
    },
    mutations: {
        setToken(state, token) {
            localStorage.setItem('token', token);
            state.token = token;
            state.isAuthenticated = !!token;
        },
        clearToken(state) {
            localStorage.removeItem('token');
            state.token = null;
            state.isAuthenticated = false;
        },
    },
    getters: {
        isAuthenticated: state => state.isAuthenticated,
        token: state => state.token,
    },
    actions: {
        login({ commit }, token) {
          commit('setToken', token);
        },
        logout({ commit }) {
          commit('clearToken');
        },
    },
});