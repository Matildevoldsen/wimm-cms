import Vue from 'vue'
import Router from 'vue-router'
import {routes as routes} from '../app'
import beforeEach from './beforeEach'

Vue.use(Router);

const router = new Router({
    routes: routes,
    mode: 'history'
});

//router.beforeEach(beforeEach);

export default router
