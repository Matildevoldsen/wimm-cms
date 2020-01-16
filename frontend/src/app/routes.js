import auth from './auth/routes'
import admin from './admin/routes'
import home from './home/routes'
import articles from './articles/routes'
import errors from './errors/routes'

export default [...home, ...auth, ...errors, ...admin, ...articles]
