import {isEmpty} from 'lodash'
import {setHttpToken} from '../../../helpers/index'
import localforage from 'localforage'
import axios from 'axios';

const url = window.wimm.settings.appUrl

export const register = ({dispatch}, {payload, context}) => {
    return axios.post(url + '/api/auth/register', payload).then((response) => {
        dispatch('setToken', response.data.meta.token).then(() => {
            dispatch('fetchUser')
        })
    }).catch((error) => {
        context.errors = error.response.data.errors
    })
};

export const login = ({dispatch}, {payload, context}) => {
    return axios.post(url + '/api/auth/login', payload).then((response) => {
        dispatch('setToken', response.data.meta.token).then(() => {
            dispatch('fetchUser')
        })
    }).catch((error) => {
        context.errors = error.response.data.errors
    })
};

export const fetchUser = ({commit}) => {
    return axios.get(url + '/api/auth/info').then((response) => {
        commit('setAuthenticated', true)
        commit('setUserData', response.data.data)
        if (response.data.data.user.admin == 1) {
            localforage.setItem('adminTrue', '1')
        } else {
            localforage.removeItem('adminTrue')
        }
    })
};

export const logout = ({dispatch}) => {
    return axios.get(url + '/api/auth/logout').then(() => {
        dispatch('clearAuth')
    })
};

export const setToken = ({commit, dispatch}, token) => {
    if (isEmpty(token)) {
        return dispatch('checkTokenExists').then((token) => {
            setHttpToken(token)
        })
    }

    commit('setToken', token);
    setHttpToken(token)
};

export const checkTokenExists = () => {
    return localforage.getItem('authtoken').then((token) => {
        if (isEmpty(token)) {
            return Promise.reject('NO_STORAGE_TOKEN');
        }

        return Promise.resolve(token)
    })
};

export const clearAuth = ({commit}) => {
    commit('setAuthenticated', false);
    commit('setUserData', null);
    commit('setToken', null);
    setHttpToken(null);
};
