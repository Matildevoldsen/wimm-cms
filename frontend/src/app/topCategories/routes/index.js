import { New, Edit, Delete, View, Overview } from '../components'

export default [
    {
        path: '/admin/topCategories/overview',
        component: Overview,
        name: 'overview.topCategory',
        meta: {
            title: 'Overview For Category',
            guest: false,
            needsAuth: true,
            isAll: false,
            needsAdmin: true
        }
    },
    {
        path: '/admin/topCategories/new',
        component: New,
        name: 'new.topCategory',
        meta: {
            title: 'New Category',
            guest: false,
            needsAuth: true,
            isAll: false,
            needsAdmin: true
        }
    },
    {
        path: '/admin/topCategories/edit/:id',
        component: Edit,
        name: 'edit.topCategory',
        meta: {
            title: 'Edit Category',
            guest: false,
            needsAuth: true,
            isAll: false,
            needsAdmin: true
        }
    },
    {
        path: '/admin/topCategories/delete/:id',
        component: Delete,
        name: 'delete.topCategory',
        meta: {
            title: 'Delete Category',
            guest: false,
            needsAuth: true,
            isAll: false,
            needsAdmin: true
        }
    },
    {
        path: '/topCategories/:id-:slug',
        component: View,
        name: 'view.topCategory',
        meta: {
            title: 'View Category',
            guest: false,
            needsAuth: false,
            isAll: true,
            needsAdmin: false
        }
    },
]