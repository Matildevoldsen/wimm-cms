import axios from 'axios';
import {setHttpToken} from '../../../../helpers'

const url = window.wimm.settings.appUrl

export const fetchStats = ({commit}) => {
    let token = localStorage.getItem('localforage/wimm_cms/authtoken');
    setHttpToken(token.slice(1, -1))


    return axios.get(url + '/api/auth/admin/stats/thisMonth').then((response) => {
        commit('setStats', response.data.data)
        console.log(response)
    })
};
