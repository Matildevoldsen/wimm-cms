import axios from 'axios';
import FormData from 'form-data'
import localforage from 'localforage'
import {
    setHttpToken
} from '../../../helpers'

const url = window.wimm.settings.appUrl

export const addSettings = ({
    dispatch
}, {
    payload,
    context
}) => {
    dispatch('setToken')
    let data = new FormData()
    data.append('name', payload.name)
    data.append('description', payload.description)
    data.append('email', payload.email)
    data.append('logo', payload.logo)
    data.append('favicon', payload.favicon)
    data.append('showUnderCounstrion', payload.showUnderCounstrion)
    data.append('head', payload.head)

    axios.post(url + '/api/auth/admin/settings/new', data, {
        headers: {
            'accept': 'application/json',
            'Content-Type': `multipart/form-data; boundary=${data._boundary}`,
        }
    }).then(() => {
        localforage.setItem('successSettings', response.data.data.id)
        context.errorsSettingsStep = ''
    }).catch((error) => {
        context.errorsSettings = error.response.data.errors
        context.errorsSettingsStep = 'is-danger'
    });
};

export const addHome = ({
    dispatch
}, {
    payload,
    context
}) => {
    dispatch('setToken')
    let data = new FormData()
    data.append('name', payload.name)
    data.append('displayName', payload.displayName)
    data.append('sortBy', payload.sortBy)
    data.append('layout', payload.layout)
    data.append('showArticles', payload.showArticles);
    data.append('thumbnail', payload.thumbnail)
    data.append('description', payload.description)


    axios.post(url + '/api/auth/admin/home/new', data, {
        headers: {
            'accept': 'application/json',
            'Content-Type': `multipart/form-data; boundary=${data._boundary}`,
        }
    }).then((response) => {
        localforage.setItem('successHome', response.data.data.id)
        context.errorsHomeStep = ''
    }).catch((error) => {
        context.errorsHome = error.response.data.errors
        context.errorsHomeStep = 'is-danger'
    });
};

export const addAbout = ({
    dispatch
}, {
    payload,
    context
}) => {
    dispatch('setToken')
    let data = new FormData()
    data.append('name', payload.name)
    data.append('displayName', payload.displayName)
    data.append('thumbnail', payload.thumbnail)
    data.append('description', payload.description)

    axios.post(url + '/api/auth/admin/about/new', data, {
        headers: {
            'accept': 'application/json',
            'Content-Type': `multipart/form-data; boundary=${data._boundary}`,
        }
    }).then((response) => {
        localforage.setItem('successAbout', response.data.data.id)
        context.errorsAboutStep = ''
    }).catch((error) => {
        context.errorsAbout = error.response.data.errors
        context.errorsAboutStep = 'is-danger'
    });
};

export const addContact = ({
    dispatch
}, {
    payload,
    context
}) => {
    dispatch('setToken')
    let data = new FormData()
    data.append('name', payload.name)
    data.append('displayName', payload.displayName)
    data.append('email', payload.email)
    data.append('thumbnail', payload.thumbnail)
    data.append('description', payload.description)

    axios.post(url + '/api/auth/admin/contact/new', data, {
        headers: {
            'accept': 'application/json',
            'Content-Type': `multipart/form-data; boundary=${data._boundary}`,
        }
    }).then((response) => {
        localforage.setItem('successContact', response.data.data.id)
        context.errorsContactStep = ''
    }).catch((error) => {
        context.errorsContact = error.response.data.errors
        context.errorsContactStep = 'is-danger'
    });
};

export const setToken = () => {
    let token = localStorage.getItem('localforage/wimm_cms/authtoken');
    setHttpToken(token.slice(1, -1))
}