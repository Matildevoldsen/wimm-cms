import { AdminUser, Settings } from '../components'

export default [
    {
        path: '/wimm_cms/installer/admin',
        component: AdminUser,
        name: 'installer.user',
        meta: {
            title: 'Setup Admin User',
            guest: true,
            needsAuth: false,
            isAll: false,
            needsAdmin: false
        }
    },
    {
        path: '/wimm_cms/installer/settings',
        component: Settings,
        name: 'installer.settings',
        meta: {
            title: 'Site Settings',
            guest: false,
            needsAuth: true,
            isAll: false,
            needsAdmin: true
        }
    },
]
