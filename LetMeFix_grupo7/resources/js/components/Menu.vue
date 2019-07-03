<template>
  <nav id="nav" class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="navbar-nav">
      <a class="nav-item nav-link" v-if="!$auth.check()" v-for="(route, key) in routes.unlogged" v-bind:key="route.path">
        <router-link  :to="{ name : route.path }" :key="key">
            {{route.name}}
        </router-link></span>
      </a>
      <a class="nav-item nav-link" v-if="$auth.check(1)" v-for="(route, key) in routes.user" v-bind:key="route.path">
        <router-link  :to="{ name : route.path }" :key="key">
            {{route.name}}
        </router-link>
      </a>
      <a class="nav-item nav-link" v-if="$auth.check(2)" v-for="(route, key) in routes.admin" v-bind:key="route.path">
        <router-link  :to="{ name : route.path }" :key="key">
            {{route.name}}
        </router-link>
      </a>
      <a class="nav-item nav-link" v-if="$auth.check()">
        <a href="#" @click.prevent="$auth.logout()">Logout</a>
      </a>
    </div>
  </nav>
</template>

<style>
  #nav a.router-link-exact-active {
  font-weight: bold;
  color: #a7cef5;
}
  
</style>

<script>
  export default {
    data() {
      image: ''
      return {
        routes: {
          // UNLOGGED
          unlogged: [
            {
              name: 'Registar',
              path: 'register'
            },
            {
              name: 'Home',
              path: 'home'
            },
            {
              name: 'Login',
              path: 'login'
            }
          ],

          // LOGGED USER
          user: [
            {
              name: 'Home',
              path: 'home'
            },
            {
              name: 'Chat',
              path: 'ChatGlobal'
            },
            {
              name: 'Propostas',
              path: 'propostas'
            },
            {
              name: 'Profissionais',
              path: 'profissionais'
            },
            {
              name: 'Perfil',
              path: 'me'
            }
          ],
          // LOGGED ADMIN
          admin: [
            {
              name: 'Dashboard',
              path: 'admin.dashboard'
            }
          ]
        }
      }
    },
    mounted() {
      //
    },
  }
</script>