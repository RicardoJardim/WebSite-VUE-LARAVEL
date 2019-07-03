import VueRouter from 'vue-router'

// Pages
import Home from './pages/Home'
import Register from './pages/Register'
import Login from './pages/Login'
import Dashboard from './pages/user/Dashboard'
import AdminDashboard from './pages/admin/Dashboard'
import Chat from './components/Chat/Chat'
import ChatGlobal from './components/Chat/ChatGlobal'
import Propostas from './components/Propostas/Propostas'
import PropostaAdd from './components/Propostas/Form'
import Proposta from './components/Propostas/SpecificProposta'
import Profissionais from './components/Profissionais/Profissionais'
import Me from './components/Perfil/Me'
import Perfil from './components/Perfil/Perfil'
import MePropostas from './components/Propostas/MinhasPropostas'



// Routes
const routes = [
  {
    path: '/',
    name: 'home',
    component: Home,
    meta: {
      auth: undefined
    }
  },
  {
    path: '/register',
    name: 'register',
    component: Register,
    meta: {
      auth: false
    }
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: {
      auth: false
    }
  },
  // USER ROUTES
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard,
    meta: {
      auth: true
    }
  },
  {
    path: '/chat',
    name: 'ChatGlobal',
    component: ChatGlobal,
    meta: {
      auth: true
    }
  },
  {
    path: '/chat/:id',
    name: 'chat',
    component: Chat,
    meta: {
      auth: true
    }
  },
  {
    path: '/propostas',
    name: 'propostas',
    component: Propostas,
    meta: {
      auth: true
    }
  },
  {
    path: '/me/propostas/:id',
    name: 'proposta',
    component: Proposta,
    meta: {
      auth: true
    }
  },
  {
    path: '/proposta/add',
    name: 'propostaAdd',
    component: PropostaAdd,
    meta: {
      auth: true
    }
  },
  {
    path: '/profissionais',
    name: 'profissionais',
    component: Profissionais,
    meta: {
      auth: true
    }
  },
  {
    path: '/me',
    name: 'me',
    component: Me,
    meta: {
      auth: true
    }
  },
  {
    path: '/me/propostas',
    name: 'mePropostas',
    component: MePropostas,
    meta: {
      auth: true
    }
  },
  {
    path: '/user/:id',
    name: 'perfil',
    component: Perfil,
    meta: {
      auth: true
    }
  },
  // ADMIN ROUTES
  {
    path: '/admin',
    name: 'admin.dashboard',
    component: AdminDashboard,
    meta: {
      auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/403'}
    }
  },
]

const router = new VueRouter({
  history: true,
  mode: 'history',
  routes,
})

export default router