import { Overview } from '../components'

export default [
    {
        path: '/admin/overview',
        component: Overview,
        name: 'admin',
        meta: {
            title: 'Admin',
            guest: false,
            needsAuth: true,
            isAll: false,
            needsAdmin: true
        }
    }
]
