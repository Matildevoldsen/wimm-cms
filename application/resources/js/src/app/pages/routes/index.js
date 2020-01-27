import { New, Edit, Delete, View, Overview } from '../components'

export default [
    {
        path: '/admin/pages/overview',
        component: Overview,
        name: 'overview.page',
        meta: {
            title: 'Overview For Pages',
            guest: false,
            needsAuth: true,
            isAll: false,
            needsAdmin: true
        }
    },
    {
        path: '/admin/pages/new',
        component: New,
        name: 'new.page',
        meta: {
            title: 'New Page',
            guest: false,
            needsAuth: true,
            isAll: false,
            needsAdmin: true
        }
    },
    {
        path: '/admin/pages/edit/:id',
        component: Edit,
        name: 'edit.page',
        meta: {
            title: 'Edit Page',
            guest: false,
            needsAuth: true,
            isAll: false,
            needsAdmin: true
        }
    },
    {
        path: '/admin/pages/delete/:id',
        component: Delete,
        name: 'delete.page',
        meta: {
            title: 'Delete Page',
            guest: false,
            needsAuth: true,
            isAll: false,
            needsAdmin: true
        }
    },
    {
        path: '/pages/:id-:slug',
        component: View,
        name: 'view.page',
        meta: {
            title: 'View Page',
            guest: false,
            needsAuth: false,
            isAll: true,
            needsAdmin: false
        }
    },
]