import auth from './auth/routes'
import admin from './admin/routes'
import home from './home/routes'
import articles from './articles/routes'
import pages from './pages/routes'
import categories from './categories/routes'
import topCategories from './topCategories/routes'
import errors from './errors/routes'
import settings from './settings/routes'

export default [...home, ...auth, ...errors, ...admin, ...articles, ...pages, ...categories, ...topCategories, ...settings]
