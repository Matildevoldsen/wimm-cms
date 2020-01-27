import { Login, Register, Forgot, Confirm } from '../components'

export default [
    {
        path: '/login',
        component: Login,
        name: 'login',
        meta: {
            title: 'Login',
            guest: true,
            needsAuth: false,
            isAll: false,
            needsAdmin: false
        }
    },
    {
        path: '/register',
        component: Register,
        name: 'register',
        meta: {
            title: 'Register',
            guest: true,
            needsAuth: false,
            isAll: false,
            needsAdmin: false
        }
    },
    {
        path: '/auth/forgot',
        component: Forgot,
        name: 'forgot',
        meta: {
            title: 'Forgot Password',
            guest: true,
            needsAuth: false,
            isAll: false,
            needsAdmin: false
        }
    },
    {
        path: '/auth/confirm',
        component: Confirm,
        name: 'confirm',
        meta: {
            title: 'Confirm Email',
            guest: true,
            needsAuth: false,
            isAll: false,
            needsAdmin: false
        }
    }
]
