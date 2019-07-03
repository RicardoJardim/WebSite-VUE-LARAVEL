import bearer from '@websanova/vue-auth/drivers/auth/bearer'
import axios from '@websanova/vue-auth/drivers/http/axios.1.x'
import router from '@websanova/vue-auth/drivers/router/vue-router.2.x'

// Auth base configuration some of this options
// can be override in method calls
const config = {
  auth: bearer,
  http: axios,
  router: router,
  tokenDefaultName: 'laravel-vue-spa',
  tokenStore: ['localStorage'],
  rolesVar: 'role',
  registerData: {url: 'http://localhost:8000/api/auth/register', method: 'POST', redirect: '/login'},
  loginData: {url: 'http://localhost:8000/api/auth/login', method: 'POST', redirect: '', fetchUser: true},
  logoutData: {url: 'http://localhost:8000/api/auth/logout', method: 'POST', redirect: '/', makeRequest: true},
  fetchData: {url: 'http://localhost:8000/api/auth/user', method: 'GET', enabled: true},
  refreshData: {url: 'http://localhost:8000/api/auth/refresh', method: 'GET', enabled: true, interval: 30}
}

export default config