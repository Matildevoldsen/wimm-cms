import axios from 'axios';
import FormData from 'form-data'
import localforage from 'localforage'
import {
    setHttpToken
} from '../../../../../helpers'

const url = window.wimm.settings.appUrl

export const addCategory = ({
    dispatch
}, {
    payload,
    context
}) => {
    dispatch('setToken')
    let data = new FormData()
    data.append('title', payload.title)
    data.append('description', payload.description)
    data.append('is_private', payload.is_private)
    data.append('show_in_footer', payload.show_in_footer)
    data.append('show_in_navigation', payload.show_in_navigation)
    data.append('show_in_navigation', payload.show_in_navigation)
    data.append('thumbnail', payload.thumbnail)
    data.append('thumbnail_alt', payload.thumbnail_alt)
    data.append('seo_desc', payload.seo_desc)
    data.append('language', payload.language)
    data.append('top_category_id', payload.top_category_id)

    axios.post(url + '/api/auth/admin/category/new', data, {
        headers: {
            'accept': 'application/json',
            'Content-Type': `multipart/form-data; boundary=${data._boundary}`,
        }
    }).then((response) => {
        localforage.setItem('intended', response.data.data.id)
    }).catch((error) => {
        context.errors = error.response.data.errors
    });
};

export const setToken = () => {
    let token = localStorage.getItem('localforage/wimm_cms/authtoken');
    setHttpToken(token.slice(1, -1))
}

export const fetchCategories = ({
    commit
}) => {
    return axios.get(url + '/api/category/all').then((response) => {
        commit('setCategories', response.data.data)
    })
};

export const fetchCategory = ({
    commit
}, id) => {
    return axios.get(url + '/api/category/' + id).then((response) => {
        commit('setCategory', response.data.data)
    })
};