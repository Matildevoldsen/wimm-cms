import { Setup } from '../components'

export default [
    // {
    //     path: '/sign-up',
    //     component: AdminUser,
    //     name: 'installer.user',
    //     meta: {
    //         title: 'Setup Admin User',
    //         guest: true,
    //         needsAuth: false,
    //         isAll: false,
    //         needsAdmin: false
    //     }
    // },
    {
        path: '/',
        component: Setup,
        name: 'installer',
        meta: {
            title: 'Setup Admin User',
            guest: false,
            needsAuth: false,
            isAll: false,
            needsAdmin: true
        }
    },
]
