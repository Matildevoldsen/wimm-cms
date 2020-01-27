import { Home } from '../components'

export default [
    {
        path: '/',
        component: Home,
        name: 'home',
        meta: {
            title: 'Home',
            guest: false,
            needsAuth: false,
            isAll: true,
            needsAdmin: false
        }
    }
]
