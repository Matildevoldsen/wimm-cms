import Vue from 'vue'
import Vuex from 'vuex'
import auth from '../app/auth/vuex'
import admin from '../app/admin/vuex'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth: auth,
        admin: admin,
    }
});
