import { Edit } from '../components'

export default [
    {
        path: '/admin/settings/edit',
        component: Edit,
        name: 'settings.edit',
        meta: {
            title: 'Edit Site',
            guest: false,
            needsAuth: true,
            isAll: false,
            needsAdmin: true
        }
    }
]
