import store from '../vuex'
import localforage from 'localforage'
import {isEmpty} from 'lodash'

const beforeEach = ((to, from, next) => {
    document.title = to.meta.title;
    const isAdmin = localStorage.getItem('localforage/wimm_cms/adminTrue');
    const isAuthenticated = localStorage.getItem('localforage/wimm_cms/authtoken');

    if (to.meta.needsAdmin) {
        if (!isEmpty(isAuthenticated)) {
            if (!isEmpty(isAdmin)) {
                next();
            } else {
                next('/NotFound')
            }
        } else {
            next('/NotFound')
        }
    }

    store.dispatch('auth/checkTokenExists').then(() => {
        if (to.meta.guest) {
            next({name: 'home'});
            return
        }

        next()
    }).catch(() => {
        if (to.meta.needsAuth) {
            localforage.setItem('intended', to.name);
            next({name: 'login'});
            return
        }

        next()
    })
});

export default beforeEach
