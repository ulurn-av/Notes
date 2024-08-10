import {createStore} from "vuex";
import { jwtDecode } from 'jwt-decode';

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
        checkAuth({ state, commit }) {
            commit('setToken', localStorage.getItem('token'));
            if (state.token) {
                const decodedToken = jwtDecode(state.token);
                const currentTime = Date.now() / 1000;
                console.log(decodedToken)
                if (decodedToken.exp < currentTime) {
                  commit('clearToken');
                  return false;
                }
            }
            else{
                commit('clearToken');
                return false;
            }
            return true;
        },
    },
});