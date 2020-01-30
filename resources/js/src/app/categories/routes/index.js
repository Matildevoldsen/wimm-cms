import { New, Edit, Delete, View, Overview } from '../components'

export default [
    {
        path: '/admin/categories/overview',
        component: Overview,
        name: 'overview.category',
        meta: {
            title: 'Overview For Categories',
            guest: false,
            needsAuth: true,
            isAll: false,
            needsAdmin: true
        }
    },
    {
        path: '/admin/category/new',
        component: New,
        name: 'new.category',
        meta: {
            title: 'New Category',
            guest: false,
            needsAuth: true,
            isAll: false,
            needsAdmin: true
        }
    },
    {
        path: '/admin/category/edit/:id',
        component: Edit,
        name: 'edit.category',
        meta: {
            title: 'Edit Category',
            guest: false,
            needsAuth: true,
            isAll: false,
            needsAdmin: true
        }
    },
    {
        path: '/admin/category/delete/:id',
        component: Delete,
        name: 'delete.category',
        meta: {
            title: 'Delete Category',
            guest: false,
            needsAuth: true,
            isAll: false,
            needsAdmin: true
        }
    },
    {
        path: '/category/:id',
        component: View,
        name: 'view.category',
        meta: {
            title: 'View Category',
            guest: false,
            needsAuth: false,
            isAll: true,
            needsAdmin: false
        }
    },
]
