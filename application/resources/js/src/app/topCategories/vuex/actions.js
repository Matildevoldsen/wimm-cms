import axios from 'axios';
import FormData from 'form-data'
import {setHttpToken} from '../../../helpers/index'

export const addTopCategory = ({dispatch}, {payload, context}) => {
    dispatch('setToken')
    let data = new FormData()
    data.append('title', payload.title)
    data.append('description', payload.description)
    data.append('has_page', payload.has_page)
    data.append('is_private', payload.is_private)
    data.append('show_in_footer', payload.show_in_footer)
    data.append('show_in_navigation', payload.show_in_navigation)
    data.append('show_in_navigation', payload.show_in_navigation)
    data.append('thumbnail', payload.thumbnail)

    axios.post('/api/auth/admin/topCategory/new', data, {
        headers: {
          'accept': 'application/json',
          'Content-Type': `multipart/form-data; boundary=${data._boundary}`,
        }
      }).then((response) => {
            context.success = response.data.data
        }).catch((error) => {
            context.errors = error.response.data.errors
        });
};

export const setToken = () => {
    let token = localStorage.getItem('localforage/wimm_cms/authtoken');
    setHttpToken(token.slice(1, -1))
}

export const fetchTopCategories = ({commit}) => {
    return axios.get('/api/topCategory/all').then((response) => {
        commit('setTopCategories', response.data.data)
        console.log(response)
    })
};

export const fetchTopCategory = ({commit}, {id}) => {
    return axios.get('/api/topCategory/' + id).then((response) => {
        commit('setTopCategory', response.data.data)
        console.log(response)
    })
};
