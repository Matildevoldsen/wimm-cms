import { New, Edit, Delete, View } from '../components'

export default [
    {
        path: '/admin/articles/new',
        component: New,
        name: 'new.article',
        meta: {
            title: 'New Article',
            guest: false,
            needsAuth: true,
            isAll: false,
            needsAdmin: true
        }
    },
    {
        path: '/admin/articles/edit/:id',
        component: Edit,
        name: 'edit.article',
        meta: {
            title: 'Edit Article',
            guest: false,
            needsAuth: true,
            isAll: false,
            needsAdmin: true
        }
    },
    {
        path: '/admin/articles/delete/:id',
        component: Delete,
        name: 'delete.article',
        meta: {
            title: 'Delete Article',
            guest: false,
            needsAuth: true,
            isAll: false,
            needsAdmin: true
        }
    },
    {
        path: '/articles/:id-:slug',
        component: View,
        name: 'view.article',
        meta: {
            title: 'View Article',
            guest: false,
            needsAuth: false,
            isAll: true,
            needsAdmin: false
        }
    },
]
