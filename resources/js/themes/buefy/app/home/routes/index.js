import { Home, Edit } from '../components'

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
    },
    {
        path: '/admin/pages/home/edit',
        component: Edit,
        name: 'edit.home',
        meta: {
            title: 'Home',
            guest: false,
            needsAuth: true,
            isAll: false,
            needsAdmin: true
        }
    }
]
