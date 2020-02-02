import axios from 'axios';
import {setHttpToken} from '../../../../helpers/index'

export const fetchStats = ({commit}) => {
    let token = localStorage.getItem('localforage/wimm_cms/authtoken');
    setHttpToken(token.slice(1, -1))


    return axios.get('/api/auth/admin/stats/thisMonth').then((response) => {
        commit('setStats', response.data.data)
        console.log(response)
    })
};
